@extends('layouts.dashboard')

@section('heading')
    @if(!$material)
    Materi tidak ditemukan
    @else
    <b>{{$material->title}}</b>
    @endif
@endsection

@section('content')
    @auth('lecturer')
    <div class="row">
        @if($material)
        <div class="col-12 col-lg-9">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <a href="/lecturer/classes/{{$material->class_course_id}}">
                        {{ $material->course_name }}
                    </a>
                    <i class="fas fa-chevron-right mx-2 d-none d-md-inline"></i>
                    <a class="d-none d-md-inline" href="/lecturer/materials/{{$material->material_id}}">
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
                        class="ml-auto btn btn-outline-primary w-100"
                        target="_blank"
                        href="/materials/{{$material->filename}}"
                    ><i class="fas fa-sm fa-download"></i> Download File</a>
                    @endif
                </div>
            </div>
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <b>Action</b>
                </div>
                <div class="card-body">
                    <a 
                        href="./{{$material->material_id}}/update" 
                        class="btn btn-outline-primary mb-2 w-100"
                    >
                        <i class="fas fa-pen fa-sm mr-1"></i>Update
                    </a>
                    <button 
                        class="btn btn-outline-danger w-100"
                        data-toggle="modal" data-target="#modalDelete"
                    >
                        <i class="fas fa-trash fa-sm mr-1"></i>Hapus
                    </button>
                    {{-- <form action="./{{$material->material_id}}/delete">
                        @csrf
                        @method('GET')
                    </form> --}}
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
        <form
            class="modal-dialog modal-dialog-centered"
            role="document"
            method="POST"
            action="./{{$material->material_id}}/delete"
        >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                @method('DELETE')
                <p>Apakah ingin menghapus mater <b>{{$material->title}}</b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
            </div>
        </form>
    </div>
    @endauth
@endsection