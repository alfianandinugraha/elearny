@extends('layouts.dashboard')

@section('heading', 'List Kelas')

@section('content')
    @auth('lecturer')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Token</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <th>{{$course->code}}</th>
                                <td>{{$course->name}}</td>
                                <td>{{$course->class}}</td>
                                <td>{{$course->semester}}</td>
                                <td>
                                    {!! $course->token ? 
                                        $course->token : '<span class="text-danger">Belum ada</span>'
                                    !!}
                                </td>
                                <td class="d-flex">
                                    <a 
                                        href="./classes/{{$course->class_course_id}}"  
                                        class="btn btn-outline-primary mr-2"
                                    >
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a 
                                        class="btn btn-outline-primary mr-2"
                                        href="./classes/{{$course->class_course_id}}/update"
                                    >Update</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection