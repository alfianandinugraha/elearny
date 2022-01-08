@extends('layouts.dashboard')

@section('heading', 'List Dosen')

@section('content')
    @auth('admin')
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot name="header">
                    <x-button href="./lecturers/add">Tambah Dosen</x-button>
                </x-slot>
                <x-slot name="body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lecturers as $lecturer)
                            <tr>
                                <th scope="row">{{$lecturer->lecturer_number}}</th>
                                <td>{{$lecturer->fullname}}</td>
                                <td>{{$lecturer->email}}</td>
                                <td class="d-flex">
                                    <x-button 
                                        class="mr-2"
                                        variant="outline"
                                        href="./lecturers/{{$lecturer->lecturer_id}}/update"
                                    >
                                        <x-icon icon="pen" />
                                    </x-button>
                                    <x-button
                                        variant="outline"
                                        color="danger"
                                        data-toggle="modal"
                                        data-target="#deleteModal"
                                        data-lecturer-id="{{$lecturer->lecturer_id}}"
                                        data-lecturer-fullname="{{$lecturer->fullname}}"
                                    >
                                        <x-icon icon="trash" />
                                    </x-button>
                                    <form 
                                        action="./lecturers/{{$lecturer->lecturer_id}}/delete" method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-slot>
            </x-card>
        </div>
    </div>
    <x-modal title="Hapus Data Dosen" id="deleteModal" method="DELETE">
        <x-slot name="body">
            <div>Ingin menghapus data <b id="lecturerName" class="text-danger"></b> ?</div>
        </x-slot>
        <x-slot name="footer">
            <x-button color="secondary" data-dismiss="modal">Tutup</x-button>
            <x-button color="danger">Hapus</x-button>
        </x-slot>
    </x-modal>
    @section('scripts')
    <script>
        $("#deleteModal").on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget)
            const lecturerId = button.data('lecturer-id')
            const lecturerFullname = button.data('lecturer-fullname')

            const modal = $(this)
            modal.find('form')[0].action = `./lecturers/${lecturerId}/delete`
            modal.find('#lecturerName').text(lecturerFullname)
        })
    </script>
    @endsection
    @endauth
@endsection