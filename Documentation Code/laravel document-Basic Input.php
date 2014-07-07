<?php
//Basic Input Imformation #
//get opt-in data
$name=Input::get('name');
//get opt-in data with default value if no data received.
$name=Input::get('name','Sally');
//distinquish if the opt-in data exit
if(Input::has('name')){
    //
}
//get part of the opt-in data
$input = Input::only('username','password');
$input = Input::except('credit_card');

//Cookies #
//Evey cookies data will encrypted by a catchup code.
//Meaning that laravel will consider it illegal if cookies modified by client.
//get cookies
$value=Cookie::get('name');
//add cookies data in response data
$response = Respone::make('hello world');
$response->withCookie(Cookie::make('name','value',$minutes));
//create a cookie that never fail
$cookie=Cookie::forever('name','value');

//Old input information #
//You may need to preserve user's information before he/ can perform next resquest.
//ie. found data doesn't match format when ask user to enter info. 
//beside echo error message, you might need to show previous info that entered.
//Save user entered info into Session
Input::flash();
//Save part of user entered info into Session
Input::flashOnly('username','email');
Input::flashExcept('password');

//�]���A�i��ݭn�b�N�ϥΪ̾ɦ^���e�������ɡA
//���K�a���ϥΪ̥��e��J�L����ơA
//�A�i�H�z�L²�檺 chain ���覡�b���e�������ϥγo�Ǹ�ơC
return Redirect::to('form')->withInput();
return Redirect::to('form')->withInput(Input::except('password'));
//get old information
Input::old('username');

//File #
//get upload file
$file=Input::file('photo');

#see if upload is completed
if (Input::hasfile('photo')){
    //
}

//move uploaded file
Input::file('photo')->move($destinationPath);
Input::file('photo')->move($destinaationPath,$filename);

//get uploaded file path
$path=Input::file('photo')->getRealPath();

//get uploaded  file size
$size=Input::file('photo')->getSize();

//get uploaded MIME type
$mine=Input::file('photo')->getMimeType();

//Request Information #
//Request ���O���ѳ\�h����k�h�ˬd HTTP �ШD�A
//�äޥΤF Symfony\Component\HttpFoundation\Request ���O�A
//�o�̦��@�Ǭ������I��z�C
//get requesting URI
$uri = Request::path();
//see if the request meet the appoint mode
if(Resquest::is('admin/*')){
    //
}
//get request URL
$url=Request::url();
//get request URI segment
$segment=Request::header('Content-Type');
//retrieve data from $_SERVER
$value=Request::server('PATH_INFO');
//determine to request data by AJAX or not
if (Redirect::ajax()){
    //
}
//determine to request data by HTTPS or not
if (Request::secure()){
    //
}

