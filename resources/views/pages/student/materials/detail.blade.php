@extends('layouts.dashboard')

@section('heading')
    @if(!$material)
    Materi tidak ditemukan
    @else
    <b>{{$material->title}}</b>
    @endif
@endsection

@section('content')
    @auth('student')
    <div class="row">
        @if($material)
        <div class="col-12 col-lg-9">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <a href="/student/classes/{{$material->class_course_id}}">
                        {{ $material->course_name }}
                    </a>
                    <i class="fas fa-chevron-right mx-2 d-none d-md-inline"></i>
                    <a class="d-none d-md-inline" href="/student/materials/{{$material->material_id}}">
                        {{ $material->title }}
                    </a>
                </div>
                <div class="card-body">
                    {!! $material->content !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <b>File</b>
                </div>
                <div class="card-body">
                    @if(!$material->filename)
                    <span>Tidak ada file</span>
                    @else
                    <small class="mb-2 d-block">{{$material->filename}}</small>
                    <a 
                        class="ml-auto btn btn-outline-primary"
                        target="_blank"
                        href="/materials/{{$material->filename}}"
                    ><i class="fas fa-sm fa-download"></i> Download File</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    @endauth
@endsection