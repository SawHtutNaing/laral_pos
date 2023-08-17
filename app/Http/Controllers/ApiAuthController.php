<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Auth\Events\Registered;




use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ApiAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin')->only(['register', 'allUsers', 'DeleteAccount', 'BanUser']);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'actually_price' => 'required|integer|min:0',
            'sales_price' => 'required|integer|min:0',
            'total_stock' => 'required|integer|min:0',
            'unit' => 'required|string',
            'more_information' => 'nullable|string',

            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);

        $savedProfilePic = null;
        $fileExt = null;
        $fileName = null;
        if ($request->hasFile('profile_pic')) {
            $fileExt =  $request->file('profile_pic')->extension();
            $fileName = $request->file('profile_pic')->getClientOriginalName();
            $savedProfilePic = $request->file("profile_pic")->store("public/profile_pics");
        }

        Photo::create([
            'url' => $savedProfilePic,
            'extension' => $fileExt,
            'name' => $fileName,
            'user_id' => Auth::id()
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            'phone' => $request->phone,
            "address" => $request->address,
            "dob" => $request->dob,
            "gender" => $request->gender,

            "password" => Hash::make($request->password),
            // "role" => 'stuff',
            'photo' => $savedProfilePic,
        ]);


        // event(new Registered($user));

        return response()->json([
            "message" => $user
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user->isBan) {
            return response()->json(
                [
                    'message' => "Sorry you are banned "
                ],
                200
            );
        }
        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json(
                [
                    'message' => "Username or password invalid"
                ],
                200
            );
        }

        return Auth::user()->createToken("iphone");
    }

    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(
            [
                'message' => 'logout successful'

            ]
        );
    }


    public function logOutAll(): JsonResponse
    {
        foreach (Auth::user()->tokens as $token) {
            $token->delete();
        }
        return response()->json(
            [
                'message' => 'logout successful'

            ]
        );
    }

    public function devices()
    {
        return Auth::user()->tokens;
    }

    public  function reset(Request $request): JsonResponse
    {

        $optCode = rand(111111, 999999);

        $getUsr = User::where('email', $request->email)->firstOrFail();
        // $getUsr = User::where('email', '=', $request->email)->get();
        // dd($getUsr);
        $getUsr->otp = $optCode;
        // dd($getUsr);

        $getUsr->save();
        return response()->json([
            'the opt code is ' => $optCode
        ]);
    }

    public function newPw(Request $request): JsonResponse
    {
        $getUsr = User::where('email', '=', $request->email)->firstOrFail();
        if (!$getUsr->otp == $request->otp) {
            return response()->json([
                'message' => 'Invalid opt code '
            ]);
        }
        $getUsr->password = $request->new_password;
        $getUsr->update();
        return response()->json([
            'message' => 'update pw complete '
        ]);
    }

    public function Update(Request $request, $id)
    {


        $user = User::findOrFail($id);
        if (is_null($user)) {
            return response()->json([
                'message' => 'user not found'
            ], 404);
        }
        // $request->name ?? $user->name = $request->name;
        // $request->phone ?? $user->phone = $request->phone;
        // $request->address  ?? $user->address  = $request->address;
        // $request->dob ?? $user->dob = $request->dob;
        // $request->gender ?? $user->gender = $request->gender;
        // $request->email ?? $user->email = $request->email;
        // $request->photo ?? $user->photo = $request->photo;
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if ($request->has('address')) {
            $user->address = $request->address;
        }
        if ($request->has('dob')) {
            $user->dob = $request->dob;
        }
        if ($request->has('gender')) {
            $user->gender = $request->gender;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('photo')) {
            $user->photo = $request->photo;
        }


        $user->update();
        return $user;
    }

    public function makeVerify(Request $request)
    {
        return $request;
    }

    public function BanUser(Request $request)
    {
        $id = $request->id;

        $user = User::findOrFail($id);
        $user->isBan = !$user->isBan;
        $user->update();
        return $user;
    }


    public function userProfile()
    {

        $user = User::findOrFail(Auth::id());

        // $data = [
        //     // 'current_pw' => $user->CurrentPassword(),
        //     // 'my_contact' => $user->Contacts,
        //     // 'my_fav' => $user->Favourites,
        //     // 'my_search' => $user->SearchRecords
        // ];
        return $user;
    }

    public function allUsers()
    {
        return User::paginate(5)->withQueryString();
    }
    public function DeleteAccount()
    {
        foreach (Auth::user()->tokens as $token) {
            $token->delete();
        };
        User::where('id', Auth::id())->delete();
        return response()->json([
            'message' => 'you account has been delete '
        ]);
    }
}
