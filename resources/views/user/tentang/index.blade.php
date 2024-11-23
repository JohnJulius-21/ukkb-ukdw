@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="main-title mb-5">Tentang Kami</h2>
        <div class="card">
            <div class="card-body">
                <div class="row gx-4">
                    {{-- DATA STATIS --}}
                    <div class="col d-flex justify-content-end">
                        <a href="{{ route('tentang.edit', ['id' => Auth::user()->ukkb->id]) }}"
                            class="btn btn-primary">Edit</a>
                    </div>
                    <div style="width: 100%; margin: 0 auto; padding-top: 20px;">
                        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <!-- Bagian Kiri -->
                            <div style="flex: 1 1 66%; padding-right: 20px;" class="border p-3">
                                <div class="row mb-3" style="text-align: start;">
                                    <div class="col-4">
                                        <img src="{{ asset('storage/' . $selectedUkkb['logo']) }}" alt="Profile Picture"
                                            style="width: 150px; height: 150px; border-radius: 50%;" />
                                    </div>
                                    <div class="col">
                                        <h3>Sejarah</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                                            vitae
                                            urna nisi.</p>
                                    </div>
                                </div>
                                <div>
                                    <h3>Visi</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae
                                        urna nisi.</p>
                                </div>
                                <div>
                                    <h3>Misi</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae
                                        urna nisi.</p>
                                </div>
                                <div>
                                    <h3>Struktur Organisasi</h3>
                                    <div>
                                        <img src="path_to_structure_image" alt="Structure Diagram" style="width: 100%;" />
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Kanan -->
                            <div style="flex: 1 1 30%;" class="border p-3">
                                <h3>Badan Pengurus Harian</h3>
                                <ul style="list-style: none; padding: 0;">
                                    <li>Ketua: xxxxxxx</li>
                                    <li>Wakil Ketua: xxxxxxx</li>
                                    <li>Sekretaris 1: xxxxxxx</li>
                                    <li>Sekretaris 2: xxxxxxx</li>
                                    <li>Bendahara: xxxxxxx</li>
                                </ul>

                                <h3>Contact</h3>
                                <ul style="list-style: none; padding: 0;">
                                    <li>Sosial media IG: <a href="https://instagram.com/formapaukdw"
                                            style="color: #007bff; text-decoration: none;">@formapaukdw</a>
                                    </li>
                                    <li>Email: <a href="mailto:formapaukdw@gmail.com"
                                            style="color: #007bff; text-decoration: none;">formapaukdw@gmail.com</a>
                                    </li>
                                    <li>No. WA: 0899999999</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
