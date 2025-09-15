<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Selamat Datang di Dashboard Masyarakat</h2>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Informasi Akun</h5>
                <p><strong>NIK:</strong> {{ Auth::user()->nik }}</p>
                <p><strong>Nama:</strong> {{ Auth::user()->nama }}</p>
                <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
                <p><strong>Telepon:</strong> {{ Auth::user()->telp }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Buat Aduan Baru</h5>
                <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan</label>
                        <textarea name="isi_laporan" class="form-control" required>{{ old('isi_laporan') }}</textarea>
                        @error('isi_laporan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto (opsional)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        @error('foto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Aduan</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daftar Aduan Anda</h5>
                @if (Auth::user()->pengaduan->isEmpty())
                    <p>Belum ada aduan.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Isi Laporan</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Tanggapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->pengaduan as $aduan)
                                <tr>
                                    <td>{{ $aduan->tgl_pengaduan }}</td>
                                    <td>{{ $aduan->isi_laporan }}</td>
                                    <td>
                                        @if ($aduan->foto)
                                            <img src="{{ Storage::url($aduan->foto) }}" alt="Foto Aduan" style="max-width: 100px;">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>{{ $aduan->status }}</td>
                                    <td>
                                        @if ($aduan->tanggapan->isEmpty())
                                            Belum ada tanggapan
                                        @else
                                            @foreach ($aduan->tanggapan as $tanggapan)
                                                <p><strong>{{ $tanggapan->petugas->nama_petugas }}</strong> ({{ $tanggapan->tgl_tanggapan }}): {{ $tanggapan->tanggapan }}</p>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</body>
</html>