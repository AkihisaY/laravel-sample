@extends('layout.common')

@section('title', 'PersonalInfo')
@section('keywords', 'Home')
@section('description', 'This Page is Home')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<!-- <script src="{{asset('js/myapi.js')}}"></script> -->
<div class="container">
  <div class="row mt-3">
    <div class="col-sm-2">
      <p class="h5">Expense</p>
    </div>
    <div class="col-sm-10 text-right">
      <a href="/data/expense/csv" class="btn btn-success btn-sm">Import Csv</a>
    </div>
  </div>
  <hr>
  <form method="get" action="/data/expense">
    <div class="row">
      <div class="col-sm-4">
        <div class="input-group">
          <input type="text" class="form-control form-control-sm" id="keywords" name="keywords" value="{{ $search_key }}" placeholder="ex) Expense">
          <span class="input-group-btn">
            <button type="button" class="btn btn-default btn-success"><i class="fa fa-search"></i></button>
          </span>
        </div>
        <div class="col-sm-8"></div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-sm">
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col"><small><strong>#</strong></small></th>
              <th scope="col"><small><strong>Pay date</strong></small></th>
              <th scope="col"><small><strong>Amount</strong></small></th>
              <th scope="col"><small><strong>Contents</strong></small></th>
              <th scope="col"><small><strong>City</strong></small></th>
              <th scope="col"><small><strong>State</strong></small></th>
              <th scope="col"><small><strong>Country</strong></small></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($expenses as $expense)
            <tr>
              <td><small>{{ $expense->expense_id}}</small></td>
              <td><small>{{ $expense->pay_date}}</small></td>
              <td><small>{{ number_format($expense->pay_amount,2) }}</small></td>
              <td><small>{{ $expense->contents }}</small></td>
              <td><small>{{ $expense->city }}</small></td>
              <td><small>{{ $expense->state }}</small></td>
              <td><small>{{ $expense->country }}</small></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="d-flex justify-content-center">
      {{ $expenses->appends(['keywords' => $search_key])->links() }}
    </div>
  </form>

</div>


@endsection

@include('layout.footer')
