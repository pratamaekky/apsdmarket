@extends('admin.layouts.cms')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Admin</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Admin</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('saveAdmin')}}">
                {{ csrf_field() }}
                <div class="col-12 row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control form-control-user" id="inputName" placeholder="Enter Name..." value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control form-control-user" id="inputUsername" placeholder="Enter Username..." value="{{ old('username') }}">
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control form-control-user" id="inputRole" placeholder="Enter Role...">
                                <option value="">-- Choose Role --</option>
                                <option value="admin" {{ old('type') == "admin" ? "selected" : "" }}>Admin</option>
                                <option value="staff" {{ old('type') == "staff" ? "selected" : "" }}>Staff</option>
                            </select>
                            @if ($errors->has('role'))
                                <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control form-control-user" id="inputPassword" placeholder="Enter Password..." value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    </script>
@stop