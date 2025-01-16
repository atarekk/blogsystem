
# Blog Management System
Build a simple Blog Management System



## Features

- **User Authentication**: Basic HTTP authentication using email and password.
- **Blog Management**:
    - Admin can create, view, update, and delete blog posts.
    - Regular User
        - Ability to view a list of published blog posts.
        - Access to view the details of a single blog post.

## Installation

### Step 1: Clone the Repository

```bash
git clone 
cd project
````
### Step 2: Install Dependencies


```bash
composer install

````

### Step 3: Set Up Environment Variables  and configure your database settings

```bash
cp .env.example .env

````
### Step 4:Run Migrations & seeding

```bash
php artisan migrate
php artisan db:seed


````
### Step 5:Set up file storage

```bash
php artisan storage:link

````
### Step 6:Run the Development Server

```bash
php artisan serve

````
### Step 7: admin panel

```bash
for admin user
email: admin@example.com
password: password

for Regular user
email: user@example.com
password: password
````

## Running Tests

To run tests, run the following command

```bash
 php artisan test
```


## API Reference

#### Authentication
#### User login

```http
 POST /api/v1/login
 ```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. your email |
| `password`      | `string` | **Required**. your password |

#### Response 401

```
{
    "success": false,
    "message": "Invalid credentials"
}
```
#### Response 200

```
{
    "success": true,
    "user": {
        "id": 3,
        "name": "ahmed tarek",
        "username": "asd",
        "email": "ahmed.tarek164@gmail.com",
        "created_at": "2025-01-08T11:39:24.000000Z",
        "updated_at": "2025-01-08T11:39:24.000000Z"
    },
    "token": "3|LficaRGd7yFHjAPVMU7LLKVlZ08iAGA3uPFXHatQ9e4be3c8"
}
```

#### posts
#### Retrieves post listing to the authenticated user.

```http
GET /api/v1/posts
```
#### header
| Parameter | value                   |
| :-------- |:------------------------|
| Authorization      | Bearer <your_token_here>
|

#### get post by id.
```http
get /api/v1/posts/show
```
#### header
| Parameter | value                   |
| :-------- |:------------------------|
| Authorization      | Bearer <your_token_here>|

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `post_id`      | `integer` | **Required**. post id |

### Response

200 ok.
```
{
    "message": "success",
    "data": {
        "id": 11,
        "title": "User Post 6",
        "content": "This is post 6 created by a regular user.",
        "featured_image": null,
        "status": 1,
        "author": {
            "id": 2,
            "name": "Regular User"
        },
        "created_at": "2025-01-15 13:11:29",
        "updated_at": "2025-01-15 13:11:29"
    }
}
```
422 Unprocessable Content.
```

   {
    "message": "The selected post id is invalid.",
    "errors": {
        "post_id": [
            "The selected post id is invalid."
        ]
    }


```
