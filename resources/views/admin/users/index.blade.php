@extends('layouts.admin-base')
@section('title','Users')
@section('content')
<div class="container my-5 py-5">
    <div class="row">
        <div class="col-12">
            <h4 class="card-title"> User Table</h4>
        </div>
        <div class="col-md-12">
            <div class="card  card-plain">
              <div class="card-header">
                   <div class="row">
                        <div class="col-12">
                            {{$users->links()}}
                        </div>
                   </div>
              </div>
              <div class="card-body">
                @if (Session::has('user_deleted'))
                <div class="alert-success">
                    <p class="text-dark px-5 py-2">{{Session::get('user_deleted')}}</p>
                </div>
                @endif
                <div class="table-responsive my-3">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Book Count</th>
                        @if (Auth::user()->role === 'ADMIN')
                        <th>ACTION</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        @if ($user->role === 'ADMIN')
                        <tr style="background: rgba(211, 13, 13, 0.5);">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td id="user_role_{{$user->id}}">{{$user->role}}</td>
                            <td>{{count($user->books)}}</td>
                            @if (Auth::user()->role === 'ADMIN')
                            <td>
                                <div class="d-flex justify-content-between py-auto">
                                    <a href="javascript:void(0)" onclick="editRole({{$user->id}});" class="text-success"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('admin_users.delete',['id' => $user->id])}}" onclick="confirm('Are you sure to delete?')" class="text-danger"><i class="fa fa-trash-alt"></i></a>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @elseif($user->role === 'EDITOR')
                        <tr style="background: rgba(6, 18, 182, 0.5);">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td id="user_role_{{$user->id}}">{{$user->role}}</td>
                            <td>{{count($user->books)}}</td>
                            @if (Auth::user()->role === 'ADMIN')
                            <td>
                                <div class="d-flex justify-content-between py-auto">
                                    <a href="javascript:void(0)" onclick="editRole({{$user->id}});" type="button" class="text-success"><i class="fa fa-edit"></i></a>

                                    <a href="{{route('admin_users.delete',['id' => $user->id])}}" onclick="confirm('Are you sure to delete?')" class="text-danger"><i class="fa fa-trash-alt"></i></a>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @else
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td id="user_role_{{$user->id}}">{{$user->role}}</td>
                            <td>{{count($user->books)}}</td>
                            @if (Auth::user()->role === 'ADMIN')
                            <td>
                                <div class="d-flex justify-content-between py-auto">
                                    <a href="javascript:void(0)" onclick="editRole({{$user->id}});" class="text-success"><i class="fa fa-edit"></i></a>

                                    <a href="{{route('admin_users.delete',['id' => $user->id])}}" onclick="confirm('Are you sure to delete?')" class="text-danger"><i class="fa fa-trash-alt"></i></a>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                            <!-- Modal -->
                            <div class="modal fade" id="edit_role">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Change User Role</h5>
                                        <button class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="edit_user_role_error"></div>
                                            <form id="edit_user_role">
                                            @csrf
                                            <input type="hidden" name="id" id="id">
                                                <div class="form-group">
                                                    <select class="form-control" id="role" name="role">
                                                        <option value="USER">User</option>
                                                        <option value="EDITOR">Editor</option>
                                                        <option value="ADMIN">Admin</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </tbody>
                  </table>
                </div>
                {{$users->links()}}
              </div>
            </div>
          </div>
    </div>
</div>

@endsection
