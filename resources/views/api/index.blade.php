@extends('layout.common')

@section('title', 'PersonalInfo')
@section('keywords', 'Home')
@section('description', 'This Page is Home')
@section('pageCss')
@endsection

@include('layout.header')

@section('content')
<script src="{{asset('js/myapi.js')}}"></script>
<div class="container">
  <p class="h5 mt-5">Create Api Key</p>
  <hr>
  <form>
    <div class="form-group row">
      <label for="project_key_id" class="col-sm-2 col-form-label col-form-label-sm">Project Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" id="project_key_id" name="project_key_name" placeholder="Enter a project name">
      </div>
      <div class="col-sm-1">
        <button type="button" class="btn btn-primary btn-sm" onclick="creaetKey()">Submit</button>
      </div>
      <div class="col-sm-5"></div>
    </div>
  </form>

  <p class="h5 mt-5">API Key List</p>
  <hr>
  <div class="row mt-3">
    <div class="col-sm">
      @if(count($keys) > 0)
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Created Date</th>
            <th scope="col">Project Key</th>
            <th scope="col">Project Name</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($keys as $key)
          <tr>
            <td>{{ $key->key_id }}</td>
            <td>{{ $key->create_date }}</td>
            <td>{{ $key->project_key }}</td>
            <td>{{ $key->project_name }}</td>
            @if($key->delete_flg <> '1')
              <td><button type="button" class="btn btn-outline-success btn-sm" onclick="updateKey('{{ $key->key_id }}','1')">Active</button></td>
            @else
              <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="updateKey('{{ $key->key_id }}','0')">Deactive</button></td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <p class="text-danger h5">There is no project keys</p>
      @endif
    </div>
  </div>

</div>


@endsection

@include('layout.footer')
