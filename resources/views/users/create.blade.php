@extends('layouts.layout')

@section('title', "Add new User")
@section('content')
{{-- new user --}}
<div class="container" style="margin-bottom: 10%;">
    <div class="row">
      <div class="col-sm-4"> </div>
  <div class="col-md-4">
  <h1 class="text-center"> New User</h1>
  <br/>
  <div class="col-sm-12">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <br/>
    <div class="tab-content">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
    <div class="form-group">
      <label for="first_name">First Name</label>
      <input type="text" class="form-control" name="first_name" id="first_name" maxlength="100"  required>
    </div>

    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input type="text" class="form-control" name="last_name" id="last_name" maxlength="100" required>
    </div>


    <div class="form-group">
      <label for="status">Statut :</label>
      <div class="col-12 col-sm-10 d-flex">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="client" value="client" @if(old('status') == 'client') checked @endif required>
            <label class="form-check-label" for="client">Customer</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="admin" value="admin" @if(old('status') == 'admin') checked @endif required>
            <label class="form-check-label" for="admin">Admin</label>
        </div>
    </div>
    </div>

    <div class="form-group">
        <label for="email">E-mail : </label>
        <input type="text" class="form-control" name="email" id="email" maxlength="100" required>
      </div>

    <div class="form-group">
        <label for="password">Password : </label>
        <input type="password" class="form-control" name="password" id="password" minlength="8" maxlength="100" required>
      </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password : </label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" minlength="8" maxlength="100" required>
      </div>
{{-- submit --}}
  <button type="submit" class="pull-right btn btn-block btn-primary" >Submit</button>
  </form>
    </div>
</div>
</div>
</div>
</div>
@endsection
