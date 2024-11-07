@extends('layouts.app')

@section('title') Register @endsection

@section('content')
@if($userCount)

    <div class="row">
        <div class="offset-md-3 text-center">
        <p>Isomara Island is currently in Early Access. To register for an account you will need an Invitation Key.<br>
            <a href="/support">Support us</a> to receive an Invitation Key via email. Follow us on <a href="https://bsky.app/profile/isomaraisland.com">Bluesky</a> and join our <a href="https://discord.gg/62ZGCYFUDu">Discord</a> for updates and news.
        </p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 offset-md-4">
            <br>
            <h1>Register</h1>
        </div>
    </div>

    {{--<h3 class="mt-5 text-center">Regular Registration</h3>--}}
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <i class="fas fa-exclamation-triangle" data-toggle="tooltip" title="Yahoo & Hotmail accounts may have trouble receiving emails from us. We strongly recommend using another email address; otherwise, if you do not receive a verification email upon sign-up after an hour, email us at npc@isomaraisland.com or message @isomaraARPG on Twitter." style="opacity: 50%;"></i>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        @if(!Settings::get('is_registration_open'))
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Invitation Key {!! add_help('Registration is currently closed. An invitation key is required to create an account.') !!}</label>

                <div class="col-md-6">
                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" required autofocus>

                    @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <div class="form-group row">
            {{ Form::label('dob', 'Date of Birth', ['class' => 'col-md-4 col-form-label text-md-right']) }}
            <div class="col-md-6">
                <div class="d-flex col-md-row">
                {{ Form::selectRange('dob[day]', 1, 31, null, ['class' => 'form-control col-3']) }}
                {{ Form::selectMonth('dob[month]', null, ['class' => 'form-control col-4']) }}
                {{ Form::selectYear('dob[year]', date('Y'), date('Y') - 70, null, ['class' => 'form-control col-3']) }}
            </div>

            </div>
            @if ($errors->has('dob'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dob') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group row">
            <label for="referred_by" class="col-md-4 col-form-label text-md-right">Referred By {!! add_help('Select or type in the username of the person who referred you. They will receive rewards for your referral. Otherwise leave blank if you were not referred by anyone.') !!}</label>
            <div class="col-md-6">
                {!! Form::select('referred_by', $users, old('referred'), ['class' => 'form-control selectize', 'placeholder' => 'Select User']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <label class="form-check-label">
                        {!! Form::checkbox('agreement', 1, false, ['class' => 'form-check-input']) !!}
                        I have read and agree to the <a href="{{ url('info/terms') }}">Terms of Service</a> and <a href="{{ url('info/privacy') }}">Privacy Policy</a>.
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" value="register" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>

            <div class="col-md-8 offset-md-4">
                <br><br>
                    <a class="btn btn-link" href="/login">
                        {{ __('Already have an account? Log in here') }}
                    </a>
            </div>
        </div>
    </form>
    <hr>
    <h3 class="text-center">Alternate Registrations</h3>
    @foreach(Config::get('lorekeeper.sites') as $provider => $site)
        @if(isset($site['login']) && $site['login'])
            <div class="text-center w-60 m-auto pt-2 pb-2">
                <a href="{{ url('/login/redirect/'.$provider) }}" class="btn btn-primary text-white w-50"><i class="{{ $site['icon'] }} mr-2"></i> Register With {{ ucfirst($provider) }}</a>
            </div>
        @endif
    @endforeach

@else
    @include('auth._require_setup')
@endif
@endsection
