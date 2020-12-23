<?php

return [
    '/' => "GET:UserController@index",
    'pwd' => function() {
        echo md5("sandinepodo");
    },
    'read/{slug}' => "GET:UserController@read",
    'search' => "GET:UserController@search",
    'latest' => "GET:UserController@latest",
    'account' => "GET:UserController@account",
    'account/update' => "POST:UserController@updateAccount",
    'error/404' => "GET:UserController@error",
    'login' => "GET:UserController@loginPage",
    'logout' => "GET:UserController@logout",
    'history' => "GET:UserController@history",
    'loginWithGoogle' => "POST:UserController@loginWithGoogle",
    
    'get-started' => "GET:UserController@getStarted",
    'get-started/submit' => "POST:UserController@getStartedSubmit",
    
    'get-premium' => "GET:UserController@getPremium",
    'get-premium/submit' => "POST:UserController@bePremium",
    'get-premium/success' => "GET:UserController@getPremiumSuccess",

    'category/{category}' => "GET:UserController@category",
    'category/{category}/delete' => "GET:CategoryController@delete",

    'comment/store' => "POST:CommentController@store",
    'comment/{id}/delete' => "GET:CommentController@delete",
    
    'admin/login' => "GET:AdminController@loginPage",
    'admin/loginAction' => "POST:AdminController@login",
    'admin/logout' => "GET:AdminController@logout",
    'admin/dashboard' => "GET:AdminController@dashboard",
    
    'admin/category' => "GET:AdminController@category",
    'admin/category/add' => "GET:CategoryController@add",
    'admin/category/store' => "POST:CategoryController@store",
    
    'admin/post' => "GET:AdminController@post",
    'admin/post/create' => "GET:PostController@create",
    'admin/post/store' => "POST:PostController@store",
    'admin/post/{id}/edit' => "GET:PostController@edit",
    'admin/post/{id}/update' => "POST:PostController@update",
    'admin/post/{id}/delete' => "GET:PostController@delete",

    'admin/post/{id}/comments' => "GET:AdminController@postComments",

    'admin/media' => "GET:AdminController@media",
    'admin/media/load' => "GET:MediaController@load",
    'admin/media/upload' => "POST:MediaController@upload",

    'admin/user' => "GET:AdminController@user",
    'admin/user/update' => "POST:AdminController@updateUser",
    
    'admin/acceptPremium/{userID}' => "GET:AdminController@acceptPremium",
];
