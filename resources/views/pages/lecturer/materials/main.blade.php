@extends('layouts.dashboard')

@section('heading', 'List Materi')

@section('content')
    @auth('lecturer')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    @if($hasClass)
                    <a 
                        class="mr-auto btn btn-primary"
                        href="./materials/add"
                    >Tambah Materi</a>
                    @else
                    <button 
                        class="mr-auto btn btn-primary"
                        disabled
                    >Belum ada kelas</button>
                    @endif
                </div>
                <div class="card-body">
                    @if(!count($materials))
                    <p>
                        @if($hasClass)
                        Tidak ada materi, silahkan tambah materi terlebih dahulu
                        @else
                        Tidak ada materi, silahkan hubungi Admin untuk mendapatkan kelas
                        @endif
                    </p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Judul</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($materials as $material)
                            <tr>
                                <td>{{$material->title}}</td>
                                <td>{{$material->class}}</td>
                                <td>{{$material->semester}}</td>
                                <td>{{$material->course_name}}</td>
                                <td class="d-flex">
                                    <a 
                                        href="./materials/{{$material->material_id}}"  
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