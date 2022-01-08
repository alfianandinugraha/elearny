@extends('layouts.dashboard')

@section('heading')
Selamat Datang, <b>{{Auth::guard('student')->user()->fullname}}</b> !
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Kelas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalClass}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Materi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalMaterial}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-scroll fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Akses Kelas</h6>
                </div>
                <div class="card-body">
                    @if(!count($classes))
                    <p>Tidak ada kelas</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $class)
                            <tr>
                                <th scope="row">{{$class->course_name}}</th>
                                <td scope="row">{{$class->class}}</td>
                                <td scope="row">{{$class->semester}}</td>
                                <td scope="row">
                                    <a 
                                        href="/student/classes/{{$class->class_course_id}}"
                                        class="btn btn-outline-primary"
                                    >
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/student/classes" class="btn btn-outline-primary w-100">
                        <i class="fas fa-sm fa-external-link-alt mr-1"></i>
                        Lihat Semua
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Materi</h6>
                </div>
                <div class="card-body">
                    @if(!count($materials))
                    <p>Belum ada materi</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Judul</th>
                                <th scope="col">Kode Mata Kuliah</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materials as $material)
                            <tr>
                                <th scope="row">{{$material->title}}</th>
                                <td scope="row">{{$material->code}}</td>
                                <td scope="row">
                                    <a 
                                        href="/student/materials/{{$material->material_id}}"
                                        class="btn btn-outline-primary"
                                    >
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/student/materials" class="btn btn-outline-primary w-100">
                        <i class="fas fa-sm fa-external-link-alt mr-1"></i>
                        Lihat Semua
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection