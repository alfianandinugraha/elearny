@extends('layouts.dashboard')

@section('heading', 'Edit Kelas')

@section('content')
    @auth('lecturer')
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
                    <form action="./update" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Token</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Masukkan token kelas"
                                value="{{$classCourse->token}}"
                                name="token" />
                        </div>
                        <div class="form-group">
                            <label>Kode</label>
                            <input 
                                type="text" 
                                class="form-control"
                                value="{{$classCourse->code}}"
                                disabled />
                        </div>
                        <div class="form-group">
                            <label>Nama Mata Kuliah</label>
                            <input 
                                type="text" 
                                class="form-control"
                                value="{{$classCourse->name}}"
                                disabled/>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input 
                                type="text" 
                                class="form-control"
                                value="{{$classCourse->semester}}"
                                disabled />
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <input 
                                type="text" 
                                class="form-control"
                                value="{{$classCourse->class}}"
                                disabled />
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">
                            Edit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection