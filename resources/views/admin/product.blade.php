@extends('admin.layouts.cms')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div>
                <a href="{{ url('cms/products/add') }}" class="btn btn-success float-sm-right ml-2"><i class="fas fa-plus"></i> Tambah Product</a>
            </div><!-- /.col -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableProducts" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
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
            $('#tableProducts').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'pagingType': 'full_numbers',
                'paging': true,
                'ajax': {
                    'url':'<?php echo url("cms/products/data"); ?>',
                    'type': 'GET',
                    'data': {'action':'#tableProducts'}
                },
                'columns': [
                    { data: 'no', className: 'dt-body-center' },
                    { data: 'sku' },
                    { data: 'name' },
                    { data: 'type' },
                    { data: 'price' },
                    { data: 'action' },
                ],
                "columnDefs":[
                ]
            });
        });

        function deleteProduct(id) {
            bootbox.confirm({
                title: "Delete Product",
                message: "Select \"Delete\" below if you are ready to delete this product.",
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
                            url: '<?php echo url("cms/products/delete"); ?>',
                            type: "post",
                            dataType: "json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id
                            },
                            success: function(response) {
                                $('#tableProducts').DataTable().ajax.reload()
                            }
                        });
                    }
                }
            });
        }
    </script>
@stop