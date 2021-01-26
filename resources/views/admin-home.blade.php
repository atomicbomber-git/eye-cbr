@extends('layouts.admin')

@section("content")
    <div class="container p-x:5 m-y:5">
        <h1 class="title">
            Selamat Datang Admin
        </h1>

        <div class="card">
            <div class="card-content">
                <ol style="margin-left: 1rem">
                    <li> Basis Kasus: Data kasus penyakit mata yang tersimpan di basis data. </li>
                    <li> Kasus Baru: Data kasus dari konsultasi pasien penyakit mata. </li>
                    <li> Gejala: Data gejala penyakit mata. </li>
                </ol>
            </div>
        </div>
    </div>
@endsection