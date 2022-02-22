@extends('layouts.app')
@section('breadcrumb', Breadcrumbs::render('login'))
@section('content')
<div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Sign In</h5>
                <div id="uLogin" data-ulogin="display=buttons;theme=classic;fields=first_name,last_name,photo;providers=google;hidden=;redirect_uri={{ urlencode(route('login.callback')) }}">
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" data-uloginbutton="google">Sign in</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="//ulogin.ru/js/ulogin.js"></script>
@endsection
