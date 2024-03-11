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
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ url('home') }}">
                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-person"></i></div>
                    <div class="col">Data Pribadi</div>
                    <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ url('home') }}">
                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-person"></i></div>
                    <div class="col">Identitas Profesi</div>
                    <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ url('home') }}">
                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-person"></i></div>
                    <div class="col">Riwayat Pekerjaan</div>
                    <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ url('home') }}">
                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-person"></i></div>
                    <div class="col">Riwayat Pelatihan</div>
                    <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                </a>
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