<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <link href="" rel="shortcut icon">
        <link href="{{ asset('public/packages/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/backend/css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/backend/css/responsive.css') }}" rel="stylesheet" type="text/css">
        <style type="text/css">
            body{
                background-color: #f5f5f5;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <h4 class="card-header">{{ __('Reset Password') }}</h4>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('public/packages/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/packages/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    </body>
</html>