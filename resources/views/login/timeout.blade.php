@extends('layout.common')

@section('title', 'LaravelSample')
@section('keywords', 'LaravelTemp')
@section('description', 'LaravelSample')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<div class="container">
    <div class="alert alert-danger mt-3" role="alert"><strong>Session Time out Error </strong></div>

    <p><a href="/login">Please login again</a></p>
</div>
@endsection

@include('layout.footer')
