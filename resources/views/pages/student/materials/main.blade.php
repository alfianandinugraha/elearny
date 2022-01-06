@extends('layouts.dashboard')

@section('heading', 'List Materi Perkuliahan')

@section('content')
    @auth('student')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @if(!count($materials))
                    <p>Belum ada materi</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Judul</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Dosen</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($materials as $material)
                            <tr>
                                <td>{{$material->title}}</td>
                                <td>{{$material->course_name}}</td>
                                <td>{{$material->class}}</td>
                                <td>{{$material->lecturer_name}}</td>
                                <td class="d-flex">
                                    <a 
                                        href="./materials/{{$material->material_id}}"  
                                        class="btn btn-outline-primary mr-2"
                                    >
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a 
                                        href="/materials/{{$material->material_id}}"  
                                        class="btn btn-outline-primary mr-2"
                                    >
                                        <i class="fas fa-download"></i>
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