@inject("courseModel", "App\Models\Course");

@extends('layouts.dashboard')

@php
$course = !empty($course) ? $course : (object) [
    'code' => old('code') ?? 'RWEB',
    'name' => old('name') ?? 'Rekayasa Web',
    'semester' => old('semester') ?? 5,
    'description' => old('description') ?? "Itaque omnis in est quia. Ea nihil quod et cum. Et optio quae enim."
];

$metaData = $pageType == 'update' ? (object) [
    'title' => 'Update Mata Kuliah',
    'action' => './update',
    'type' => 'update',
    'buttonText' => 'Update',
    'method' => 'PUT'
] : (object) [
    'title' => 'Tambah Mata Kuliah',
    'action' => './add',
    'type' => 'add',
    'buttonText' => 'Tambah',
    'method' => 'POST'
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
                            <label>Kode</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Kode mata kuliah"
                                value="{{$course->code}}"
                                name="code" />
                            <x-form.error name="code" />
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                value="{{$course->name}}"
                                name="name" />
                            <x-form.error name="name" />
                        </div>
                        <div class="form-group mt-2">
                            <label>Semester</label>
                            <select class="form-control" name="semester">
                                @foreach($courseModel::$semesters as $semester)
                                    <option 
                                        value="{{$semester}}"
                                        {{$course->semester == $semester ? 'selected' : ''}}
                                    >{{$semester}}</option>
                                @endforeach
                            </select>
                            <x-form.error name="semester" />
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea 
                                class="form-control"
                                placeholder="Deskripsi mata kuliah"
                                name="description"
                                rows="4"
                            >{{$course->description}}</textarea>
                            <x-form.error name="description" />
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