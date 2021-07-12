@extends('layout.common')

@section('title', 'LaravelSample')
@section('keywords', 'Home')
@section('description', 'LaravelSample')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<div class="container-fluid">
  <p class="h5 mt-3">Document Information</p>
  <hr>

  <div class="row">
    <div class="col-2">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Monthly Asset</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Total Asset</a>
      </div>
    </div>
    <div class="col-9">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
          @include('document.details.monthly_asset')
        </div>
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
          @include('document.details.total_asset')
        </div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>

</div>


@endsection

@include('layout.footer')
