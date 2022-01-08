@extends('layouts.dashboard')

@section('heading', 'List Dosen')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a 
                        class="mr-auto btn btn-primary"
                        href="./lecturers/add"
                    >Tambah Dosen</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lecturers as $lecturer)
                            <tr>
                                <th scope="row">{{$lecturer->lecturer_number}}</th>
                                <td>{{$lecturer->fullname}}</td>
                                <td>{{$lecturer->email}}</td>
                                <td class="d-flex">
                                    <a 
                                        class="btn btn-outline-primary mr-2"
                                        href="./lecturers/{{$lecturer->lecturer_id}}/update"
                                    >Update</a>
                                    <form 
                                        action="./lecturers/{{$lecturer->lecturer_id}}/delete" method="POST"
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