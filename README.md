
### Category & Sub Categiry Management system.

## Requirements

- PHP >= 8.1

## How it works

To access the Category & Subcategory Management application, you must first log in as an admin. If you don't have an account, click the register button to sign up. After registration, you can log in to the software. Once logged in, you'll see a "Category" button, where you can create categories and subcategories. You can export these categories as a `categories.zip` file in JSON format and import categories using the same format. Additionally, there's a "Blog" button on the sidebar, which allows you to easily create blogs using the categories and subcategories you've set up.  


## Features

1. Category modules
2. Blogs modules

## Installation

### Clone the repository
Please follow carefully the installation and use of this web framework of the Category & Sub Categiry Management system for better utilisation of it. Do not skip any stage.

```bash
1. git clone https://github.com/neamat33/category-managent.git
2. composer update
3. copy .env.example .env and set DB Credentials
4. php artisan key:generate
5. php artisan migrate
6. php artisan serve

```
Finally start the application as usual. Add `/admin` to your localhost url to access the login page e.g if your localhost is `http://127.0.0.1` then the login will be `http://127.0.0.1/admin` 

```bash
Set up email notifications using [Mailtrap](https://mailtrap.io). Copy the mail credentials for your Laravel app from Mailtrap and update the corresponding settings in your `.env` file.
```



