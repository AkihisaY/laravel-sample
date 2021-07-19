@extends('layout.common')

@section('title', 'LaravelSample')
@section('keywords', 'LaravelTemp')
@section('description', 'LaravelSample')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<link href="{{asset('css/login.css')}}" rel="stylesheet">
<div class="container-fluid">
	@if ($msg != '')
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="alert alert-danger mt-3" role="alert"><strong>Failed Login </strong> : {{$msg}}</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
	@endif
    @if(isset($url))
        <input type="hidden" name="url" value="{{ $url }}">
    @endif
	<div class="login-container">
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <form action="/data/login" method="post">
                @csrf
                <input name="user_name" type="text" placeholder="username">
                <input name="user_pass" type="password" placeholder="password">
                <button class="btn btn-info btn-block login" type="submit">Login</button>
                <a href="/data/login/add">Create Account</a>
            </form>
        </div>
  </div>
</div>
@endsection

@include('layout.footer')
