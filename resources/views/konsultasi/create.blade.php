@extends('layouts.guest')

@section("content")
    <div class="container p-x:5 m-y:5">
        @include('shared.message')

        <h1 class="title">
            Konsultasi
        </h1>

        <div class="card">
            <div class="card-header">
                <h1 class="card-header-title">
                    Silakan Lakukan Konsultasi
                </h1>
            </div>
            <div class="card-content">
                <form method='POST' action='{{ route('konsultasi.store') }}'>
                    @csrf

                    <h2 class="title is-4">
                        Gejala
                    </h2>

                    @error("case_record_features")
                        <article class="message is-danger">
                            <div class="message-body">
                                {{ $message }}
                            </div>
                        </article>
                    @enderror

                    @foreach ($features as $feature)

                        <input type="hidden"
                               name="case_record_features[{{ $feature->id }}][feature_id]"
                               value="{{ $feature->id }}"
                        >

                        <div class="field">
                            <label class="checkbox">
                                <span style="display: inline-block; width: 2rem">
                                    F{{ $loop->iteration }}
                                </span>
                                <input
                                        {{ old("case_record_features.$feature->id.value") === "on" ? "checked" : "" }}
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
                            Lakukan Konsultasi
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