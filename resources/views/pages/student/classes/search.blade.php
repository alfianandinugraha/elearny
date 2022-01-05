@extends('layouts.dashboard')

@section('heading', 'Cari Kelas')

@section('content')
    @auth('student')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @if(!count($classCourses))
                    <p>Kelas tidak tersedia</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Dosen</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($classCourses as $classCourse)
                            <tr>
                                <th>{{$classCourse->code}}</th>
                                <td>{{$classCourse->name}}</td>
                                <td>{{$classCourse->class}}</td>
                                <td>{{$classCourse->semester}}</td>
                                <td>{{$classCourse->lecturer_name}}</td>
                                <td class="d-flex">
                                    <button 
                                        class="btn btn-outline-primary mr-2"
                                        data-toggle="modal"
                                        data-target="#modalConfirm"
                                        data-class-course-id="{{$classCourse->class_course_id}}"
                                        data-class-name="{{$classCourse->name}}"
                                    >
                                        <i class="fas fa-sign-in-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirmTitle" aria-hidden="true">
        <form class="modal-dialog modal-dialog-centered" role="document" id="form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Token</label>
                        <input 
                            type="text" 
                            class="form-control"
                            placeholder="Masukkan token kelas"
                            name="token" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ambil</button>
                </div>
            </div>
        </form>
    </div>
    @section('scripts')
    <script>
        $('#modalConfirm').on('show.bs.modal', function (e) {
            const button = $(e.relatedTarget)
            const courseClassId = button.data('class-course-id')
            const courseClassName = button.data('class-name')
            const modal = $(this)
            modal.find('.modal-title').text(courseClassName)
            modal.find('#form')[0].action = `${courseClassId}/pick`
        })
    </script>
    @endsection
    @endauth
@endsection