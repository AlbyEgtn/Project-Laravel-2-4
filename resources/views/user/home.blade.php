<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Homepage</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak</a>
        </div>
    </nav>

    <div class="container">
        <!-- Welcome Message and Logout Button -->
        <div class="row mt-3">
            <div class="col">
                <h4 class="text-secondary">Selamat Datang, {{ Auth::user()->name }}</h4>
            </div>
            <div class="col"></div>
            <div class="col text-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-light bg-danger text-white">Logout</button>
                </form>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row mt-5 mb-5">
            <div class="col"></div>
            <div class="col-6">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control rounded" placeholder="Cari nama buku" aria-label="Search" aria-describedby="search-addon">
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>

        <!-- Book Data Display -->
        @foreach ($data as $buku)
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <!-- Book Cover Image -->
                    <div class="col-2">
                        <img style="width: 150px" src="{{ asset('images/' . $buku->gambar) }}" alt="cover buku">
                    </div>
                    <!-- Book Information Labels -->
                    <div class="col-2">
                        <p class="fw-bold">Judul</p>
                        <p class="fw-bold">Penulis</p>
                        <p class="fw-bold">Penerbit</p>
                        <p class="fw-bold">Tahun Terbit</p>
                        <p class="fw-bold">Deskripsi Buku</p>
                    </div>
                    <!-- Book Information Details -->
                    <div class="col-8">
                        <p>{{ $buku->judul_buku }}</p>
                        <p>{{ $buku->penulis }}</p>
                        <p>{{ $buku->penerbit }}</p>
                        <p>{{ $buku->tahun_terbit }}</p>
                        <p>{{ $buku->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Pagination Links -->
        {{ $data->links() }}
    </div>

    <sc src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></sc ript>
</body>
</html>
