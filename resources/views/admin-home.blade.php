@extends('layouts.admin')

@section("content")
    <div class="container p-x:5 m-y:5">
        <h1 class="title">
            Selamat Datang Admin
        </h1>

        <div class="card">
            <div class="card-content">
                <ol style="margin-left: 1rem">
                    <li> Basis Kasus : Data kasus pasien atau penderita penyakit mata yang tersimpan di basis data. </li>
                    <li> Kasus Baru : Data kasus dari konsultasi pasien atau penderita penyakit mata. </li>
                    <li> Fitur : Data gejala-gejala yang dialami oleh pasien atau penderita penyakit mata. </li>
                    <li> Solusi : Data solusi berdasarkan hasil diagnosis penyakit mata. </li>
                </ol>
            </div>
        </div>
    </div>
@endsection