@extends('layout.common')

@section('title', 'PersonalInfo')
@section('keywords', 'Home')
@section('description', 'This Page is Home')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<!-- <script src="{{asset('js/myapi.js')}}"></script> -->
<script>
$(function(){
  $('.custom-file-input').on('change',function(){
      $(this).next('.custom-file-label').html($(this)[0].files[0].name);
  })
});

</script>
<div class="container">
  <p class="h5 mt-5">Import Expense CSV</p>
  <hr>
  <form method="post" action="/data/expense/csv" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row mt-2">
      <div class="col-sm-2"></div>
      <div class="custom-file col-sm-4">
        <input type="file" class="custom-file-input" name="csv_file" id="file_id">
        <label class="custom-file-label" for="file_id">Choose file...</label>
      </div>
      <div class="col-sm-6">
        <button class="btn btn-success show">Submit</button>
      </div>
    </div>
    <input type="hidden" name="test" value="aiue">
    </form>
</div>


@endsection

@include('layout.footer')
