<?php

//Basic Controller
//���F�b routes.php �ɮפ��w�q�A�Ҧ����Ѽh�Ū��޿�~�A�A�i��Ʊ�ϥα�����O�h��z�o�ǳB�z�޿�A
//����i�H��X�����������޿覨�@�����O�A�]�i�H���i���ج[�\�઺�u�I�A���O�۰ʤƪ� IoC�e��
//����򥻤W�O�s��b app/controllers �ؿ��̡A�o�ӥؿ��w�g�b�w�]�b composer.json 
//�ɮפ��� classmap �ﶵ�w�]���U���J�C
//�o�̦��@�Ӱ򥻱�����d��:
class UserController extends BaseConteoller{
    //show the profile for the given user
    public function showProfile($id){
        $user=User::find($id);
        return View::make('user.profile',array('user'=>user));
    }
}
//�Ҧ�����������~�� BaseController �����O�ABaseController �]�s��b 
//app/controllers ���ؿ��̡A�]�i�H�Ψө�@�Ǧ@�Ϊ�����޿�A
//BaseController �~�ӤF Laravel �ج[�� Controller ���O�A
//�{�b�ڭ̥i�H���Ѩ�o�ӱ������k�A���o��:
Route::get('user/{id}','UserController@showProfile');
//�p�G�A��ܥα_���� PHP �R�W�Ŷ� (namespaces) ���覡�h��´�A������A
//�b�w�q���ѮɡA�u�n�ϥΧ���ŦX���O�W�٪��W�h�Y�i:
Route::get('foo','Namespace\FooController@method');
//�A�]�i�H�R�W���������
Route::get('foo',array('uses'=>'FooController@method','as'=>'name'));
//���F���� URL ����챱��A�A�i�H�ϥ� URL::action ����k:
$url=URL::action('FooController@method');
