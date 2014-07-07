<?php

//Basic Response #
//get string from route
Route::get('/',function(){
    return 'hello world';
});
//create custom response
$response=Request::make($contents,$statusCode);
$response->header('Content-Type',$value);
return $response;
//add cookies data to response
$cookie=Cookie::make('name','value');
return Response::make($content)->withCookie($cookie);

//Redirect #
//Return redirect to appoint link
return Redirect::to('user/login');
//Return redirect to route with appoint name
return Redirect::route('login');
//Return redirect to route with appoint name, and add variable value
return Redirect::route('profile',array(1));
//Return redirect to route with appoint name, and add named variable value
return Redirect::route('profile',array('user'=>1));
//Return redirect to appoint controller action
return Redirect::action('HomeController@index');
//Return redirect to appoint controller actionl, and add variable value
return Redirect::action('UserController@profile',array(1));
//Return redirect to appoint controller actionl, and add named variable value
return Redirect::action('UserControll@profile',array('user=>1'));

//View #
//視圖 (View) 基本上都會包含 HTML ，提供你的網頁程式能夠方便的將Controller
//抽離開前端呈現的邏輯之外，視圖的檔案是存放在 app/views 目錄中。

//一個簡易的視圖會長成像這樣:
/*
 <!-- View stored in app/views/greeting.php -->
 

<html>
    <body>
        <h1>Hello, <?php echo $name; ?></h1>
    </body>
</html>
 */
 
//這個視圖呈現在瀏覽器會是像這樣:
Route::get('/', function()
{
    return View::make('greeting', array('name' => 'Taylor'));
});
//傳給 View::make 的第二個參數是一個陣列資料，//這些陣列可以在視圖中被存取到:
$view=View::make('greeting',$data);
$view=View::make('greeting')->with('name','Steve');
//在上面的例子中，$name 可以在視圖裡被存取到，而資料值會是 Steve。
//你也可以在不同的視圖中共享部分的資訊:
View::share('name','Steve');
//傳送子視圖到視圖中

//有時你可能想要將一個視圖的資料，傳送到另一個視圖中呈現，舉例來說，
//在將子視圖存放在 app/views/child/view.php 中，我們可以將它傳到另一個視圖中，
//像這樣:
$view=View::make('greeting')->nest('child','child.view');
$view=View::make('greeting')->nest('child','child.view',$data);
//子視圖可以被呈現在母視圖:
/*
<html>
    <body>
        <h1>Hello!</h1>
        <?php echo $child; ?>
    </body>
</html>
*/

//View Composers #
//視圖 Composer 是一個回呼 (callback) 或類別的方法，
//當視圖被建立時會呼叫這個方法，如果你有資料想要每次都綁定到視圖上，
//視圖 Composer 可以將這些資料整合在相同地方，
//因此視圖 Composer 會像是"視圖的模型 (view models)"或是"呈現器 (presenters)"。

//define a View composer
View::composer('profile',function($view){
    $view->with('count',User::count());
});
//現在每次 profile 視圖被建立時，count 資料將會都被綁訂到此視圖。
//你也可以一次就將視圖 Composer 綁訂到多個視圖當中:
View::composer(array('profile','dashboard'),function($view){
    $view->with('count',User::count());
});
//假如你想用類別為基礎的 Composer，透過 IoC容器 
//的應用可以提供你解決更多這樣的問題，你可以這樣做:
View::composer('profile','ProfileComposer');
//一個視圖的 Composer 類別應該被定義成像這樣:
class ProfileComposer{
    public function composer($view)
    {
        $view->with('count',User::count());
    }
}
//請注意到，這裡並沒有任何的規矩去限制 Composer 類別要存在什麼樣的地方，
//你可以將她存放在任何的地方，只要他們可以使用 composer.json 的檔案做紀錄，
//去直接自動的載入這個類別:

//Special Response #
//建立一個 JSON 資料格式的回應
return Response::json(array('name'=>'Steve','state'=>'CA'));

return Response::json(array('name'=>'Steve','state'=>'CA'))->setCallBack(Input::get('callback'));

//setup a responds of download
return Response::download($pathToFile);
return Response::download($pathToFile,$name,$headers);
        