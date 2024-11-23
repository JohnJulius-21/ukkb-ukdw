@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row g-3 align-items-center" >
                    <!-- Kolom kiri (elemen vertikal) -->
                    <div class="col-md-6">
                        <div class="row g-2">
                            <!-- Total UKKB -->
                            <div class="col-md-6">
                                <div class="p-3 border text-center">
                                    <h4>11</h4>
                                    <p>Total UKKB</p>
                                </div>
                            </div>
                            <!-- Total Anggota UKKB -->
                            <div class="col-md-6">
                                <div class="p-3 border text-center">
                                    <h4>163</h4>
                                    <p>Total Anggota UKKB</p>
                                </div>
                            </div>
                            <!-- Jumlah Kegiatan -->
                            {{-- <div class="col-md-4">
                                <div class="p-3 border text-center">
                                    <h4>3</h4>
                                    <p>Jumlah Kegiatan</p>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="p-3 border text-center">
                                    <h4>3</h4>
                                    <p>Jumlah Kegiatan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Kolom kanan (canvas) -->
                    <div class="col-md-6">
                        <div class="p-3">
                            <label for="" class="text-center">Anggota Baru</label>
                            <canvas id="dashboard"></canvas>
                        </div>
                    </div>
                </div>
                

                <!-- Baris ketiga: Jadwal Kegiatan -->
                <div class="row mt-4">
                    <div class="col-sm-12">
                        <div class="p-3 border">
                            <h5>Jadwal Kegiatan</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Tempat Pelaksanaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Makrab Formapa</td>
                                        <td>26 Oktober 2024</td>
                                        <td>Wisma UKDW</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Gelar Budaya day 1</td>
                                        <td>2 November 2024</td>
                                        <td>Halaman Koinonia</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Makrab IMT</td>
                                        <td>9 November 2024</td>
                                        <td>Wisma UGM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('dashboard');

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
