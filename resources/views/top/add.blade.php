@extends('layout.common')

@section('title', 'PersonalInfo')
@section('keywords', 'Home')
@section('description', 'This Page is Home')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<div class="container">

  <div class="alert alert-primary mt-5" role="alert">Plese fill out items.</div>

  @if ($errors->any())
    <div class="alert alert-danger">There is/are validated item(s)</div>
  @endif

  <form action="/data/top/add" method="post">
    {{csrf_field()}}
    <div class="form-group row">
      <label for="inputDate" class="col-sm-3 col-form-label col-form-label-sm">Target_date</label>
      <div class="col-sm-3">
        <input type="date" class="form-control form-control-sm" id="inputDate" name="date_name" value="{{old('date_name')}}">
        @error('date_name')
          <label class="text-danger">{{ $message }}</label>
        @enderror
      </div>
      <div class="col-sm-6"></div>
    </div>
    <div class="form-group row">
      <label for="inputCashjpy" class="col-sm-3 col-form-label col-form-label-sm">Cash JPY</label>
      <div class="col-sm-3">
        <input type="number" class="form-control form-control-sm" id="inputCashjpy" name="cash_jpy_name" value="{{old('cash_jpy_name')}}">
        @error('cash_jpy_name')
          <label class="text-danger">{{ $message }}</label>
        @enderror
      </div>
      <div class="col-sm-6"></div>
    </div>
    <div class="form-group row">
      <label for="inputCashdoll" class="col-sm-3 col-form-label col-form-label-sm">Cash USD</label>
      <div class="col-sm-3">
        <input type="number" class="form-control form-control-sm" id="inputCashdoll" name="cash_dol_name" value="{{old('cash_dol_name')}}">
        @error('cash_dol_name')
          <label class="text-danger">{{ $message }}</label>
        @enderror
      </div>
      <div class="col-sm-6"></div>
    </div>
    <div class="form-group row">
      <label for="inputInvjpy" class="col-sm-3 col-form-label col-form-label-sm">Cash for investiment JPY</label>
      <div class="col-sm-3">
        <input type="number" class="form-control form-control-sm" id="inputInvjpy" name="inv_jpy_name" value="{{old('inv_jpy_name')}}">
        @error('inv_jpy_name')
          <label class="text-danger">{{ $message }}</label>
        @enderror
      </div>
      <div class="col-sm-6"></div>
    </div>
    <div class="form-group row">
      <label for="inputInvdoll" class="col-sm-3 col-form-label col-form-label-sm">Cash for investiment USD</label>
      <div class="col-sm-3">
        <input type="number" class="form-control form-control-sm" id="inputInvdoll" name="inv_dol_name" value="{{old('inv_dol_name')}}">
        @error('inv_dol_name')
          <label class="text-danger">{{ $message }}</label>
        @enderror
      </div>
      <div class="col-sm-6"></div>
    </div>
    <div class="form-group row">
      <label for="inputStockus" class="col-sm-3 col-form-label col-form-label-sm">Stock US</label>
      <div class="col-sm-3">
        <input type="number" class="form-control form-control-sm" id="inputStockus" name="stock_us_name" value="{{old('stock_us_name')}}">
        @error('stock_us_name')
          <label class="text-danger">{{ $message }}</label>
        @enderror
      </div>
      <div class="col-sm-6"></div>
    </div>
    <div class="form-group row">
      <label for="inputStockother" class="col-sm-3 col-form-label col-form-label-sm">Stock Other</label>
      <div class="col-sm-3">
        <input type="number" class="form-control form-control-sm" id="inputStockother" name="stock_other_name" value="{{old('stock_other_name')}}">
        @error('stock_other_name')
          <label class="text-danger">{{ $message }}</label>
        @enderror
      </div>
      <div class="col-sm-6"></div>
    </div>
    <div class="form-group row">
      <label for="inputRate" class="col-sm-3 col-form-label col-form-label-sm">Rate</label>
      <div class="col-sm-3">
        <input type="number" class="form-control form-control-sm" id="inputRate" name="rate_name" value="{{old('rate_name')}}" step="0.01">
        @error('rate_name')
          <label class="text-danger">{{ $message }}</label>
        @enderror
      </div>
      <div class="col-sm-6"></div>
    </div>
    <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
  </form>

</div>
@endsection

@include('layout.footer')
