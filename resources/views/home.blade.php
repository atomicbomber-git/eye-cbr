@extends('layouts.guest')

@section("content")
    <div
        style="
        background: url('{{ asset("home.jpg") }}');
                height: 768px;
                filter: sepia(0.3) hue-rotate(180deg);
    "
    >
        <h1
                style="padding-top: 200px; filter: sepia(0) hue-rotate(-180deg)"
                class="title is-1 has-text-info has-text-centered">
            Sistem Diagnosis </br>
            Penyakit Mata
        </h1>
    </div>
@endsection