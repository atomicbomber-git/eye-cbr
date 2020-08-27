@extends('shared.layout')
@section('title', 'Ubah Basis Kasus')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>

            <li> <a href="{{ route('verified_case.index', ['page' => session('page')]) }}"> Manajemen Basis Kasus </a> </li>
            <li class="is-active"><a href="" aria-current="page"> Ubah Basis Kasus </a></li>
        </ul>
    </nav>

    <h1 class="title">
        Ubah Basis Kasus
    </h1>

    <div class="card">
        <div class="card-header">
            <h1 class="card-header-title">
                <span class="icon">
                    <i class="fa fa-pencil"></i>
                </span>
                Ubah Basis Kasus
            </h1>
        </div>
        <div class="card-content">

            <form method="POST" action="{{ route('verified_case.update', $case_record->id) }}">
                @csrf

                <h2 class="title is-4"> Daftar Gejala </h2>

                @foreach ($features as $feature)
                
                <input type="hidden"
                    name="case_record_features[{{ $feature->id }}][feature_id]"
                    value="{{ $feature->id }}"
                    >

                <div class="field">
                    <label class="checkbox">
                        <input
                            name="case_record_features[{{ $feature->id }}][value]"
                            {{ $case_record->case_record_features[$feature->id] ? 'checked="checked"' : '' }}
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
                                {{ old('diagnosis', $case_record->diagnosis) === $key ? 'selected' : '' }}
                                value="{{ $key }}">
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
            <div class="t-a:r">
                <button class="button is-primary">
                    Ubah Data
                    <i class="fa fa-check"></i>
                </button>
            </div>

            </form>
        </div>
    </div>
</div>
@endsection