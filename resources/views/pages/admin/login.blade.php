@extends('layouts.login')

@section('title', 'Login Admin')

@section('heading', 'Login Admin')

@section('form')
<form class="user" action="/admin/login" method="POST">
    @csrf
    <div class="form-group">
        <input 
            type="text" 
            class="form-control form-control-user"
            placeholder="Username"
            value="{{old('username')}}"
            name="username" />
        <x-form.error name="username"/>
    </div>
    <div class="form-group">
        <input 
            type="password" 
            class="form-control form-control-user"
            placeholder="Password"
            value="{{old('password')}}"
            name="password" />
        <x-form.error name="password"/>
        <x-form.error name="failed" />
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block">
        Login
    </button>
</form>
@endsection