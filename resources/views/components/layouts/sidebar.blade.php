<nav class="col-md-2" style="background-color: #add8e6;"> <!-- Warna background biru muda -->
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-dark" href="#dashboard"> <!-- Mengubah teks menjadi hitam -->
                    Homepage
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('member') }}"> <!-- Teks hitam -->
                    CRUD Member
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('buku') }}">
                    CRUD Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('pinjam') }}">
                    CRUD Peminjaman
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('kembali') }}">
                    CRUD Pengembalian
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('categories') }}">
                    CRUD Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('user') }}">
                    CRUD Admin
                </a>
            </li>
        </ul>
    </div>
</nav>
