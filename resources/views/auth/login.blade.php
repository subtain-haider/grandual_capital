@php
    $layout = \App\Models\Front::first()->layout;
@endphp
@extends('layouts.'.$layout)

@section('content')


    <!-- MAIN CONTENT -->


    <section class="home-banner parallax" id="banner" >
        <div class="container">
            <div class="row">
                <div class="col-12 col-md4 m-auto">
                    <form method="POST" action="{{ route('login') }}" id="frmLogin" class="sky-form">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email')is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <label class="form-check-label" for="exampleCheck1">Do not have an account? <a href="/register"><u>Sign up</u></a></label>
                            <label class="form-check-label float-right" > <a href="/password/reset"><u>Forgot Password</u></a></label>
                        </div>
                        <button type="submit" class="btn btn-primary m-auto">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection
