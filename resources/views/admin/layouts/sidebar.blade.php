<div class="row">
    <div class="col-12">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('home') }}">
                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-door"></i></div>
                    <div class="col">Dashboard</div>
                    <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">
                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-person"></i></div>
                    <div class="col">Master Data</div>
                    <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                    </div>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item nav-link" href="{{ url('admin/user') }}">
                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i>
                        </div>
                        <div class="col">User</div>
                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                    </a></li>
                    <li><a class="dropdown-item nav-link" href="{{ url('admin/karyawan') }}">
                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i>
                        </div>
                        <div class="col">Karyawan</div>
                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                    </a></li>
                    <li><a class="dropdown-item nav-link" href="{{ url('admin/bagian') }}">
                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i>
                        </div>
                        <div class="col">Bagian</div>
                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                    </a></li>
                    <li><a class="dropdown-item nav-link" href="{{ url('admin/pendidikan') }}">
                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i>
                        </div>
                        <div class="col">Pendidikan</div>
                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                    </a></li>
                    <li><a class="dropdown-item nav-link" href="{{ url('admin/pelatihan') }}">
                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i>
                        </div>
                        <div class="col">Pelatihan</div>
                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                    </a></li>
                    <li><a class="dropdown-item nav-link" href="{{ url('admin/profesi') }}">
                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i>
                        </div>
                        <div class="col">Profesi</div>
                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                    </a></li>
                </ul>
            </li>

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post" id="logout">
                    @csrf
                </form>
                <a class="nav-link" aria-current="page" onclick="return document.getElementById('logout').submit()">
                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-arrow-right"></i></div>
                    <div class="col">Logout</div>
                    <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                </a>
            </li>
        </ul>
    </div>
</div>