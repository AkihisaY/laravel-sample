@extends('layout.common')

@section('title', 'LaravelSample')
@section('keywords', 'LaravelTemp')
@section('description', 'LaravelSample')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<div class="container">
    <div class="alert alert-danger mt-3" role="alert"><strong>We got unexpected error.</br>Please cpntact your system administrator.</strong></div>
</div>
@endsection

@include('layout.footer')
