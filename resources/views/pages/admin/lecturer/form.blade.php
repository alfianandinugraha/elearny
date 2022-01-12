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
        'lecturer_number' => old('lecturer_number') ?? '1112817379',
        'fullname' => old('fullname') ?? 'Dr. Lewis Morissette II',
        'email' => old('email') ?? 'brielle56@yahoo.com',
        'gender' => old('gender') ?? 'male'
    ];
@endphp

@section('heading', $metaData->title)

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12 col-lg-6">
            <x-card>
                <x-slot name="header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Formulir
                    </h6>
                </x-slot>
                <x-slot name="body">
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
                            <x-form.error name="lecturer_number" />
                            <x-form.error name="lecturer_number_exist" />
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                value="{{$lecturer->fullname}}"
                                name="fullname" />
                            <x-form.error name="fullname" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input 
                                type="email" 
                                class="form-control"
                                placeholder="Masukkan email"
                                value="{{$lecturer->email}}"
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
                            <x-form.error name="gender" />
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
                            <x-form.error name="password" />
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            {{$metaData->buttonText}}
                        </button>
                    </form>
                </x-slot>
            </x-card>
        </div>
    </div>
    @endauth
@endsection