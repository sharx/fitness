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
//���� (View) �򥻤W���|�]�t HTML �A���ѧA�������{�������K���NController
//�����}�e�ݧe�{���޿褧�~�A���Ϫ��ɮ׬O�s��b app/views �ؿ����C

//�@��²�������Ϸ|�������o��:
/*
 <!-- View stored in app/views/greeting.php -->
 

<html>
    <body>
        <h1>Hello, <?php echo $name; ?></h1>
    </body>
</html>
 */
 
//�o�ӵ��ϧe�{�b�s�����|�O���o��:
Route::get('/', function()
{
    return View::make('greeting', array('name' => 'Taylor'));
});
//�ǵ� View::make ���ĤG�ӰѼƬO�@�Ӱ}�C��ơA//�o�ǰ}�C�i�H�b���Ϥ��Q�s����:
$view=View::make('greeting',$data);
$view=View::make('greeting')->with('name','Steve');
//�b�W�����Ҥl���A$name �i�H�b���ϸ̳Q�s����A�Ӹ�ƭȷ|�O Steve�C
//�A�]�i�H�b���P�����Ϥ��@�ɳ�������T:
View::share('name','Steve');
//�ǰe�l���Ϩ���Ϥ�

//���ɧA�i��Q�n�N�@�ӵ��Ϫ���ơA�ǰe��t�@�ӵ��Ϥ��e�{�A�|�Ҩӻ��A
//�b�N�l���Ϧs��b app/views/child/view.php ���A�ڭ̥i�H�N���Ǩ�t�@�ӵ��Ϥ��A
//���o��:
$view=View::make('greeting')->nest('child','child.view');
$view=View::make('greeting')->nest('child','child.view',$data);
//�l���ϥi�H�Q�e�{�b������:
/*
<html>
    <body>
        <h1>Hello!</h1>
        <?php echo $child; ?>
    </body>
</html>
*/

//View Composers #
//���� Composer �O�@�Ӧ^�I (callback) �����O����k�A
//����ϳQ�إ߮ɷ|�I�s�o�Ӥ�k�A�p�G�A����ƷQ�n�C�����j�w����ϤW�A
//���� Composer �i�H�N�o�Ǹ�ƾ�X�b�ۦP�a��A
//�]������ Composer �|���O"���Ϫ��ҫ� (view models)"�άO"�e�{�� (presenters)"�C

//define a View composer
View::composer('profile',function($view){
    $view->with('count',User::count());
});
//�{�b�C�� profile ���ϳQ�إ߮ɡAcount ��ƱN�|���Q�j�q�즹���ϡC
//�A�]�i�H�@���N�N���� Composer �j�q��h�ӵ��Ϸ�:
View::composer(array('profile','dashboard'),function($view){
    $view->with('count',User::count());
});
//���p�A�Q�����O����¦�� Composer�A�z�L IoC�e�� 
//�����Υi�H���ѧA�ѨM��h�o�˪����D�A�A�i�H�o�˰�:
View::composer('profile','ProfileComposer');
//�@�ӵ��Ϫ� Composer ���O���ӳQ�w�q�����o��:
class ProfileComposer{
    public function composer($view)
    {
        $view->with('count',User::count());
    }
}
//�Ъ`�N��A�o�̨èS�����󪺳W�x�h���� Composer ���O�n�s�b����˪��a��A
//�A�i�H�N�o�s��b���󪺦a��A�u�n�L�̥i�H�ϥ� composer.json ���ɮװ������A
//�h�����۰ʪ����J�o�����O:

//Special Response #
//�إߤ@�� JSON ��Ʈ榡���^��
return Response::json(array('name'=>'Steve','state'=>'CA'));

return Response::json(array('name'=>'Steve','state'=>'CA'))->setCallBack(Input::get('callback'));

//setup a responds of download
return Response::download($pathToFile);
return Response::download($pathToFile,$name,$headers);
        