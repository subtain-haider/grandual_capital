@php
    $layout = \App\Models\Front::first()->layout;
@endphp
@extends('layouts.'.$layout)

@section('content')

    @php
  $ref_by =  $_GET['ref_by'] ?? '';
@endphp
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="home-banner parallax" id="banner" >
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 m-auto">
                    <form method="POST" action="{{ route('register') }}" id="frmRegister" class="sky-form">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input id="name" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" placeholder="Full Name" required >
                            <input name="ref_by" type="hidden" value="{{$ref_by}}" >
                            @error('fname')
                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="User Name" required >
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">

                        </div>
                        <div class="mb-3">
                            <label class="" for="">Signature:</label>
                            <br/>
                            <div id="sig" ></div>
                            <br/>
                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" required> <label class="form-check-label" for="exampleCheck1">I agree to <a target="_blank" href="{{route('terms')}}"><u>Terms and Conditions</u></a></label>
                        </div>
                        <button type="submit" class="btn btn-primary m-auto">Register</button>
                        <div class="mb-3 form-check">
                            <label class="form-check-label" for="exampleCheck1">Already have an account? <a href="/login"><u>Click here to sign in.</u></a></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
