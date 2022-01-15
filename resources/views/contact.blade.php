@extends('layouts.general_layout')
@section('title', 'Contact')
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('HelpForm.contact') }}" class="btn btn-default">Contact</a>
    </div>
</div>

<div class="all_post_items_container">
    <div class="slog m-0">
        <span style="font-family: 'Orbitron', sans-serif; font-size: 19px;">
            Have you any question to us, homie?
        </span>
        <br>
        <span style="font-family: 'Economica', sans-serif;font-size: 24px;">
            Send us a message, we will answer you asap... 
        </span>
    </div>

    <div class="card-body bg-white">
       
        <form action="{{ route('HelpForm.contact') }}" method="POST" class="controls">
            @if($status == 'succesed')
            <div class="alert alert-success">
                <strong>Success!</strong> Your message received.
            </div>
            @elseif($status == 'failure')
            <div class="alert alert-danger">
                <strong>Warrning!</strong> Something went wrong, try again later.
            </div>
            @endif

            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-error has-danger">
                        <label for="form_name">Firstname</label>
                        <input id="form_name" type="text" name="name" class="form-control input-style {{ $errors->has('name') ? 'error' : '' }}" value="{{ old('name') }}" placeholder="Please enter your firstname..." required>
                        <!-- error message -->
                        @error('name')
                        <span class="invalid-feedback" style="display:block !important;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-error has-danger">
                        <label for="form_lastname">Lastname</label>
                        <input id="form_lastname" type="text" name="surname" class="form-control input-style {{ $errors->has('surname') ? 'error' : '' }}" value="{{ old('surname') }}" placeholder="Please enter your lastname..." required>
                        <!-- error message -->
                        @error('surname')
                        <span class="invalid-feedback" style="display:block !important;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group has-error has-danger">
                <label for="form_email">Email</label>
                <input id="form_email" type="email" name="email" class="form-control input-style {{ $errors->has('email') ? 'error' : '' }}" value="{{ old('email') }}" placeholder="Please enter your email..." required>
                <!-- error message -->
                @error('email')
                <span class="invalid-feedback" style="display:block !important;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group has-error has-danger">
                <label for="form_subject">Subject</label>
                <input id="form_subject" type="text" name="subject" class="form-control input-style {{ $errors->has('subject') ? 'error' : '' }}" value="{{ old('subject') }}" placeholder="Please enter subject..." required>
                <!-- error message -->
                @error('subject')
                <span class="invalid-feedback" style="display:block !important;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
      
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-error has-danger">
                        <label for="form_message">Message</label>
                        <textarea id="form_message" name="message" class="form-control input-style {{ $errors->has('message') ? 'error' : '' }}" placeholder="Message for me..." rows="4" required>{{ old('message') }}</textarea>
                        <!-- error message -->
                        @error('message')
                        <span class="invalid-feedback" style="display:block !important;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="submit" class="btn btn-success btn-send" value="Send message">
                </div>
            </div>
    
        </form>


    </div>
</div>


@endsection