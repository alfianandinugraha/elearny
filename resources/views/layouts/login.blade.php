<!DOCTYPE html>
<html lang="en">

<head>
    @include('components/head')
    <title>@yield('title')</title>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">@yield('heading')</h1>
                                    </div>
                                    @yield('form')
                                    <a href="/" class="text-center d-block mt-2">Kembali ke menu</a>
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