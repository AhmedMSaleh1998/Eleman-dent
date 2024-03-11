@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #6b0b0c;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #6b0b0c;
        color: white;
        font-weight: bold;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .form-label {
        color: #6b0b0c;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #7e0c0d; /* Darker shade of primary color */
        border-color: #7e0c0d;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #900e0f; /* Darker shade on hover */
        border-color: #900e0f;
    }

    .form-check-label {
        color: #6b0b0c;
    }

    .form-control {
        border-radius: 10px;
    }

    .form-control:focus {
        border-color: #7e0c0d; /* Border color on focus */
        box-shadow: 0 0 0 0.2rem rgba(126, 14, 15, 0.25); /* Box shadow on focus */
    }

    .forgot-password-link {
        color: #7e0c0d;
        font-weight: bold;
        text-decoration: none;
    }

    .forgot-password-link:hover {
        color: #900e0f;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Eleman Dental Dashboard') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
