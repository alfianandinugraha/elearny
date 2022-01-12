@extends('layouts.dashboard')
@php
    $metaData = $pageType == 'update' ? (object) [
        'title' => 'Update Dosen',
        'action' => './update',
        'type' => 'update',
        'buttonText' => 'Update',
        'method' => 'PUT'
    ] : (object) [
        'title' => 'Tambah Dosen',
        'action' => './add',
        'type' => 'add',
        'buttonText' => 'Tambah',
        'method' => 'POST'
    ];

    $lecturer = !empty($lecturer) ? $lecturer : (object) [
        'lecturer_number' => '1112817379',
        'fullname' => 'Dr. Lewis Morissette II',
        'email' => 'brielle56@yahoo.com',
        'gender' => 'male'
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
                            <label>NIP</label>
                            <input 
                                type="number" 
                                class="form-control"
                                placeholder="Nomor Induk Pengajar"
                                value="{{$lecturer->lecturer_number}}"
                                name="lecturer_number" />
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                value="{{$lecturer->fullname}}"
                                name="fullname" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input 
                                type="email" 
                                class="form-control"
                                placeholder="Masukkan email"
                                value="{{$lecturer->email}}"
                                name="email" />
                        </div>
                        <div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    id="radio-male" 
                                    value="male"
                                    {{$lecturer->gender == 'male' ? 'checked' : ''}}
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
                                    {{$lecturer->gender == 'female' ? 'checked' : ''}}
                                >
                                <label class="form-check-label" for="radio-female">Wanita</label>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            @if($pageType == 'add')
                            <label>Password</label>
                            <input 
                                type="password" 
                                class="form-control"
                                placeholder="Masukkan password"
                                value="hello"
                                name="password" />
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