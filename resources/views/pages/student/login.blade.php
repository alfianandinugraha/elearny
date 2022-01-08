@extends('layouts.login')

@section('title', 'Login Mahasiswa')

@section('heading', 'Login Mahasiswa')

@section('form')
<form class="user" action="/student/login" method="POST">
    @csrf
    <div class="form-group">
        <input 
            type="text" 
            class="form-control form-control-user"
            placeholder="NIM"
            value="5190411000"
            name="student_number" />
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