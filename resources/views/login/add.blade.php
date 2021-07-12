@extends('layout.common')

@section('title', 'LaravelSample')
@section('keywords', 'LaravelTemp')
@section('description', 'LaravelSample')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<script src="{{asset('js/login.js')}}"></script>
<div class="container-fluid">
    <!-- <form> -->
        <div class="form-group row mt-3">
            <div class="col-sm-3">
                <label for="inputUser" class="form-label form-label-sm">User Name</label>
                <input type="text" class="form-control form-control-sm" id="inputUser" aria-describedby="userHelp">
            </div>
            <div class="col-sm-9"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">
                <label for="inputPassword" class="form-label form-label-sm">Password</label>
                <input type="password" class="form-control form-control-sm" id="inputPassword">
            </div>
            <div class="col-sm-9"></div>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm" onclick="createLogin()">Submit</button>
    <!-- </form> -->
</div>
@endsection

@include('layout.footer')
