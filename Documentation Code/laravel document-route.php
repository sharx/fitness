<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route parameter #
Route::post('foo/bar',function(){
    return 'hello bar';
});

//handel all kinds of request: get, post,put, delete  #
Route::any('foo',function(){
    return 'hello foo';
});

//force route go throght HTTPS's encripted connection #
Route::get('foo', array('https', function(){
    return 'Must be over https';
}));

//generate a url to a defined route #
$url=URL::to('foo');
        
//route variable #
Route::get('user/{id}',function($id){
    return 'User '.$id;
});
//optional route variable name #
Route::get('user/{name?}', function($name=NULL){
    return $name;
});
//route variable with default value #
Route::get('user/{name?}',function($name='John'){
    return $name;
});
//restrict route name with formal format #
Route::get('user/{name}',function($name){
    //
})
->where('naem','[A-Za-z\+');

Route::get('user/{id}',function($id){
    //
})
->where('$id','[0-9]+');

////////////* Route filter*/////////////
//if the filter return a response, it'll considered as the resonse of 
//request. The request and action after this route will not be executed.
//Any after filter on the route will not be executed as well.


Route::filter('old',function(){
    if(Input::get('age'<200))
    {    return Redirect::to('home');}
});

 //Load a filter on route #
 
Route::get('user',array('before'=>'old',function(){
    return 'You are over 200 years old!';
}));


//Load multi-filters on route #
Route::get('user',array('before'=>'auth'|'old',function(){
    return 'You are autherticated and over 200 years old!';
}));
 

//Appointed filter parameter #
 Route::filter('age',function($route,$request,$value){ 
    //
});
Route::get('user',array('before'=>'age:200',function(){
    return 'Hello World';
}));


//Filter base on mode #

Route::filter('admin',function(){
    //
});
//admin filter will execute when route name start with admin/
Route::when('admin/*','admin');
//You can also limit mode filter execute under HTTP request
Route::when('admin/*','admin',array('post'));


////////////* Route Naming*/////////////
//Route naming let us can point to the route easier when we generate "Redirect" or "URL".

//Appoint a route name #
Route::get('user/profile',array('as'=>'profile',function(){
    //
}));


//Appoint a route name to any method of controller
Route::get('user/profile', array('as'=>'profile','uses'=>
        'UserController@showProfile'));
//You can use route name when generating "Redirect" or "URL" now.
$url=URL::route('profile');
$redirect=Redirect::route('profile');
//You can get current route name using 'currentRouteName'
$name=Route::currentRouteName();

//Route group #
//sometimes you may need to apply filter to a route group.
//Besides appoint to every method of route name, you can appoint 
//the routes to be filter by using route group.
Route::group(array('before'=>'auth'),function(){
    Route::get('/',function(){
        //has auth filter
    });
    
    Route::get('user/profile',function(){
        //has auth filter
    });
});


//Sub-domain route #
//Laravel route can handle the sub-domain of universal charactor.
//Transfer a universal charactor parameter to the domain.
//Registering Sub-Domain Route:
Route::group(array('domain'=>'{account}.myapp.com'),function(){
    Route::get('user/{id}', function($account,$id){
        //
    });
});


//Route prefix
//a grouped route can use the option 'prefix' as the prefix of the route.
Route::group(array('prefix'=>'admin'),function(){
    Route::get('user',function(){
        //
    });
});


//Route model binding #
//Model can bind to your route conveniently, ie besides binding user id to
//the route, you can also bind the whole user model to the route to access
//the model route which fit the data of user id.
//Binding parameter to Model:
Route::model('user','User');
//Define a route contains the parameter {user}
Route::get('profile/{user}',function(User $user){
    //
});
//Thus we already bind the parameter {user} to the model User. The model
//User will practiced on the route. For example, if there a 'profile/1' 
//request to the route, it will numbered as the #1 user of model User.
//Note: If the data not found in database, it'll have 404error
//If wanna define the action after "Not found", pass a closure function 
//at the third parameter
Route::model('user','User',function(){
    throw new NotFoundException;
});

//sometimes you may wannna use your own route parameter to analyze route.
//simply use Route::bind
Rounte::bind('user',function($value,$route){
    return User::where('name',$value)->first();
});

//Throw 404 error #
//there are two ways to triger error message 404 manually.
App::about(404);



Route::get('users',function()
{  
    $users=DB::select('select * from users');
    $env=App::environment();
    //return $env;
    return View::make('users')->with('users',$users);
});