@extends('layouts.dashboard')

@section('heading', 'List Mata Kuliah')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a 
                        class="mr-auto btn btn-primary"
                        href="./courses/add"
                    >Tambah Mata Kuliah</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{$course->course_id}}</td>
                                <td>{{$course->name}}</td>
                                <td>{{$course->description}}</td>
                                <td>6</td>
                                <td class="d-flex">
                                    <a 
                                        class="btn btn-outline-primary mr-2"
                                        href="./lecturers/update/{{$course->course_id}}"
                                    >Update</a>
                                    <form 
                                        action="./lecturers/delete/{{$course->course_id}}" method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger">Hapus</button>
                                    </form>
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