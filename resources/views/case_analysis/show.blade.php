@extends('shared.layout')
@section('title', 'Analisis Kasus Baru')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li> <a href="#"> {{ config('app.name') }} </a> </li>
            <li> <a href="{{ route('unverified_case.index', ['page' => session('page')]) }}" aria-current="page"> Manajemen Kasus Baru </a></li>
            <li class="is-active"><a href="{{ route('verified_case.index') }}" aria-current="page"> Analisis Kasus Baru </a></li>
        </ul>
    </nav>

    <h1 class="title">
        Analisis Kasus Baru
    </h1>

    <div class="card m-b:3">
        <div class="card-header">
            <h1 class="card-header-title">
                <span class="icon">
                    <i class="fa fa-circle"></i>
                </span>
                Kasus Ini
            </h1>
        </div>
        <div class="card-content">
            <h2 class="title is-4"> Gejala </h2>

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
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-header-title">
                <span class="icon">
                    <i class="fa fa-archive"></i>
                </span>
                Kasus Lain dengan Nilai Similaritas Tertinggi
            </h1>
        </div>
        <div class="card-content">
            <div style="overflow-x:auto">
                <table class="table is-bordered is-striped is-narrow is-hoverable">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle"> No. </th>
                            <th colspan="{{ $features->count() }}" class="has-text-centered"> Gejala </th>
                            <th rowspan="2" style="vertical-align: middle"> Tahapan </th>
                            <th rowspan="2" style="vertical-align: middle" class="has-text-centered"> Kendali </th>
                        </tr>
        
                        <tr>
                            @foreach($features as $feature)
                            <th> {{ $feature->id }} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($case_records as $case_record)
                        <tr>
                            <td> {{ $loop->iteration }}. </td>
                            @foreach($features as $feature)
                            <td class="v-a:m">
                                @if($case_record["case_record_features"][$feature->id]["value"])
                                <i class="has-text-success fa fa-check"></i>
                                @else
                                <i class="has-text-danger fa fa-times"></i>
                                @endif
                            </td>
                            @endforeach
                            <td class="t-a:c"> {{ $case_record["level"] }} </td>
                            <td> {{ $case_record["distance"] }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection