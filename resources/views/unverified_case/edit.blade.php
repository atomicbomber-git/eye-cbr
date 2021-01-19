@extends('layouts.admin')
@section('title', 'Ubah Kasus Baru')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')

    <h1 class="title">
        <a href="{{ route("unverified_case.index") }}">
            Manajemen Kasus Baru
        </a>

        /

        Ubah
    </h1>

    <div class="card">
        <div class="card-header">
            <h1 class="card-header-title">
                <span class="icon">
                    <i class="fa fa-pencil"></i>
                </span>
                Ubah Kasus Baru
            </h1>
        </div>
        <div class="card-content">

            <form method="POST" action="{{ route('unverified_case.update', $case_record->id) }}">
                @csrf

                <h2 class="title is-4"> Daftar Gejala </h2>

                @foreach ($features as $feature)

                <div class="field">
                    <label class="checkbox">
                        <input
                                disabled
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
                    <select id="diagnosis" disabled>
                        @foreach (App\Kasus::HASIL_DIAGNOSIS as $key => $value)
                        <option
                            {{ old('diagnosis', $case_record->diagnosis) == $key ? 'selected' : '' }}
                            value="{{ $key }}">

                            {{ $value }}
                        </option>
                        @endforeach
                        <option {{ old('diagnosis', $case_record->diagnosis) === null ? 'selected' : '' }} value=""> - </option>
                    </select>
                </div>
            </div>

            <div class="field">
                <label class="label"
                       for="solution"
                > Solusi: </label>
                <div class="control @error('solution') has-icons-right @enderror">
                <textarea id="solution"
                          name="solution"
                          rows="5"
                          class="textarea {{ $errors->has('solution') ? 'is-danger' : ''  }}"
                          placeholder=""
                >{{ old("solution", $case_record->solution) }}</textarea>
                    @if($errors->first('solution'))
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @endif

                    @if($errors->first('solution'))
                        <p class="help is-danger"> {{ $errors->first('solution') }} </p>
                    @endif
                </div>

                @if($errors->first('solution'))
                    <p class="help is-danger"> {{ $errors->first('solution') }} </p>
                @endif
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
