<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="/{{$authService->currentRole()}}/dashboard"
    >
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Elearny</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/{{$authService->currentRole()}}/dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>
    @auth('admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/student">
            <i class="fas fa-fw fa-cog"></i>
            <span>Mahasiswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/lecturers">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Dosen</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/courses">
            <i class="fas fa-chalkboard"></i>
            <span>Mata Kuliah</span>
        </a>
    </li>
    @endauth
    @auth('lecturer')
    <li class="nav-item">
        <a class="nav-link collapsed" href="/lecturer/courses">
            <i class="fas fa-chalkboard"></i>
            <span>Mata Kuliah</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/lecturer/student">
            <i class="fas fa-users"></i>
            <span>Mahasiswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/lecturer/tasks">
            <i class="fas fa-scroll"></i>
            <span>Tugas</span>
        </a>
    </li>
    @endauth

</ul>