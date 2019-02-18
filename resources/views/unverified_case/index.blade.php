@extends('shared.layout')
@section('title', 'Manajemen Kasus Baru')
@section('content')

<div class="container p-x:5 m-y:5">
    @include('shared.message')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li> <a href="#"> {{ config('app.name') }} </a> </li>
            <li class="is-active"><a href="{{ route('verified_case.index') }}" aria-current="page"> Manajemen Kasus Baru </a></li>
        </ul>
    </nav>

    <h1 class="title">
        Manajemen Kasus Baru
    </h1>

    <div class="t-a:r m-y:3">
        <a class="button is-dark" href="{{ route('unverified_case.create') }}">
            <span>
                Tambah Basis Kasus
            </span>
            <span class="icon is-small">
                <i class="fa fa-plus"></i>
            </span>
        </a>
    </div>

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
                    <td> {{ $case_records->firstItem() + $loop->index }}. </td>
                    @foreach ($features as $feature)
                    <td class="v-a:m">
                        @if($case_record->case_record_features[$feature->id])
                        <i class="has-text-success fa fa-check"></i>
                        @else
                        <i class="has-text-danger fa fa-times"></i>
                        @endif
                    </td>
                    @endforeach
                    
                    <td class="t-a:c"> {{ $case_record->level }} </td>

                    <td class="t-a:m" style="white-space : nowrap;">

                        <a class="button is-dark is-small" href="{{ route('unverified_case.edit', $case_record->id) }}">
                            <span>
                                Ubah
                            </span>
                            <span class="icon is-small">
                                <i class="fa fa-pencil"></i>
                            </span>
                        </a>

                        <a class="button is-dark is-small" href="{{ route('case_analysis.show', $case_record->id) }}">
                            <span>
                                Analisis
                            </span>
                            <span class="icon is-small">
                                <i class="fa fa-calculator"></i>
                            </span>
                        </a>

                        <form class="d:i-b" method='POST' action='{{ route('unverified_case.verify', $case_record->id ) }}'>
                            @csrf
                            <button class="button is-success is-small">
                                <span>
                                    Verifikasi
                                </span>
                                <span class="icon is-small">
                                    <i class="fa fa-check"></i>
                                </span>
                            </button>
                        </form>

                        <form class="d:i-b" method='POST' action='{{ route('unverified_case.delete', $case_record->id) }}'>
                            @csrf
                            <button class="button is-danger is-small">
                                <span>
                                    Hapus
                                </span>
                                <span class="icon is-small">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-y:3">
            {{ $case_records->links() }}
        </div>
    </div>
</div>
@endsection