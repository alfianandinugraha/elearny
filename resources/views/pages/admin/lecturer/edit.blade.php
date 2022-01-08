@extends('layouts.dashboard')

@section('heading', 'Edit Dosen')

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
                    <form action="./update" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>NIP</label>
                            <input 
                                type="number" 
                                class="form-control"
                                placeholder="Nomor Induk Pengajar"
                                value="{{$lecturer->lecturer_number}}"
                                name="lecturer_number" />
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input 
                                type="text" 
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                value="{{$lecturer->fullname}}"
                                name="fullname" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input 
                                type="email" 
                                class="form-control"
                                placeholder="Masukkan email"
                                value="{{$lecturer->email}}"
                                name="email" />
                        </div>
                        <div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    id="radio-male" 
                                    value="male"
                                    {{$lecturer->gender == 'male' ? 'checked' : ''}}
                                >
                                <label class="form-check-label" for="radio-male">Pria</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    id="radio-female" 
                                    value="female"
                                    {{$lecturer->gender == 'female' ? 'checked' : ''}}
                                >
                                <label class="form-check-label" for="radio-female">Wanita</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection