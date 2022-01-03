<!DOCTYPE html>
<html lang="en">

<head>
    @include('components/head')
    <title>Dashboard Admin - Elearny</title>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('components/sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components/navbar')
                <div class="container-fluid">

                    @auth('admin')
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        List Dosen
                                    </h6>
                                    <a 
                                        class="ml-auto btn btn-primary"
                                        href="./lecturers/add"
                                    >Tambah Dosen</a>
                                </div>
                                <div class="card-body">
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
                                                    <a 
                                                        class="btn btn-outline-primary mr-2"
                                                        href="./lecturers/update/{{$lecturer->lecturer_id}}"
                                                    >Update</a>
                                                    <form 
                                                        action="./lecturers/delete/{{$lecturer->lecturer_id}}" method="POST"
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endauth

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah ingin keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik button "Logout" untuk keluar dari aplikasi</div>
                <form class="modal-footer" action="/admin/logout" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>

    @include('components/scripts')

</body>

</html>