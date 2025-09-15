<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Dashboard Admin</h2>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Informasi Akun</h5>
                <p><strong>Nama:</strong> {{ Auth::guard('petugas')->user()->nama_petugas }}</p>
                <p><strong>Username:</strong> {{ Auth::guard('petugas')->user()->username }}</p>
                <p><strong>Telepon:</strong> {{ Auth::guard('petugas')->user()->telp }}</p>
                <p><strong>Level:</strong> {{ Auth::guard('petugas')->user()->level }}</p>
                <form method="POST" action="{{ route('petugas.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Daftar Aduan</h5>
                @if ($pengaduan->isEmpty())
                    <p>Belum ada aduan.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pengadu</th>
                                <th>Isi Laporan</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Tanggapan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $aduan)
                                <tr>
                                    <td>{{ $aduan->tgl_pengaduan }}</td>
                                    <td>{{ $aduan->masyarakat->nama }}</td>
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
                                    <td>
                                        <form method="POST" action="{{ route('pengaduan.updateStatus', $aduan->id_pengaduan) }}" class="d-inline">
                                            @csrf
                                            <select name="status" class="form-select d-inline w-auto">
                                                <option value="0" {{ $aduan->status == '0' ? 'selected' : '' }}>0</option>
                                                <option value="proses" {{ $aduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="selesai" {{ $aduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                        <form method="POST" action="{{ route('pengaduan.storeTanggapan', $aduan->id_pengaduan) }}" class="mt-2">
                                            @csrf
                                            <textarea name="tanggapan" class="form-control mb-2" required></textarea>
                                            @error('tanggapan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <button type="submit" class="btn btn-success btn-sm">Tambah Tanggapan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Generate Laporan</h5>
                <a href="{{ route('petugas.laporan') }}" class="btn btn-primary">Lihat Laporan Aduan</a>
            </div>
        </div>
    </div>
</body>
</html>