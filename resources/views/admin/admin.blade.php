@extends('admin.layouts.cms')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Admins</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div>
                <a href="{{ url('cms/admins/add') }}" class="btn btn-success float-sm-right ml-2"><i class="fas fa-plus"></i> Tambah Admin</a>
            </div><!-- /.col -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableAdmins" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Last Login</th>
                            <th style="width: 80px;">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/datatables-demo.js') }}"></script>

    <!-- BootBox -->
    <script src="{{ asset("js/bootstarp-bootbox.min.js") }}"></script>

    <script>
        $(document).ready(function(){
            $('#tableAdmins').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'pagingType': 'full_numbers',
                'paging': true,
                'ajax': {
                    'url':'<?php echo url("cms/admins/data"); ?>',
                    'type': 'GET',
                    'data': {'action':'#tableAdmins'}
                },
                'columns': [
                    { data: 'no' },
                    { data: 'name' },
                    { data: 'username' },
                    { data: 'role' },
                    { data: 'last_login' },
                    { data: 'action', className: 'text-center' },
                ],
                "columnDefs":[
                ]
            });
        });

        function deleteOrder(id) {
            bootbox.confirm({
                title: "Delete Order",
                message: "Select \"Delete\" below if you are ready to delete this order.",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Delete'
                    }
                },
                callback: function(result) {
                    if (result) {
                        $.ajax({
                            url: '<?php echo url("cms/admins/delete"); ?>',
                            type: "post",
                            dataType: "json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id
                            },
                            success: function(response) {
                                $('#tableAdmins').DataTable().ajax.reload()
                            }
                        });
                    }
                }
            });
        }
    </script>
@stop