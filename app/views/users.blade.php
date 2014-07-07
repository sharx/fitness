@extends('layout')

@section('content')
	@foreach($users as $user)
        <p>{{$user->username, '</br>' ,$user->email}}</p>
        @endforeach
@stop