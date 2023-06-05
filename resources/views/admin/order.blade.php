@extends('admin.layouts.cms')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Orders</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div>
                <button type="button" class="btn btn-outline-success float-sm-right"><i class="far fa-file-alt"></i> Import</button>
            </div><!-- /.col -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableOrders" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th style="width: 140px;">Order No</th>
                            <th style="width: 180px;">Receiver Name</th>
                            <th>Receiver Address</th>
                            <th style="width: 180px;">Receiver Phone</th>
                            <th style="width: 150px;">Shipping Fee</th>
                            <th style="width: 40px;">Action</th>
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
            $('#tableOrders').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'pagingType': 'full_numbers',
                'paging': true,
                'ajax': {
                    'url':'<?php echo url("cms/orders/data"); ?>',
                    'type': 'GET',
                    'data': {'action':'#tableOrders'}
                },
                'columns': [
                    { data: 'no' },
                    { data: 'order_no' },
                    { data: 'receiver_name' },
                    { data: 'receiver_address' },
                    { data: 'receiver_phone' },
                    { data: 'shipping_fee' },
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
                            url: '<?php echo url("cms/orders/delete"); ?>',
                            type: "post",
                            dataType: "json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id
                            },
                            success: function(response) {
                                $('#tableOrders').DataTable().ajax.reload()
                            }
                        });
                    }
                }
            });
        }
    </script>
@stop