@extends('layouts.dashboard')

@section('heading', 'Tambah Kelas')

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
                            <label>Pilih Dosen</label>
                            <select class="form-control" name="lecturer_id">
                                @foreach($lecturers as $lecturer)
                                <option value="{{$lecturer->lecturer_id}}">
                                    {{$lecturer->lecturer_number}} | {{$lecturer->fullname}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Mata Kuliah</label>
                            <select class="form-control" name="course_id">
                                @foreach($courses as $course)
                                <option value="{{$course->course_id}}">
                                    {{$course->code}} | {{$course->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Pilih Kelas</label>
                            <select class="form-control" name="class">
                                @foreach($classes as $class)
                                <option value="{{$class}}">{{$class}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('classAlreadyExist')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
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