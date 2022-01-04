@extends('layouts.dashboard')

@section('heading', 'Edit Mata Kuliah')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Formulir
                    </h6>
                </div>
                <div class="card-body">
                    <form action="./add" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Kode</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Kode mata kuliah"
                                value="{{$course->course_id}}"
                                name="course_id" />
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                value="{{$course->name}}"
                                name="name" />
                        </div>
                        <div class="form-group mt-2">
                            <label>Semester</label>
                            <select class="form-control" name="semester">
                                @foreach($semesters as $semester)
                                    <option 
                                        value="{{$semester}}"
                                        {{$course->semester == $semester ? 'selected' : ''}}
                                    >{{$semester}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea 
                                class="form-control"
                                placeholder="Deskripsi mata kuliah"
                                name="description"
                                rows="4"
                            >{{$course->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection