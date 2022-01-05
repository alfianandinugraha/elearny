<!DOCTYPE html>
<html lang="en">

<head>
    @include('components/head')
    <title>Elearny</title>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Elearny</h1>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-primary mr-2" href="/admin/login">Login Admin</a>
                                            <a class="btn btn-primary mr-2" href="/lecturer/login">Login Dosen</a>
                                            <a class="btn btn-primary" href="/student/login">Login Mahasiswa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    @include('components/scripts')
</body>

</html>