
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry-In - Edit Bahan</title>
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
        <h1>Edit Data Bahan</h1>
        <p class="section-description">
            Perbarui informasi bahan pembersih untuk menjaga data stok
            Laundry-In tetap akurat.
        </p>
    </section>

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

    <section class="form-section">
        <p class="section-label">UBAH INFORMASI</p>
        <h2>Form Edit Bahan Pembersih</h2>

        <form action="{{ route('bahan.update', $bahan->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <p>
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    @foreach (['Deterjen', 'Pewangi', 'Pelembut'] as $kategori)
                        <option value="{{ $kategori }}"
                            @selected(old('kategori', $bahan->kategori) === $kategori)>
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
                    value="{{ old('merek', $bahan->merek) }}"
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
                    value="{{ old('stok', $bahan->stok) }}"
                    required
                >
            </p>

            <p>
                <label for="satuan">Satuan</label>
                <select id="satuan" name="satuan" required>
                    @foreach (['Liter', 'Kg', 'Botol'] as $satuan)
                        <option value="{{ $satuan }}"
                            @selected(old('satuan', $bahan->satuan) === $satuan)>
                            {{ $satuan }}
                        </option>
                    @endforeach
                </select>
            </p>

            <div class="aksi-form">
                <button type="submit" class="button-tambah">
                    Simpan Perubahan
                </button>

                <a href="{{ route('bahan.index') }}"
                   class="button-batal">
                    Batal
                </a>
            </div>
        </form>
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
