
# Testing API With Authentization , Authorization 

Contact App API for testing 


# Account Crud 

#### Login (Post)

```http
 {{base_url}}/login
```

| Arguments | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required** 
 |
| `password` | `string` | **Required**  |


### rest  Password (POST)

```http
   {{base_url}}/reset
```
| Arguments | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `emai` | `string` | **Required**  |

### Change Password (POST)

```http
   {{base_url}}/new-pw
```

| Arguments | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `new_password` | `string` | **Required**  |
| `password` | `string` | **Required**  |
| `email` | `string` | **Required**   |
| `otp` | `string` | **Required**  |


### New Password    (POST)

```http
   {{base_url}}/new-pw
```

| Arguments | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `new_password` | `string` | **Required** |
| `password` | `string` | **Required**  |
| `email` | `string` | **Required**  m |
| `otp` | `string` | **Required**  |


 
### Delete  Account   (GET)
need to auth !  
```http
   {{base_url}}/delete-account
```
