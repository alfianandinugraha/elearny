@extends('layouts.dashboard')

@section('heading')
Kelas <b>{{$course->name}}</b>
@endsection

@section('content')
    @auth('student')
    <div class="row">
        <div class="col-3">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <b>Informasi Kelas</b>
                </div>
                <div class="card-body">
                    <b class="text-primary">Nama Pengajar</b>
                    <p>{{$course->lecturer_name}}</p>
                    <hr />
                    <b class="text-primary">Email Pengajar</b>
                    <p>{{$course->lecturer_email}}</p>
                    <hr />
                    <b class="text-primary">Semester</b>
                    <p>{{$course->semester}}</p>
                    <hr />
                    <b class="text-primary">Kode</b>
                    <p>{{$course->code}}</p>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <b>{{$course->name}}</b>
                </div>
                <div class="card-body">
                    <p>{{$course->description}}</p>
                    <button 
                        class="ml-auto btn btn-outline-danger"
                        data-toggle="modal"
                        data-target="#modalDelete"
                        data-student-course-id="{{$course->student_course_id}}"
                        data-class-name="{{$course->name}}"
                    >Keluar Kelas</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
        <form class="modal-dialog modal-dialog-centered" role="document" id="form" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger font-weight-bold" id="exampleModalLongTitle">
                        Keluar Kelas
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Apakah kamu ingin keluar dari kelas <b class="class-name"></b> ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Keluar</button>
                </div>
            </div>
        </form>
    </div>
    @section('scripts')
    <script>
        $('#modalDelete').on('show.bs.modal', function (e) {
            const button = $(e.relatedTarget)
            const studentCourseId = button.data('student-course-id')
            const courseClassName = button.data('class-name')
            const modal = $(this)
            modal.find('#form')[0].action = `${studentCourseId}`
            modal.find('.class-name').text(courseClassName)
        })
    </script>
    @endsection
    @endauth
@endsection