# [APLIKASI PENGAJUAN PKL]

![version](https://img.shields.io/badge/version-1.0.0-blue.svg) 
![license](https://img.shields.io/badge/license-MIT-blue.svg)
[![GitHub issues open](https://img.shields.io/github/issues/creativetimofficial/soft-ui-dashboard-laravel.svg)](https://github.com/creativetimofficial/soft-ui-dashboard-laravel/issues?q=is%3Aopen+is%3Aissue) 
[![GitHub issues closed](https://img.shields.io/github/issues-closed-raw/creativetimofficial/soft-ui-dashboard-laravel.svg)](https://github.com/creativetimofficial/soft-ui-dashboard-laravel/issues?q=is%3Aissue+is%3Aclosed)

[<img src="https://s3.amazonaws.com/creativetim_bucket/products/602/original/soft-ui-dashboard-laravel.jpg" width="100%" />](https://soft-ui-dashboard-laravel.creative-tim.com/dashboard) 

## Table of Contents

* [Prerequisites](#prerequisites)
* [Installation](#installation)
* [Usage](#usage)
* [Versions](#versions)
* [Documentation](#documentation)
* [Login](#login)
* [Dashboard](#dashboard)
* [Pengajuan](#pengajuan)
* [Master Data](#master_data)

## Prerequisites

If you don't already have an Apache local environment with PHP and MySQL, use one of the following links:

-   Windows: https://updivision.com/blog/post/beginner-s-guide-to-setting-up-your-local-development-environment-on-windows
-   Linux & Mac: https://updivision.com/blog/post/guide-what-is-lamp-and-how-to-install-it-on-ubuntu-and-macos

Also, you will need to install Composer: https://getcomposer.org/doc/00-intro.md  
And Laravel: https://laravel.com/docs/10.x


## Installation

1. Unzip the downloaded archive
2. Copy and paste **soft-ui-dashboard-laravel-master** folder in your **projects** folder. Rename the folder to your project's name
3. In your terminal run `composer install`
4. Copy `.env.example` to `.env` and updated the configurations (mainly the database configuration)
5. In your terminal run `php artisan key:generate`
6. Run `php artisan migrate --seed` to create the database tables and seed the roles and users tables
7. Run `php artisan storage:link` to create the storage symlink (if you are using **Vagrant** with **Homestead** for development, remember to ssh into your virtual machine and run the command from there).

## Usage
Register a user or login with default user **admin@smkangkasa1margahayu.com** and password **secret** from your database and start testing (make sure to run the migrations and seeders for these credentials to be available).

Besides the dashboard, the auth pages, the billing and table pages, there is also has an edit profile page. All the necessary files are installed out of the box and all the needed routes are added to `routes/web.php`. Keep in mind that all of the features can be viewed once you login using the credentials provided or by registering your own user. 

## Versions
[<img src="https://github.com/creativetimofficial/public-assets/blob/master/logos/html-logo.jpg?raw=true" width="60" height="60" />](https://demos.creative-tim.com/argon-dashboard-pro/pages/dashboards/dashboard.html?ref=sudl-readme)
[<img src="https://github.com/creativetimofficial/public-assets/blob/master/logos/laravel_logo.png?raw=true" width="60" height="60" />](https://argon-dashboard-pro-laravel.creative-tim.com/?ref=sudl-readme)

| HTML | Laravel |
| --- | --- |
| [![HTML](https://s3.amazonaws.com/creativetim_bucket/products/450/thumb/opt_sd_free_thumbnail.jpg)](https://www.creative-tim.com/product/soft-ui-dashboard) | [![Laravel](https://s3.amazonaws.com/creativetim_bucket/products/602/thumb/soft-ui-dashboard-laravel.jpg?1647531884)](https://www.creative-tim.com/product/soft-ui-dashboard-laravel)  | 

## Demo
| Login | Dashboard | Pengajuan |
| --- | ---  | --- |
| [<img src="https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/login.png" width="322" />](https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/login.png)  | [<img src="https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/dashboard.png" width="322" />](https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/dashboard.png)  | [<img src="https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/pengajuan_surat.png" width="322" />](https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/pengajuan_surat.png)

| Jurusan | Perusahaan | Program |
| --- | ---  | --- |
| [<img src="https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/jurusan.png" width="322" />](https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/jurusan.png)  | [<img src="https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/perusahaan.png" width="322" />](https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/perusahaan.png)  | [<img src="https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/program.png" width="322" />](https://github.com/dzerlangga/Pengajuan_PKL/blob/master/public/assets/img/example/program.png)

### Login
If you are not logged in you can only access this page or the Sign Up page. The default url takes you to the login page where you use the default credentials **admin@smkangkasa1margahayu.com** with the password **secret**. Logging in is possible only with already existing credentials. For this to work you should have run the migrations.

The `App\Http\Controllers\SessionController` handles the logging in of an existing user.

```
       public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect('dashboard');
        }
        else{

            return back();
        }
    }
```

### My Profile
The profile can be accessed by a logged in user by clicking "**User Profile**" from the sidebar or adding **/user-profile** in the url. The user can add information like birthday, gender, phone number, location, language  or skills.

The `App\Http\Controllers\InfoUserController` handles the user's profile information.

```
    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
        ]);
        
        User::where('id',Auth::user()->id)
        ->update([
            'name'    => $attributes['name'],
            'email' => $attribute['email'],
            'phone'     => $attributes['phone'],
            'location' => $attributes['location'],
            'about_me'    => $attributes["about_me"],
        ]);

        return redirect('/user-profile');
    }
```

### Dashboard
You can access the dashboard either by using the "**Dashboard**" link in the left sidebar or by adding **/dashboard** in the url after logging in. 

## File Structure
```
app
├── Console
│   └── Kernel.php
├── Exceptions
│   └── Handler.php
├── Http
│   ├── Controllers
│   │   └── ChangePasswordController.php
│   │   └──Controller.php
│   │   └──HomeController.php
│   │   └──InfoUserController.php
│   │   └──RegisterController.php
│   │   └──ResetController.php
│   │   └──SessionController.php
│   ├── Kernel.php
│   └── Middleware
│       ├── Authenticate.php
│       ├── EncryptCookies.php
│       ├── PreventRequestsDuringMaintenance.php
│       ├── RedirectIfAuthenticated.php
│       ├── TrimStrings.php
│       ├── TrustHosts.php
│       ├── TrustProxies.php
│       └── VerifyCsrfToken.php
├── Models
│   └── User.php
├── Policies
│   └── UsersPolicy.php
├── Providers
│   ├── AppServiceProvider.php
│   ├── AuthServiceProvider.php
│   ├── BroadcastServiceProvider.php
│   ├── EventServiceProvider.php
│   └── RouteServiceProvider.php
config
├── app.php
├── auth.php
├── broadcasting.php
├── cache.php
├── cors.php
├── database.php
├── filesystems.php
├── hashing.php
├── logging.php
├── mail.php
├── queue.php
├── sanctum.php
├── services.php
├── session.php
├── view.php
|       
database
|   ├──factories
|   |       UserFactory.php
|   |       
|   ├──migrations
|   |       2014_10_12_000000_create_users_table.php
|   |       2014_10_12_100000_create_password_resets_table.php
|   |       2019_08_19_000000_create_failed_jobs_table.php
|   |       2019_12_14_000001_create_personal_access_tokens_table.php
|   |       
|   └──seeds
|           DatabaseSeeder.php
|           UserSeeder.php
|           
+---public
|   |   .htaccess
|   |   favicon.ico
|   |   index.php
|   |   
|   +---css
|   |       app.css
|   |       soft-ui-dashboard.css
|   +---js
|   |       app.js
|   |       
|   +---assets
|   |       demo.css
|   |       docs-soft.css
|   |       docs.js
|   |
|   |   +---css
|   |   |   |   nucleo-icons.css
|   |   |   |   nucleo-svg.css
|   |   |   |   soft-ui-dashboard.css
|   |   |   |   soft-ui-dashboard.css.map
|   |   |   └── soft-ui-dashboard.min.css
|   |   |                                 
|   +---+---js
|           |   soft-ui--dashboard.js
|           |   soft-ui--dashboard.js.map
|           |   soft-ui--dashboard.min.js
|           |   
|           +---core
|                   bootstrap.bundle.min.js
|                   bootstrap.min.js
|                   popper.min.js
|                    
+---resources
|   +---lang
|   |   \---en
|   |           auth.php
|   |           pagination.php
|   |           passwords.php
|   |           validation.php
|   |           
|   \---views
|       |                 
|       +---components
|       |       fixed-plugins.blade.php
|       |      
|       +---laravel-example
|       |        user-management.blade.php
|       |        user-profile.blade.php
|       |      
|       +---layouts
|       |   |   
|       |   +---footers
|       |   |   |
|       |   |   +--auth
|       |   |   |     footer.blade.php
|       |   |   +--guest
|       |   |         footer.blade.php
|       |   |
|       |   +---navbars
|       |       |  app.blade.php
|       |       |
|       |       +--auth
|       |       |     nav-rtl.blade.php
|       |       |     nav.blade.php
|       |       |     sidebar-rtl.blade.php
|       |       |     sidebar.blade.php
|       |       +--guest
|       |       |     nav.blade.php
|       |       |     
|       |       +--user_type
|       |           auth.blade.php
|       |           guest.blade.php
|       |           
|       +---session
|       |   |   login-session.blade.php
|       |   |   register.blade.php
|       |   |   
|       |   +---reset-password
|       |           resetPassword.blade.php
|       |           sendEmail.blade.php
|       |       
|       billing.blade.php
|       dashboard.blade.php
|       profile.blade.php
|       rtl.blade.php
|       static-sign-in.blade.php
|       static-sign-up.blade.php
|       tables.blade.php
|       virtual-reality.blade.php
|                      
+---routes
|       api.php
|       channels.php
|       console.php
|       web.php
```

## Browser Support
At present, we officially aim to support the last two versions of the following browsers:

<img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/chrome.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/firefox.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/edge.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/safari.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/opera.png" width="64" height="64">

## Requaired PHP Version
- ">= 8.2.0"
