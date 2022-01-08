@extends('layouts.dashboard')

@section('heading', 'List Mahasiswa')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <x-card class="card shadow mb-4">
                <x-slot name="header">
                    <x-button href="./student/add">Tambah Mahasiswa</x-button>
                </x-slot>
                <x-slot name="body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $person)
                            <tr>
                                <th scope="row">{{$person->student_number}}</th>
                                <td>{{$person->fullname}}</td>
                                <td>{{$person->email}}</td>
                                <td>
                                    <x-button
                                        variant="outline" 
                                        class="mr-2"
                                        href="./student/{{$person->student_id}}/update"
                                    >
                                        <x-icon icon="pen" />
                                    </x-button>
                                    <x-button 
                                        variant="outline" 
                                        color="danger"
                                        data-toggle="modal"
                                        data-target="#deleteStudent"
                                        data-student-id="{{$person->student_id}}"
                                        data-student-fullname="{{$person->fullname}}"
                                    >
                                        <x-icon icon="trash" />
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-slot>
            </x-card>
        </div>
    </div>
    <x-modal title="Hapus Data Mahasiswa" id="deleteStudent" method="DELETE">
        <x-slot name="body">
            <div>Ingin menghapus data <b id="studentName" class="text-danger"></b> ?</div>
        </x-slot>
        <x-slot name="footer">
            <x-button color="secondary" data-dismiss="modal">Tutup</x-button>
            <x-button color="danger">Hapus</x-button>
        </x-slot>
    </x-modal>
    @section('scripts')
    <script>
        $("#deleteStudent").on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget)
            const studentId = button.data('student-id')
            const studentFullname = button.data('student-fullname')

            const modal = $(this)
            modal.find('form')[0].action = `./student/${studentId}/delete`
            modal.find('#studentName').text(studentFullname)
        })
    </script>
    @endsection
    @endauth
@endsection