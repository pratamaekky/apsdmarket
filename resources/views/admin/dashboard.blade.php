@extends('admin.layouts.cms')

@section('content')
    @if ($errors->has('message'))
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Not Authenticated</h6>
            </div>
            <div class="card-body">
                <span class="text-danger">{{ $errors->first('message') }}</span>
            </div>
        </div>
    @else
        Halaman Dashboard
    @endif
@stop