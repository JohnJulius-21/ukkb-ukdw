@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="main-title mb-5">Beranda</h2>

        <div class="row g-3 align-items-center">
            <!-- Kolom kiri (elemen vertikal) -->
            <div class="col-md-6">
                <div class="row g-2">
                    <!-- Total UKKB -->
                    <div class="col-md-6">
                        <div class="p-3 border text-center bg-white">
                            <h4>{{ $jumlahKegiatan }}</h4>
                            <p>Jumlah Kegiatan</p>
                        </div>
                    </div>
                    <!-- Total Anggota UKKB -->
                    <div class="col-md-6">
                        <div class="p-3 border text-center bg-white">
                            <h4>{{ $jumlahAnggota }}</h4>
                            <p>Jumlah Anggota</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="p-3  border bg-white">
                            <label for="" class="text-center">Anggota Baru</label>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom kanan (canvas) -->
            <div class="col-md-6">
                <div class="p-3 border bg-white">
                    <h5>Jadwal Kegiatan</h5>
                    <table class="table table-bordered table-striped display" id="datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Tempat Pelaksanaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['judul_laporan'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['tanggal_laporan'])->format('d F Y') }}</td>
                                <td>{{ $item['tempat_kegiatan'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Baris ketiga: Jadwal Kegiatan -->
    


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [0, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
