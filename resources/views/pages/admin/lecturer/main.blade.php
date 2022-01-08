@extends('layouts.dashboard')

@section('heading', 'List Dosen')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot name="header">
                    <x-button href="./lecturers/add">Tambah Dosen</x-button>
                </x-slot>
                <x-slot name="body">
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
                                    <x-button 
                                        class="mr-2"
                                        variant="outline"
                                        href="./lecturers/{{$lecturer->lecturer_id}}/update"
                                    >
                                        <x-icon icon="pen" />
                                    </x-button>
                                    <form 
                                        action="./lecturers/{{$lecturer->lecturer_id}}/delete" method="POST"
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