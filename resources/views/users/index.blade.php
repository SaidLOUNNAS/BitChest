@extends('layouts.layout')
@section('JS')
    <script>
        $(function() {
            $('.datatable.custom').DataTable({
                order: [[3, "desc"]],
            });
        });
    </script>
@endsection
@section('title', 'Users')
@section('content')
<div style="margin-bottom: 400px;" class="card mb-4">
    <div class="card-body">
      <form style="float: right;" class="btn-toolbar justify-content needs-validation" action="" method="post">
        <!-- button add user -->
        <div class="form-group">
            <a class="btn btn-primary" style="border-radius: 0.35rem;" href="{{ route('users.create') }}" role="button"> <i class="fas fa-plus"></i> Add New User</a>
        </div>
      </form>
    </div>
    <!-- show table of users -->
    <table class="datatable custom">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-mail</th>
            <th>LastUpdate</th>
            <th>Status</th>
            <th data-orderable="false"></th>
            <th data-orderable="false"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->subscription_date }}</td>
                    <td>
                        @if ($user->status == 'admin')
                            <span class="badge badge-primary">Admin</span>
                        @elseif ($user->status == 'client')
                            <span class="badge badge-secondary">Customer</span>
                        @endif
                    </td>
                    <td><a type="button" class="" href="{{ route('users.edit', $user->id) }}"><i class="far fa-edit"></i></a></td>
                    <td>
                        <a href="#removeUser" class="delete" data-toggle="modal"
                        data-target="#modalremove"><i style='color:red;'class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
      <!-- for delete  user-->
      <div id="modalremove" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <form class="delete-form" action="{{ route('users.destroy', $user->id) }}" method="POST">
                @method('DELETE')
                @csrf
              <div class="modal-header">

                <h4 class="modal-title">Delete this User ?</h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>

              <div class="modal-body">
                <p>Are you sure you want to delete these user?</p>
              </div>
              <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                <input type="submit" class="btn btn-danger" value="Delete">
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection
