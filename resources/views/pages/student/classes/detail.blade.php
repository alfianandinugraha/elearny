@extends('layouts.dashboard')

@section('heading')
Kelas <b>{{$course->name}}</b>
@endsection

@section('content')
    @auth('student')
    <div class="row">
        <div class="col-3">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <b>Informasi Kelas</b>
                </div>
                <div class="card-body">
                    <b class="text-primary">Nama Pengajar</b>
                    <p>{{$course->lecturer_name}}</p>
                    <hr />
                    <b class="text-primary">Email Pengajar</b>
                    <p>{{$course->lecturer_email}}</p>
                    <hr />
                    <b class="text-primary">Semester</b>
                    <p>{{$course->semester}}</p>
                    <hr />
                    <b class="text-primary">Kode</b>
                    <p>{{$course->code}}</p>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <b>{{$course->name}}</b>
                </div>
                <div class="card-body">
                    <p>{{$course->description}}</p>
                    <button 
                        class="ml-auto btn btn-outline-danger"
                    >Keluar Kelas</button>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection