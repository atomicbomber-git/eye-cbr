@extends('shared.layout')
@section('title', 'Daftar Gejala')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>

            <li class="is-active"><a href="{{ route('feature.index') }}" aria-current="page"> Daftar Gejala </a></li>
        </ul>
    </nav>

    <h1 class="title">
        Daftar Gejala
    </h1>

    <div style="overflow-x:auto">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth block">
            <thead>
                <th> # </th>
                <th> Gejala </th>
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