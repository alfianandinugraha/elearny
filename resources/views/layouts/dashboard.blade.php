@inject('authService', 'App\Services\AuthService')
<!DOCTYPE html>
<html lang="en">

<head>
    @include('components/head')
    @hasSection('title')
        <title>@yield('title') | Elearny Web App</title>
    @else
        <title>Elearny Web App</title>
    @endif
    @yield('head')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('components/sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components/navbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('heading')</h1>
                    </div>
                    @yield('content')

                </div>

            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Elearny 2021</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
                <form class="modal-footer" action="/{{$authService->currentRole()}}/logout" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>

    @include('components/scripts')
    @yield('scripts')

</body>

</html>