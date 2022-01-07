@extends('layouts.dashboard')
@inject('classCourse', 'App\Models\ClassCourse')

@section('head')
<style>
    .ck-editor__editable {
        min-height: 500px;
    }
</style>
@endsection

@section('heading')
{{$action == 'UPDATE' ? 'Update' : 'Tambah'}} Materi
@endsection

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
                    <form 
                        action="{{$action == 'UPDATE' ? "./update" : './add'}}" 
                        method="POST" 
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @if($action == 'UPDATE')
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input 
                                        type="text" 
                                        class="form-control"
                                        placeholder="Masukkan Judul Materi"
                                        value="{{$material->title}}"
                                        name="title" />
                                </div>
                                <div class="form-group">
                                    <label>Mata Kuliah</label>
                                    <select class="form-control" name="course_id">
                                        @foreach($courses as $course)
                                        <option 
                                            value="{{$course->course_id}}"
                                            {{$course->code == $material->code ? 'selected' : ''}}
                                        >
                                            {{$course->code}} | {{$course->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control" name="class">
                                        @foreach($classCourse::$classes as $classItem)
                                        <option 
                                            value="{{$classItem}}"
                                            {{$classItem == $material->class ? 'selected' : ''}}
                                        >
                                            {{$classItem}}
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
                                    @if(!empty($material->filename))
                                    <small class="mt-2 d-block">File sebelumnya 
                                        <a href="/materials/{{$material->filename}}">{{$material->filename}}</a>
                                    </small>
                                    @endif
                                </div>
                                @error('class_course_not_found')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Konten</label>
                                    <textarea id="editor" name="content" placeholder="Masukkan konten materi">
                                        {{$material->content}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            {{$action == 'UPDATE' ? 'Update' : 'Tambah'}}
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