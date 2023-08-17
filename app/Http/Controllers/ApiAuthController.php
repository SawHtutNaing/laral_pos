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
        $this->middleware('isAdmin')->only(['register', 'allUsers']);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            "name" => "required|min:3",
            "email" => "required|email|unique:users",
            "password" => "required",
            'phone' => 'required',
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
        // $request->validate([

        //     'email' => 'required|email',
        //     'password' => 'required|min:8|confirmed'
        // ]);
        // return $request;
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
    }

    public function makeVerify(Request $request)
    {
        return $request;
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
        return User::all();
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
