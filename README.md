[post man doc](https://documenter.getpostman.com/view/25080326/2s9Xxzts4K)

# auth

# login (Post)

> {{base_url}}/login

| name | gmail                                 | password | password_confirmation |
| :--- | :------------------------------------ | :------- | :-------------------- |
| saw  | [saw@gmail.com](mailto:saw@gmail.com) | 1111     | 1111                  |

# inventory

## Brand

### store( POST)

> {{base_url}}/user/brand

| name    | company         | information        |
| :------ | :-------------- | :----------------- |
| Mar Mar | Mar Mar com.ltd | excellent provider |

### show(GET)

{{base_url}}/user/brand/{id}

### update (partial_update) (PUT / PATCH)

| name    | company         | information |
| :------ | :-------------- | :---------- |
| Yum Yum | Yun Yun com.ltd | top seller  |
|         |                 |             |

### delete (DELETE)

{{base_url}}/user/brand/{id}

### index (GET)

{{base_url}}/user/brand

## Product

### index (GET)

{{base_url}}/user/product

### store( POST)

> {{base_url}}/user/product

| name           | brand_id | actually_price | sales_price | total_stock | unit | more_information   |
| :------------- | :------- | :------------- | :---------- | :---------- | :--- | :----------------- |
| instant noddle | 1        | 700            | 1000        | 50          | bags | kan san mal pr tee |

### store( POST)

> {{base_url}}/user/product/{id}

| name           | brand_id | actually_price | sales_price | total_stock | unit | more_information |
| :------------- | :------- | :------------- | :---------- | :---------- | :--- | :--------------- |
| instant noddle | 2        | 800            | 1100        | 100         | bags | No extra info    |

### delete (DELETE))

> {{base_url}}/user/product/{id}

### show (GET))

> {{base_url}}/user/product/{id}

### Sales (POST)

| cus_name | tax |
| :------- | :-- |
| ko aung  | 5   |

| product_id | quantity |
| :--------- | :------- |
| 1          | 20       |
| 2          | 20       |
| 5          | 20       |

> 📘 it will return a array of product model and its total_stock is update . When Sales routes is called ..
> 
> you need to put the cus_name and tax once then put the product_id and quantity .
> 
> ```json
> {
>     "info": {
>         "cus_name": "ko mg mg ",
>         "tax": 5
>     },
>     "data": [
>         {
>             "product_id": 101,
>             "quantity": 20
>         }
>     ]
> }
> 
> ```
> 
> - [ ] update the stock
> - [ ] create the voucher
> - [ ] create each voucher records with the id from step 2 
> - [ ] return the voucher  containing its voucher_records

## stock

### index(GET)

{{base_url}}/user/stock

### show(GET)

{{base_url}}/user/stock/{id}

### store (POST)

{{base_url}}/user/stock

| product_id | quantity | more    |
| :--------- | :------- | :------ |
| 1          | 20       | xxxxxxx |
|            |          |         |

> 📘 the more column will get its data from the more_information column from the product

### Delete (DELETE)

{{base_url}}/user/stock/{id}

# sales

## Vouncher

### index (GET)

{{base_url}}/user/vouncher

### create (POST)

| name  | tax |
| :---- | :-- |
| mg mg | 5   |
|       |     |

### delete (DELETE)

{{base_url}}/user/vouncher/{id}

> 🚧 when you delete it . its vouncher_records will delete automatically

## vouncher_records

### index (GET)

{{base_url}}/user/vouncher-record

### create (POST)

{{base_url}}/user/vouncher-record/

| vouncher_id | product_id | quantity |
| :---------- | :--------- | :------- |
| 1           | 1          | 10       |
|             |            |          |

### show (GET)

{{base_url}}/user/vouncher-record/{id}

### delete (DELETE)

{{base_url}}/user/vouncher-record/{id}

# User profile

### create(register) (POST)

| name  | email                                   | password | | profile_pic |   | phone    |       | address    |
| :---- | :-------------------------------------- | :------- |  | :-------   | |:-------    |       | :-------    |      
| ko ko | [koko@gmail.com](mailto:koko@gmail.com) | password |  | url        |   | 09xxxxxxxx |     | Yangon , Yankin    |

### deletet account (DELETE)

{{base_url}}/user/delete-account 

> 📘 delete the account that login . your activities (that use your_id )  will not changes to keep record .

### get all devices (GET)

{{base_url}}/user/devices

### get profile (GET)

{{base_url}}/user/user-profile

### get profile (GET) only for admin usr

{{base_url}}/user/all-users 



### reset pw (POST)

| email                                 |
| :------------------------------------ |
| [saw@gmail.com](mailto:saw@gmail.com) |
|                                       |

### nw ps (POST)

| email                                 | otp              | new_password |
| :------------------------------------ | :--------------- | :----------- |
| [saw@gmail.com](mailto:saw@gmail.com) | xxxxxx (count_6) | xxxxxx       |

### logout

{{base_url}}/user/logout (GET)

{{base_url}}/user/logout-all (GET)


## media 

### all media 
{{base_url}}/user/photo

### delete media (for admin)

{{base_url}}/user/photo/{id}
