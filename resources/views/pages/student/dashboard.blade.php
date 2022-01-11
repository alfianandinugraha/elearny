@extends('layouts.dashboard')

@section('heading')
Selamat Datang, <b>{{Auth::guard('student')->user()->fullname}}</b> !
@endsection

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <x-card.counter 
                title="Total Kelas"
                icon="chalkboard"
                :total="$totalClass"
            />
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <x-card.counter 
                title="Total Materi"
                icon="scroll"
                :total="$totalMaterial"
            />
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <x-card>
                <x-slot name="header">
                    <h6 class="m-0 font-weight-bold text-primary">Akses Kelas</h6>
                </x-slot>
                <x-slot name="body">
                    @if(!count($classes))
                    <p>Tidak ada kelas</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $class)
                            <tr>
                                <th scope="row">{{$class->course_name}}</th>
                                <td scope="row">{{$class->class}}</td>
                                <td scope="row">{{$class->semester}}</td>
                                <td scope="row">
                                    <x-button
                                        variant="outline" 
                                        href="/student/classes/{{$class->class_course_id}}"
                                    >
                                        <x-icon icon="external-link-alt" />
                                    </x-button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-button variant="outline" href="/student/classes" class="w-100 mr-2">
                        <x-icon icon="external-link-alt" />
                        Lihat Semua
                    </x-button>
                    @endif
                </x-slot>
            </x-card>
        </div>
        <div class="col-xl-6 col-lg-5">
            <x-card class="card shadow mb-4">
                <x-slot name="header">
                    <h6 class="m-0 font-weight-bold text-primary">Materi</h6>
                </x-slot>
                <x-slot name="body">
                    @if(!count($materials))
                    <p>Belum ada materi</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Judul</th>
                                <th scope="col">Kode Mata Kuliah</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materials as $material)
                            <tr>
                                <th scope="row">{{$material->title}}</th>
                                <td scope="row">{{$material->code}}</td>
                                <td scope="row">
                                    <x-button
                                        variant="outline" 
                                        href="/student/materials/{{$material->material_id}}"
                                    >
                                        <x-icon icon="external-link-alt" />
                                    </x-button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-button variant="outline" href="/student/materials" class="w-100 mr-2">
                        <x-icon icon="external-link-alt" />
                        Lihat Semua
                    </x-button>
                    @endif
                </x-slot>
            </x-card>
        </div>
    </div>
@endsection