@extends('layout.common')

@section('title', 'LaravelSample')
@section('keywords', 'Home')
@section('description', 'LaravelSample')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<script src="{{asset('js/mytop.js')}}"></script>
<div class="container">
  <p class="h5 mt-3">Asset Chart</p>
  <hr>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
      <canvas id="myChart"></canvas>
    </div>
    <div class="col-sm-5">
      <canvas id="circleChart2" class="mt-4"></canvas>
    </div>
    <div class="col-sm-2">
    <!-- <canvas id="circleChart"></canvas> -->
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-9">
      <p class="h5 mt-3">Asset List</p>
    </div>
    <div class="col-sm-3">
      <a class="btn btn-success btn-sm mt-1" href="/data/top/add">Create New</a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
      <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col"><small><strong>Asset ID</strong></small></th>
            <th scope="col"><small><strong>Date</strong></small></th>
            <th scope="col"><small><strong>Cash(JPY)</strong></small></th>
            <th scope="col"><small><strong>Cash(EN)</strong></small></th>
            <th scope="col"><small><strong>Cash For Inve(JPY)</strong></small></th>
            <th scope="col"><small><strong>Cash For Inve(EN)</strong></small></th>
            <th scope="col"><small><strong>Stock(JPY)</strong></small></th>
            <th scope="col"><small><strong>Total</strong></small></th>
            <th scope="col"><small><strong>rate(/100Yen)</strong></small></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($assets as $asset)
          <tr>
            <td><small>{{ $asset->asset_id}}</small></td>
            <td><small>{{ $asset->display_date}}</small></td>
            <td><small>{{ number_format($asset->cash_jpy) }}</small></td>
            <td><small>{{ number_format($asset->cash_dol) }}</small></td>
            <td><small>{{ number_format($asset->cash_inv_jpy) }}</small></td>
            <td><small>{{ number_format($asset->cash_inv_dol) }}</small></td>
            <td><small>{{ number_format($asset->stock_us) }}</small></td>
            <td><small>{{ number_format($asset->cash_jpy+$asset->cash_dol+$asset->cash_inv_jpy+$asset->stock_us) }}</small></td>
            <td><small>{{ $asset->rate }}</small></td>
            <td><small><button type="button" class="btn btn-danger btn-sm" onclick="deleteData('{{ $asset->asset_id }}')"><i class="fas fa-trash-alt"></i></button></small></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="d-flex justify-content-center">
    {{ $assets->links() }}
  </div>

</div>


@endsection

@include('layout.footer')
