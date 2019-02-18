@extends('shared.layout')
@section('title', 'Manajemen Basis Kasus')
@section('content')

<div class="container p-x:5 m-y:5">

    @include('shared.message')

    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li> <a href="#"> {{ config('app.name') }} </a> </li>
            <li class="is-active"><a href="{{ route('verified_case.index') }}" aria-current="page"> Manajemen Basis Kasus </a></li>
        </ul>
    </nav>

    <h1 class="title">
        Manajemen Basis Kasus
    </h1>

    <div class="t-a:r m-y:3">
        <a class="button is-dark" href="{{ route('verified_case.create') }}">
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
                <th> No. </th>
                @foreach($features as $feature)
                <th> {{ $feature->id }} </th>
                @endforeach
                <th class="has-text-centered"> Kendali </th>
            </thead>
            <tbody>
                @foreach ($case_records as $case_record)
                <tr>
                    <td> {{ $case_records->firstItem() + $loop->index }}. </td>
                    @foreach($features as $feature)
                    <td class="v-a:m">
                        @if($case_record->case_record_features[$feature->id])
                        <i class="has-text-success fa fa-check"></i>
                        @else
                        <i class="has-text-danger fa fa-times"></i>
                        @endif
                    </td>
                    @endforeach
                    <td class="has-text-centered">

                        <a href="{{ route('verified_case.edit', $case_record->id) }}" class="button is-dark is-small">
                            <span> Ubah </span>
                            <span class="icon is-small">
                                <i class="fa fa-pencil"></i>
                            </span>
                        </a>

                        <form class="d:i-b" method='POST' action='{{ route('verified_case.unverify', $case_record->id) }}'>
                            @csrf
                        
                            <button class="button is-warning is-small">
                                <span>
                                    H. Verifikasi
                                </span>
                                <span class="icon is-small">
                                    <i class="fa fa-times"></i>
                                </span>
                            </button>
                        </form>

                        <form class="d:i-b" method="POST" action="{{ route('verified_case.delete', $case_record->id) }}">
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
    </div>

    <div class="p-y:3">
        {{ $case_records->links() }}
    </div>
</div>

@endsection