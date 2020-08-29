@extends('shared.layout')
@section('title', 'Tambah Basis Kasus')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')
    
    <h1 class="title">
        <a href="{{ route("verified_case.index") }}">
            Manajemen Basis Kasus
        </a>

        /

        Tambah
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
                    <label for="diagnosis" class="label"> Hasil Diagnosis: </label>
                    <div id="diagnosis" class="select">
                        <select name="diagnosis">
                            @foreach (App\Kasus::HASIL_DIAGNOSIS as $key => $value)
                            <option 
                                {{ old('') === $key ? 'selected' : '' }}
                                value="{{ $key }}">
                                {{ $value }}
                            </option>
                            @endforeach
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