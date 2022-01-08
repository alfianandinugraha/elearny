@extends('layouts.dashboard')

@section('heading', 'List Kelas')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <x-button class="mr-auto" href="./classes/add">Tambah Kelas</x-button>
                </div>
                <div class="card-body">
                    @if(!count($classCourses))
                    <p>Tidak ada kelas</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Dosen</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classCourses as $classCourse)
                            <tr>
                                <td>{{$classCourse->code}}</td>
                                <td>{{$classCourse->class}}</td>
                                <td>{{$classCourse->name}}</td>
                                <td>{{$classCourse->semester}}</td>
                                <td>{{$classCourse->lecturer_name}}</td>
                                <td class="d-flex">
                                    <x-button 
                                        href="./classes/{{$classCourse->class_course_id}}/update"
                                        variant="outline"
                                        class="mr-2"
                                    >
                                        <x-icon icon="pen"/>
                                    </x-button>
                                    <x-button variant="outline" color="danger">
                                        <x-icon icon="trash"/>
                                    </x-button>
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