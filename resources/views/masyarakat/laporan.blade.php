<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Laporan Aduan</h2>
        <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
        
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>