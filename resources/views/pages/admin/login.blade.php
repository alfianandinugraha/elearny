<!DOCTYPE html>
<html lang="en">

<head>
    @include('components/head')
    <title>Login Admin</title>
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
                                        <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                                    </div>
                                    <form class="user" action="/admin/login" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input 
                                                type="text" 
                                                class="form-control form-control-user"
                                                placeholder="Username"
                                                value="admin"
                                                name="username" />
                                        </div>
                                        <div class="form-group">
                                            <input 
                                                type="password" 
                                                class="form-control form-control-user"
                                                placeholder="Password"
                                                value="admin"
                                                name="password" />
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
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