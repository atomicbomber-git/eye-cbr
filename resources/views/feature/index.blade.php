@extends('layouts.admin')
@section('title', 'Daftar Gejala')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')

    <h1 class="title">
        Daftar Gejala
    </h1>

    <div style="overflow-x:auto">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth block">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Gejala </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($features as $feature)
                <tr>
                    <td> {{ $loop->iteration }}. </td>
                    <td> {{ $feature->description }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection