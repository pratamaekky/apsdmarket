@extends('admin.layouts.cms')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('cms/products/update/' . $product['id'])}}" enctype="multipart/form-data">
                @csrf
                <div class="col-12 row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>SKU</label>
                            <input type="text" name="sku" class="form-control form-control-user" id="inputSku" placeholder="Enter SKU..." value="{{ old('sku', $product['sku']) }}">
                            @if ($errors->has('sku'))
                                <span class="text-danger">{{ $errors->first('sku') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control form-control-user" id="inputName" placeholder="Enter Name..." value="{{ old('name', $product['name']) }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="form-control form-control-user" id="inputType" placeholder="Enter Type...">
                                <option value="">-- Choose Type --</option>
                                <option value="1" {{ old('type', $product['type']) == "1" ? "selected" : "" }}>Food & Beverage</option>
                                <option value="2" {{ old('type', $product['type']) == "2" ? "selected" : "" }}>Retail</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control form-control-user" id="inputPrice" placeholder="Enter Price..." value="{{ old('price', $product['price']) }}">
                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Decription</label>
                            <textarea name="description" class="form-control form-control-user" id="inputDescription" placeholder="Enter Description..." style="height: 7.75rem">{{ old('description', $product['description']) }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control form-control-user" id="inputDescription" placeholder="Enter Image..." value="{{ old('image') }}" rows="5"></textarea>
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2"></i>Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    </script>
@stop