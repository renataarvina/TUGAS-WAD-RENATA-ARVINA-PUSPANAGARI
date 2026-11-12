
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry-In - Bahan Pembersih</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<header>
    <div class="border-LaundryIn">
        <h2>Laundry-In</h2>
    </div>

    <nav>
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('bahan.index') }}" class="active">Bahan Pembersih</a>
        <span class="disabled-link">Layanan &amp; Tarif</span>
        <span class="disabled-link">Peralatan</span>
        <span class="disabled-link">Data Pelanggan</span>

        <!-- Identitas pengguna -->
        <span style="margin-left: 15px; color: #243b53;">
            {{ Auth::user()->name }}
        </span>

        <span style="padding: 5px 10px;
                     background: #e8f7f0;
                     color: #16734b;
                     border-radius: 5px;
                     font-size: 13px;">
            {{ ucfirst(Auth::user()->role) }}
        </span>

        <!-- Tombol Logout -->
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
        <p class="section-label">BAHAN PEMBERSIH</p>
        <h1>Pengelolaan Bahan Pembersih</h1>
        <p class="section-description">
            Halaman ini digunakan untuk melihat dan mengelola informasi stok
            serta merek bahan pembersih yang digunakan dalam operasional laundry.
        </p>
    </section>

    <!-- Pesan status -->
    @if (session('status') === 'berhasil')
        <p class="status-pesan">Data bahan berhasil ditambahkan!</p>

    @elseif (session('status') === 'dihapus')
        <p class="status-pesan">Data bahan berhasil dihapus!</p>

    @elseif (session('status') === 'diperbarui')
        <p class="status-pesan">Data bahan berhasil diperbarui!</p>

    @elseif (session('status') === 'gagal')
        <p class="status-pesan status-error">
            Data bahan gagal diproses atau dihapus.
        </p>
    @endif

    <!-- Pesan validasi -->
    @if ($errors->any())
        <div class="status-pesan status-error">
            <p>Periksa kembali data yang kamu masukkan:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Tambah Bahan -->
    <section class="form-section">
        <p class="section-label">TAMBAH DATA</p>
        <h2>Tambah Bahan Pembersih</h2>

        <form action="{{ route('bahan.store') }}" method="POST">
            @csrf

            <p>
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="">Pilih kategori</option>

                    @foreach ($kategoriList as $kategori)
                        <option value="{{ $kategori }}"
                            @selected(old('kategori') === $kategori)>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </p>

            <p>
                <label for="merek">Merek Bahan</label>
                <input
                    type="text"
                    id="merek"
                    name="merek"
                    maxlength="100"
                    placeholder="Contoh: SoClean"
                    value="{{ old('merek') }}"
                    required
                >
            </p>

            <p>
                <label for="stok">Jumlah Stok</label>
                <input
                    type="number"
                    id="stok"
                    name="stok"
                    min="0"
                    step="1"
                    placeholder="Contoh: 10"
                    value="{{ old('stok') }}"
                    required
                >
            </p>

            <p>
                <label for="satuan">Satuan</label>
                <select id="satuan" name="satuan" required>
                    <option value="">Pilih satuan</option>

                    @foreach (['Liter', 'Kg', 'Botol'] as $satuan)
                        <option value="{{ $satuan }}"
                            @selected(old('satuan') === $satuan)>
                            {{ $satuan }}
                        </option>
                    @endforeach
                </select>
            </p>

            <button type="submit" class="button-tambah">
                Tambah Bahan
            </button>
        </form>
    </section>

    <!-- Tabel Data Bahan -->
    @foreach ($kategoriList as $kategori)

        @php
            $dataKategori = $dataBahan->where('kategori', $kategori);
        @endphp

        <section class="tabel-section">
            <p class="section-label">{{ $kategori }}</p>
            <h2>Stok {{ $kategori }}</h2>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merek</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($dataKategori as $bahan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bahan->merek }}</td>

                                <td>
                                    {{ number_format($bahan->stok, 0, ',', '.') }}
                                </td>

                                <td>{{ $bahan->satuan }}</td>

                                <td>
                                    <span class="{{ $bahan->stok > 0 ? 'status-tersedia' : 'status-habis' }}">
                                        {{ $bahan->stok > 0 ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </td>

                                <td class="kolom-aksi">

                                    <!-- Tombol Edit: Admin dan Staff -->
                                    <a
                                        href="{{ route('bahan.edit', $bahan->id) }}"
                                        class="button-supplier">
                                        Edit
                                    </a>

                                    <!-- Tombol Hapus: Khusus Admin -->
                                    @if (Auth::user()->role === 'admin')
                                        <form
                                            action="{{ route('bahan.destroy', $bahan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus {{ $bahan->merek }}?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="data-kosong">
                                    Belum ada data bahan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    @endforeach

    <!-- Daftar Supplier -->
    <section class="supplier-section">
        <p class="section-label">DAFTAR SUPPLIER</p>
        <h2>Supplier Bahan Pembersih</h2>

        <p>
            Daftar supplier yang menyediakan bahan pembersih
            untuk kebutuhan operasional laundry.
        </p>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Bahan</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>PT Bersih Sejahtera</td>
                        <td>Deterjen</td>
                        <td>0812-3456-7890</td>
                        <td>
                            <a href="tel:081234567890" class="button-supplier">
                                Hubungi Supplier
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>CV Fresh Supply</td>
                        <td>Pewangi</td>
                        <td>0813-4567-8901</td>
                        <td>
                            <a href="tel:081345678901" class="button-supplier">
                                Hubungi Supplier
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>PT Soft Supply Indonesia</td>
                        <td>Pelembut</td>
                        <td>0814-5678-9012</td>
                        <td>
                            <a href="tel:081456789012" class="button-supplier">
                                Hubungi Supplier
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
