@extends('shared.layout')
@section('title', 'Login')
@section('content')

<div class="container mt-5">
    <div class="card" style="max-width: 25rem; margin-left: auto; margin-right: auto">
        <div class="card-header">
            <div class="card-header-title">
                <span class="icon">
                    <i class="fa fa-sign-in"></i>
                </span>
                Masuk
            </div>
        </div>
        <div class="card-content">
            <form method='POST' action='{{ route('login') }}'>
                @csrf
            
                <div class="field">
                    <label for="username" class="label"> Nama Pengguna: </label>
                    <input placeholder="Nama Pengguna" value="{{ old('username') }}" type="text" name="username" class="input {{ $errors->first("username", "is-danger") }}">
                    @if($errors->has("username"))
                    <p class="help is-danger"> {{ $errors->first("username") }} </p>
                    @endif
                </div>

                <div class="field">
                    <label for="password" class="label"> Kata Sandi: </label>
                    <input placeholder="Kata Sandi" value="{{ old('password') }}" type="password" name="password" class="input {{ $errors->first("password", "is-danger") }}">
                    @if($errors->has("password"))
                    <p class="help is-danger"> {{ $errors->first("password") }} </p>
                    @endif
                </div>

                <div style="text-align: right" class="mt-4">
                    <button class="button is-primary">
                        <span>
                            Masuk
                        </span>
                        <span class="icon is-small">
                            <i class="fa fa-sign-in"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection