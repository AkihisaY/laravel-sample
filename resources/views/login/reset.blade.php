@extends('layout.common')

@section('title', 'LaravelSample')
@section('keywords', 'Home')
@section('description', 'LaravelSample')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<div class="container-fluid">

  <div class="alert alert-primary mt-5" role="alert">Plese fill out items.</div>

  <form action="/reset" method="post">
    {{csrf_field()}}
    <div class="form-group">
      <label for="formControlUser">User Name</label>
      <input type="text" class="form-control form-control-sm" id="formControlUser" placeholder="">
    </div>

    <button type="submit" class="btn btn-outline-primary btn-sm">Reset</button>
  </form>

</div>
@endsection

@include('layout.footer')
