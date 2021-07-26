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
  <p class="h5 mt-5">Expense</p>
  <hr>
  <div class="row">
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
    {{ $expenses->links() }}
  </div>

</div>


@endsection

@include('layout.footer')
