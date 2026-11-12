
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry-In</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <div class="border-LaundryIn">
            <h2>Laundry-In</h2>
        </div>

        <nav>
            <a href="{{ url('/') }}" class="active">Beranda</a>
            <a href="{{ url('/bahan') }}">Bahan Pembersih</a>
            <span class="disabled-link">Layanan &amp; Tarif</span>
            <span class="disabled-link">Peralatan</span>
            <span class="disabled-link">Data Pelanggan</span>

            <form action="{{ route('logout') }}" method="POST"
                style="display: inline;">
                @csrf

                <button type="submit"
                        style="padding: 9px 15px;
                            background: #dc3545;
                            color: white;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;">
                    Logout
                </button>
            </form>
        </nav>
    </header>

    <main>
        <section class="pembuka">
            <p class="section-label">SELAMAT DATANG DI LAUNDRY-IN</p>

            <h1>Informasi Operasional Laundry</h1>

            <p class="section-description">
                Laundry-In membantu mendukung pengelolaan kegiatan
                operasional laundry, mulai dari layanan, peralatan,
                data pelanggan, hingga ketersediaan bahan pembersih.
            </p>
        </section>

        <section class="bahan-info">
            <p class="section-label">BAHAN PEMBERSIH</p>

            <h1>Bahan yang Digunakan dalam Proses Laundry</h1>

            <p>
                Beberapa bahan pembersih digunakan untuk membantu
                proses pencucian agar pakaian bersih, segar, dan
                tetap nyaman digunakan.
            </p>

            <div class="bahan-item">
                <div class="nomor">01</div>
                <div class="bahan-text">
                    <h2>Deterjen</h2>
                    <p>
                        Digunakan untuk membersihkan kotoran dan noda
                        pada pakaian selama proses pencucian.
                    </p>
                </div>
            </div>

            <div class="bahan-item">
                <div class="nomor">02</div>
                <div class="bahan-text">
                    <h2>Pewangi</h2>
                    <p>
                        Digunakan untuk memberikan aroma segar pada
                        pakaian setelah proses pencucian.
                    </p>
                </div>
            </div>

            <div class="bahan-item">
                <div class="nomor">03</div>
                <div class="bahan-text">
                    <h2>Pelembut</h2>
                    <p>
                        Digunakan untuk membantu menjaga kelembutan
                        pakaian setelah dicuci.
                    </p>
                </div>
            </div>
        </section>

        <section class="stok-section">
            <p class="section-label">KETERSEDIAAN STOK</p>

            <h1>Stok Bahan Pembersih</h1>

            <p>
                Pantau ketersediaan bahan pembersih yang digunakan
                dalam operasional laundry.
            </p>

            <div class="stok">
                @foreach ($kategoriList as $kategori)
                    @php
                        $stokKategori = $totalStok[$kategori] ?? [];
                        $jumlahKategori = array_sum($stokKategori);
                    @endphp

                    <div class="stok-card">
                        <h3>{{ $kategori }}</h3>

                        <p class="jumlah">
                            @if (!empty($stokKategori))
                                @foreach ($stokKategori as $satuan => $jumlah)
                                    {{ number_format($jumlah, 0, ',', '.') }}
                                    {{ $satuan }}@if (!$loop->last) / @endif
                                @endforeach
                            @else
                                0
                            @endif
                        </p>

                        <p class="status">
                            {{ $jumlahKategori > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                        </p>
                    </div>
                @endforeach
            </div>

            <a href="{{ url('/bahan') }}" class="button-bahan">
                Lihat Ketersediaan
            </a>
        </section>
    </main>

    <footer>
        <p>Renata Arvina Puspanagari</p>
        <p>102022500208</p>
        <p>SI-49-07</p>
        <p>Kelompok 9</p>
        <p>Individu D / Sistem Operasional Laundry</p>
    </footer>
</body>
</html>
