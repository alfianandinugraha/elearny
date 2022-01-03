@extends('layouts.dashboard')

@section('heading', 'List Mata Kuliah')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a 
                        class="mr-auto btn btn-primary"
                        href="./courses/add"
                    >Tambah Mata Kuliah</a>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection