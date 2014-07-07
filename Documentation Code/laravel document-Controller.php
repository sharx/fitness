<?php

//Basic Controller
//除了在 routes.php 檔案中定義你所有路由層級的邏輯外，你可能希望使用控制器類別去整理這些處理邏輯，
//控制器可以整合相關的路由邏輯成一個類別，也可以有進階框架功能的優點，像是自動化的 IoC容器
//控制器基本上是存放在 app/controllers 目錄裡，這個目錄已經在預設在 composer.json 
//檔案中的 classmap 選項預設註冊載入。
//這裡有一個基本控制器的範例:
class UserController extends BaseConteoller{
    //show the profile for the given user
    public function showProfile($id){
        $user=User::find($id);
        return View::make('user.profile',array('user'=>user));
    }
}
//所有的控制器必須繼承 BaseController 的類別，BaseController 也存放在 
//app/controllers 的目錄裡，也可以用來放一些共用的控制器邏輯，
//BaseController 繼承了 Laravel 框架的 Controller 類別，
//現在我們可以路由到這個控制的的方法，像這樣:
Route::get('user/{id}','UserController@showProfile');
//如果你選擇用巢狀或 PHP 命名空間 (namespaces) 的方式去組織你的控制器，
//在定義路由時，只要使用完整符合類別名稱的規則即可:
Route::get('foo','Namespace\FooController@method');
//你也可以命名控制器的路由
Route::get('foo',array('uses'=>'FooController@method','as'=>'name'));
//為了產生 URL 指到到控制器，你可以使用 URL::action 的方法:
$url=URL::action('FooController@method');
