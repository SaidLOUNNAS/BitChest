@extends('layouts.layout')

@section('title', "Account")

@section('content')

<div class="container" style="margin-bottom: 10%;">
    <div class="row">
  <div class="col-md-4">
  <h1 class="text-center">Profile</h1>
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
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @method('PATCH')
            @csrf
    <div class="form-group">
      <label for="first_name">First Name : </label>
      <input type="text" class="form-control" name="first_name" id="first_name" maxlength="100" value="{{ $user->first_name }}" required>
    </div>

    <div class="form-group">
      <label for="last_name">Last Name : </label>
      <input type="text" class="form-control" name="last_name" id="last_name" maxlength="100" value="{{ $user->last_name }}" required>
    </div>
     {{-- status --}}
     <div class="form-group">
        <label for="inputAddress">Status :</label>
        <p style="background-color: rgb(228, 228, 228)" class="form-control" id="status" class="m-0 d-flex align-items-center">
            @if ($user->status == 'admin')
                ADMIN
            @elseif ($user->status == 'client')
            CUSTOMER
            @endif
        </p>
      </div>
    <div class="form-group">
        <label for="email">E-mail : </label>
        <input type="text" class="form-control" name="email" id="email" maxlength="100" value="{{ $user->email }}" required>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
      </div>
</div>
</div>
</div>
</div>
@endsection
