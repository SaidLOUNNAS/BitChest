@extends('layouts.layout')

@section('title', "Edit User")
{{-- edit user --}}
@section('content')
    <div class="container" style="margin-bottom: 10%;">
        <div class="row">
          <div class="col-sm-4"> </div>
      <div class="col-md-4">
      <h1 class="text-center"> Edit {{ $user->last_name }} </h1>
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


        <div class="form-group">
          <label for="status">Statut : </label>
          <div class="col-12 col-sm-10 d-flex">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="client" value="client" @if($user->status == 'client') checked @endif required>
                <label class="form-check-label" for="client">Customer</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="admin" value="admin" @if($user->status == 'admin') checked @endif required>
                <label class="form-check-label" for="admin">Admin</label>
            </div>
        </div>
        </div>
        <div class="form-group">
            <label for="email">E-mail : </label>
            <input type="text" class="form-control" name="email" id="email" maxlength="100" value="{{ $user->email }}" required>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <br/>
      <a href="{{ route('users.index') }}" class="pull-right btn btn-block btn-danger">Cancel</a>
          </div>
    </div>
</div>
</div>
</div>
@endsection
