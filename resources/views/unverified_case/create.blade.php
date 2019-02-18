@extends('shared.layout')
@section('title', 'Tambah Kasus Baru')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li> <a href="#"> {{ config('app.name') }} </a> </li>
            <li><a href="{{ route('unverified_case.index', ['page' => session('page')]) }}"> Manajemen Kasus Baru </a></li>
            <li class="is-active"><a href="{{ route('unverified_case.create') }}" aria-current="page"> Tambah Kasus Baru </a></li>
        </ul>
    </nav>
    
    <h1 class="title">
        Tambah Kasus Baru
    </h1>
    
    <div class="card">
        <div class="card-header">
            <h1 class="card-header-title">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                Tambah Kasus Baru
            </h1>
        </div>
        <div class="card-content">
            <form method='POST' action='{{ route('unverified_case.store') }}'>
                @csrf
                
                
                <h2 class="title is-4">
                    Gejala
                </h2>
                
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
                
                <h2 class="title is-4 m-t:4">
                    Data Kasus
                </h2>
                
                <div class="field">
                    <label for="level" class="label"> Tahapan: </label>
                    <div id="level" class="select">
                        <select name="level">
                            @foreach (App\CaseRecord::LEVELS as $key => $value)
                            <option 
                                {{ old('level') === $key ? 'selected' : '' }}
                                value="{{ $key }}">
                                {{ $value }}
                            </option>
                            @endforeach
                            <option value=""> - </option>
                        </select>
                    </div>
                </div>
                
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