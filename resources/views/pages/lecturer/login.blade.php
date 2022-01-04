@extends('layouts.login')

@section('title', 'Login Dosen')

@section('heading', 'Login Dosen')

@section('form')
<form class="user" action="/lecturer/login" method="POST">
    @csrf
    <div class="form-group">
        <input 
            type="text" 
            class="form-control form-control-user"
            placeholder="NIP"
            value="1112817380"
            name="lecturer_number" />
    </div>
    <div class="form-group">
        <input 
            type="password" 
            class="form-control form-control-user"
            placeholder="Password"
            value="hello"
            name="password" />
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block">
        Login
    </button>
</form>
@endsection