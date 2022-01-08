@inject('classCourseClasses', 'App\Models\ClassCourse')
<?php
    use App\Models\Course;
    use App\Models\Lecturer;

    $lecturers = Lecturer::query()->get(['fullname', 'lecturer_id', 'lecturer_number']);
    $courses = Course::query()->get(['code', 'name', 'course_id']);

    $classCourse = !empty($classCourse) ? $classCourse : (object) [
        'lecturer_fullname' => '',
        'class' => '',
        'course_id' => ''
    ];
?>
@extends('layouts.dashboard')

@section('heading', $metaData->heading)

@section('title', $metaData->title)

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12 col-lg-6">
            <x-card>
                <x-slot name="header">
                    <span class="font-weight-bold text-primary">
                        Formulir
                    </span>
                </x-slot>
                <x-slot name="body">
                    <form action="{{$metaData->action}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Pilih Dosen</label>
                            <select class="form-control" name="lecturer_id">
                                @foreach($lecturers as $lecturer)
                                <option 
                                    value="{{$lecturer->lecturer_id}}"
                                    {{$lecturer->fullname == $classCourse->lecturer_fullname ? 'selected' : ''}}
                                >
                                    {{$lecturer->lecturer_number}} | {{$lecturer->fullname}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Mata Kuliah</label>
                            <select class="form-control" name="course_id">
                                @foreach($courses as $course)
                                <option 
                                    value="{{$course->course_id}}"
                                    {{$course->course_id == $classCourse->course_id ? 'selected' : ''}}
                                >
                                    {{$course->code}} | {{$course->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Pilih Kelas</label>
                            <select class="form-control" name="class">
                                @foreach($classCourseClasses::$classes as $classItem)
                                <option 
                                    value="{{$classItem}}"
                                    {{$classItem == $classCourse->class ? 'selected' : ''}}
                                >{{$classItem}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('classAlreadyExist')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <x-button type="submit" class="w-100">
                            {{$metaData->buttonText}}
                        </x-button>
                    </form>
                </x-slot>
            </x-card>
        </div>
    </div>
    @endauth
@endsection