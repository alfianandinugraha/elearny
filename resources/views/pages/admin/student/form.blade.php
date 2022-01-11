@extends('layouts.dashboard')
@php
    $metaData = $pageType == 'update' ? (object) [
        'title' => 'Update Mahasiswa',
        'action' => './update',
        'type' => 'update',
        'buttonText' => 'Update',
        'method' => 'PUT'
    ] : (object) [
        'title' => 'Tambah Mahasiswa',
        'action' => './add',
        'type' => 'add',
        'buttonText' => 'Tambah',
        'method' => 'POST'
    ];

    $student = !empty($student) ? $student : (object) [
        'student_number' => old('student_number') ?? '5190411123',
        'fullname' => old('fullname') ?? 'Jennings Littel',
        'email' => old('email') ?? 'okeefe.dion@yahoo.com',
        'gender' => old('gender') ?? 'male'
    ];
@endphp

@section('heading', $metaData->title)

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Formulir
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{$metaData->action}}" method="POST">
                        @csrf
                        @method($metaData->method)
                        <div class="form-group">
                            <label>NIM</label>
                            <input 
                                type="number" 
                                class="form-control"
                                placeholder="Nomor Induk Pengajar"
                                value="{{$student->student_number}}"
                                name="student_number" />
                            <x-form.error name="student_number" />
                            <x-form.error name="student_number_exist" />
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                value="{{$student->fullname}}"
                                name="fullname" />
                            <x-form.error name="fullname" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input 
                                type="email" 
                                class="form-control"
                                placeholder="Masukkan email"
                                value="{{$student->email}}"
                                name="email" />
                            <x-form.error name="email" />
                            <x-form.error name="email_exist" />
                        </div>
                        <div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    id="radio-male" 
                                    value="male"
                                    {{$student->gender == 'male' ? 'checked' : ''}}
                                >
                                <label class="form-check-label" for="radio-male">Pria</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    id="radio-female" 
                                    value="female"
                                    {{$student->gender == 'female' ? 'checked' : ''}}
                                >
                                <label class="form-check-label" for="radio-female">Wanita</label>
                            </div>
                            <x-form.error name="gender" />
                        </div>
                        <div class="form-group mt-2">
                            @if($metaData->type == 'add')
                            <label>Password</label>
                            <input 
                                type="password" 
                                class="form-control"
                                placeholder="Masukkan password"
                                value="hello"
                                name="password" />
                            <x-form.error name="password" />
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            {{$metaData->buttonText}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection