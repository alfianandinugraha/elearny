@extends('layouts.dashboard')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat datang, Admin !</h1>
    </div>
    @auth('admin')
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Dosen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$total->lecturers}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Mahasiswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total->student}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Kelas
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{$total->classCourses}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-university fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth

    @auth('admin')
    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Dosen</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lecturers as $lecturer)
                            <tr>
                                <th scope="row">{{$lecturer->lecturer_number}}</th>
                                <td>{{$lecturer->fullname}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="/admin/lecturers" class="btn btn-outline-primary w-100">
                        <i class="fas fa-sm fa-external-link-alt mr-1"></i>
                        Lihat Semua
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NPM</th>
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student as $person)
                            <tr>
                                <th scope="row">{{$person->student_number}}</th>
                                <td>{{$person->fullname}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/admin/student" class="btn btn-outline-primary w-100">
                        <i class="fas fa-sm fa-external-link-alt mr-1"></i>
                        Lihat Semua
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection