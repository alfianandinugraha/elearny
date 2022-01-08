@extends('layouts.dashboard')

@section('heading', 'List Mahasiswa')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <x-card class="card shadow mb-4">
                <x-slot name="header">
                    <x-button href="./student/add">Tambah Mahasiswa</x-button>
                </x-slot>
                <x-slot name="body">
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
                                    <x-button
                                        variant="outline" 
                                        class="mr-2"
                                        href="./student/{{$person->student_id}}/update"
                                    >
                                        <x-icon icon="pen" />
                                    </x-button>
                                    <form 
                                        action="./student/{{$person->student_id}}/delete" method="POST"
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