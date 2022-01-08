@extends('layouts.dashboard')

@section('heading', 'List Materi Perkuliahan')

@section('title', 'List Materi Perkuliahan')

@section('content')
    @auth('student')
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot name="body">
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
                                    <x-button
                                        variant="outline" 
                                        href="./materials/{{$material->material_id}}"  
                                        class="mr-2"
                                    >
                                        <x-icon icon="external-link-alt" />
                                    </x-button>
                                    <a 
                                        variant="outline" 
                                        href="/materials/{{$material->filename}}"  
                                        class="btn btn-outline-primary mr-2"
                                    >
                                        <x-icon icon="download" />
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </x-slot>
            </x-card>
        </div>
    </div>
    @endauth
@endsection