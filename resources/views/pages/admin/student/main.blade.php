@extends('layouts.dashboard')

@section('content')
    @auth('admin')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Mahasiswa</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a 
                        class="mr-auto btn btn-primary"
                        href="./student/add"
                    >Tambah Mahasiswa</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $person)
                            <tr>
                                <th scope="row">{{$person->student_number}}</th>
                                <td>{{$person->fullname}}</td>
                                <td>{{$person->email}}</td>
                                <td class="d-flex">
                                    <a 
                                        class="btn btn-outline-primary mr-2"
                                        href="./student/update/{{$person->student_id}}"
                                    >Update</a>
                                    <form 
                                        action="./student/delete/{{$person->student_id}}" method="POST"
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