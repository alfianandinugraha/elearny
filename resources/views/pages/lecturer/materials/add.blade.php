@extends('layouts.dashboard')

@section('head')
<style>
    .ck-editor__editable {
        min-height: 500px;
    }
</style>
@endsection

@section('heading', 'Tambah Materi')

@section('content')
    @auth('lecturer')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Formulir
                    </h6>
                </div>
                <div class="card-body">
                    <form action="./add" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input 
                                        type="text" 
                                        class="form-control"
                                        placeholder="Nomor Induk Pengajar"
                                        value="Materi Penjumlahan Dasar"
                                        name="title" />
                                </div>
                                <div class="form-group">
                                    <label>Mata Kuliah</label>
                                    <select class="form-control" name="course_id">
                                        @foreach($courses as $course)
                                        <option value="{{$course->course_id}}">
                                            {{$course->code}} | {{$course->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control" name="class">
                                        @foreach($classes as $class)
                                        <option value="{{$class}}">
                                            {{$class}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p class="mb-1">File</p>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file">
                                        <label class="custom-file-label" for="file">Pilih File</label>
                                    </div>
                                </div>
                                @error('class_course_not_found')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea id="editor" name="content"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
    <script src="/js/ckeditor.js"></script>
    <script>
        $('#file').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });

        ClassicEditor.height = 500;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch((error) => {
                console.error( error );
            });
    </script>
    @endsection
    @endauth
@endsection