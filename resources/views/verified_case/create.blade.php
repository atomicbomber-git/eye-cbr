@extends('shared.layout')
@section('title', 'Tambah Basis Kasus')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li> <a href="#"> {{ config('app.name') }} </a> </li>
            <li><a href="{{ route('verified_case.index', ['page' => session('page')]) }}"> Manajemen Basis Kasus </a></li>
            <li class="is-active"><a href="{{ route('verified_case.create') }}" aria-current="page"> Tambah Basis Kasus </a></li>
        </ul>
    </nav>

    <h1 class="title">
        Tambah Basis Kasus
    </h1>

    <div class="card">
        <div class="card-header">
            <h1 class="card-header-title">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                Tambah Basis Kasus
            </h1>
        </div>
        <div class="card-content">
            <form method='POST' action='{{ route('verified_case.store') }}'>
                @csrf
            
                @foreach ($features as $feature)
            
                <input type="hidden"
                    name="case_record_features[{{ $feature->id }}][feature_id]"
                    value="{{ $feature->id }}"
                    >

                <div class="field">
                    <label class="checkbox">
                        <input
                            name="case_record_features[{{ $feature->id }}][value]"
                            type="checkbox"
                            class="m-r:.5">
                        {{ $feature->description }}
                    </label>
                </div>

                @endforeach

                <div class="t-a:r">
                    <button class="button is-primary">
                        <span>
                            Tambah Kasus Baru
                        </span>
                        <span class="icon is-small">
                            <i class="fa fa-plus"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection