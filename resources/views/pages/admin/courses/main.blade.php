@extends('layouts.dashboard')

@section('heading', 'List Mata Kuliah')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <x-card class="card shadow mb-4">
                <x-slot name="header">
                    <x-button href="./courses/add">Tambah Mata Kuliah</x-button>
                </x-slot>
                <x-slot name="body">
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
                            <tr id="{{$course->course_id}}">
                                <td>{{$course->code}}</td>
                                <td>{{$course->name}}</td>
                                <td>{{$course->description}}</td>
                                <td>{{$course->semester}}</td>
                                <td class="d-flex">
                                    <x-button
                                        variant="outline" 
                                        class="mr-2"
                                        href="./courses/{{$course->course_id}}/update"
                                    >
                                        <x-icon icon="pen" />
                                    </x-button>
                                    <form 
                                        action="./courses/{{$course->course_id}}/delete" method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <x-button variant="outline" color="danger">
                                            <x-icon icon="trash" />
                                        </x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-slot>
            </x-card>
        </div>
    </div>
    @endauth
@endsection