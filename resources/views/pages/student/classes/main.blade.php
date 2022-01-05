@extends('layouts.dashboard')

@section('heading', 'List Kelas Yang Diambil')

@section('content')
    @auth('student')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a 
                        class="mr-auto btn btn-primary"
                        href="./classes/search"
                    >Ambil Kelas</a>
                </div>
                <div class="card-body">
                    @if(!count($classCourses))
                    <p>Belum ada kelas yang diambil</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Dosen</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($classCourses as $classCourse)
                            <tr>
                                <th>{{$classCourse->code}}</th>
                                <td>{{$classCourse->name}}</td>
                                <td>{{$classCourse->class}}</td>
                                <td>{{$classCourse->semester}}</td>
                                <td>{{$classCourse->lecturer_name}}</td>
                                <td class="d-flex">
                                    <a 
                                        href="./classes/{{$classCourse->class_course_id}}"  
                                        class="btn btn-outline-primary mr-2"
                                    >
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection