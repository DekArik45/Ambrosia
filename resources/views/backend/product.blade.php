@extends('backend.layouts.app')
@section('product', 'active')
@section('master', 'active')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Product</h3>
                    <button style="float:right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-input">
                        <i class="fa fa-plus"></i> Add New Product
                    </button>
                </div>
                <div class="box-body">
                    <table style="margin-top:10px;" id="product" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                {{-- <th>No.</th> --}}
                                <th>Product Images</th>
                                <th>Product Name</th>
                                <th>Product Category</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stok</th>
                                <th>Weight</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                                <tr class="data-row">
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td class="image_name" style="width:29%;">
                                        @foreach ($product_image as $image)
                                            @if ($image->product_id == $item->id)
                                                <div class="cover-image">
                                                    <div class="mask-image">
                                                        <form action="/admin/delete-image/{{$image->id}}" method="GET">
                                                            @csrf
                                                            <button style="background:rgba(0, 0,0,0);border-color:rgba(0, 0,0,0);
                                                                margin: 0;
                                                                background: rgba(0, 0,0,0);
                                                                border-color: rgba(0, 0,0,0);
                                                                top: 0;
                                                                line-height: 130px;
                                                                padding: 0; font-size:30px;" id="delete" type="button" class="btn btn-danger" title="Delete">
                                                                X
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <img class="image-product" style="width:130px; height:130px;" src="{{ asset($image->image_name) }}" alt="">
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="cover-image">
                                            <div class="mask-image" style="display:block;">
                                                    <button style="background:rgba(0, 0,0,0);border-color:rgba(0, 0,0,0);
                                                        margin: 0;
                                                        background: rgba(0, 0,0,0);
                                                        border-color: rgba(0, 0,0,0);
                                                        top: 0;
                                                        line-height: 130px;
                                                        color:greenyellow;
                                                        padding: 0; font-size:50px;" id="add-image" data-item-id="{{$item->id}}" data-toggle="modal" data-target="#modal-input-image" type="button" class="btn btn-danger" title="ADD">
                                                        +
                                                    </button>
                                            </div>
                                            <img class="image-product" style="display:inline-block;width:130px; height:130px; margin-bottom:3px;" src="" alt="">
                                        </div>
                                    </td>
                                    <td class="product_name">{{ $item->product_name }}</td>
                                    <td class="category_name">

                                        <table style="width:100%;">
                                            @foreach ($product_category as $item_category)
                                                <tr>
                                                    @if ($item_category->product_id == $item->id)
                                                    <td>{{ $item_category->category_name }} </td>
                                                    <td>
                                                        <form style="float:right;" action="/admin/delete-category/{{$item_category->id}}" method="GET">
                                                            @csrf
                                                            <button class="btn btn-danger" id="delete" style="font-size: 11px;
                                                            padding: 1px 6px;" type="button">
                                                                X
                                                            </button>
                                                        </form>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2">
                                                    <button style="padding: 2px 7px;
                                                    width: 100%;
                                                    font-size: 11px;
                                                    margin-top: 10px;" type="button" id="add-category" data-item-id="{{$item->id}}" class="btn btn-primary" data-toggle="modal" data-target="#modal-input-category">
                                                        <i class="fa fa-plus"></i> Add Category
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td class="description">{{ $item->description }}</td>
                                    <td class="price">{{ $item->price }}</td>
                                    <td class="stock">{{ $item->stock }}</td>
                                    <td class="weight">{{ $item->weight }}</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <button type="button" id="edit-item" data-item-id="{{$item->id}}" class="btn btn-warning" title="Edit">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <form action="/admin/product/{{ $item->id }}" method="POST" class="btn-group">
                                                        @csrf
                                                        @method("DELETE")
                
                                                        <button type="button" id="delete" class="btn btn-danger" title="Delete">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- add modal --}}
<div id="modal-input" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Product</h4>
            </div>
            <form action="/admin/product" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        {{ csrf_field() }}
                    
                        <div class="form-group">
                            <label for="image-label" id="image-click-label">Product Image</label>
                            <label for="image" id="image-label" class="form-control"  style="font-weight: normal">Click to select the Product image</label>
                            <input type="file" required name="image[]" id="image" multiple accept="image/*" style="display:none;" />
                        </div>

                    <div class="form-group">
                        <label for="courier">Product Name</label>
                        <input type="text" required name="product_name" class="form-control" placeholder="Product Name" />
                    </div>

                    <div class="form-group">
                        <label >Product Category</label>
                        <select required class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="category_name[]">
                            @foreach ($category as $data_category)
                                <option value="{{$data_category->id}}">{{$data_category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="courier">Description</label>
                        <input required type="text" name="description" class="form-control" placeholder="Description" />
                    </div>

                    <div class="form-group">
                            <label for="courier">Price</label>
                            <input required type="number" name="price" class="form-control" placeholder="Price" />
                        </div>

                    <div class="form-group">
                        <label for="courier">Stock</label>
                        <input required type="number" name="stock" class="form-control" placeholder="Stock" />
                    </div>

                    <div class="form-group">
                        <label for="courier">Weight</label>
                        <input required type="number" name="weight" class="form-control" placeholder="Weight" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- edit modal --}}
<div class="modal fade" id="modal-default" >
    <div class="modal-dialog " >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Product</h4>
            </div>

            <form id="edit-form"  method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="courier">Product Name</label>
                        <input type="text" id="modal-edit-name" required name="product_name" class="form-control" placeholder="Product Name" />
                    </div>
                    
                    <div class="form-group">
                        <label for="courier">Description</label>
                        <input required type="text" id="modal-edit-desc" name="description" class="form-control" placeholder="Description" />
                    </div>
    
                    <div class="form-group">
                            <label for="courier">Price</label>
                            <input required type="number" name="price" id="modal-edit-price" class="form-control" placeholder="Price" />
                        </div>
    
                    <div class="form-group">
                        <label for="courier">Stock</label>
                        <input required type="number" name="stock" class="form-control" id="modal-edit-stok" placeholder="Stock" />
                    </div>
    
                    <div class="form-group">
                        <label for="courier">Weight</label>
                        <input required type="number" name="weight" class="form-control" id="modal-edit-weight" placeholder="Weight" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal-input-image" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Product Image</h4>
            </div>
            <form action="" method="POST" id="imageForm" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method("PUT")
                    
                    <div class="form-group">
                        <label for="single-image-label" id="single-image-click-label">Product Image</label>
                        <label for="single-image" id="single-image-label" class="form-control"  style="font-weight: normal">Click to select the Product image</label>
                        <input type="file" required name="image[]" id="single-image" multiple accept="image/*" style="display:none;" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="modal-input-category" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Product category</h4>
            </div>
            <form action="" method="POST" id="categoryForm" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @method("PUT")

                    <div class="form-group">
                        <label >Product Category</label>
                        <select required class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="category_name[]">
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->category_name}}</option>    
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /Attachment Modal -->
@endsection

@section('script')
    
<!-- Select2 -->
<script src="{{asset ("backend/bower_components/select2/dist/js/select2.full.min.js")}}"></script>
<script src="{{ asset ("backend/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
<script>
    $(function() {
        $("#product").DataTable();
    });

</script>

<script>
    $(document).ready(function() {

        $('.select2').select2()
    /**
    * for showing edit item popup
    */

    //input category
    $(document).on('click', "#add-category", function() {
        $(this).addClass('add-category-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
        'backdrop': 'static'
        };
        $('#modal-input-category').modal(options)
    })
    // on modal show
    $('#modal-input-category').on('show.bs.modal', function() {
        var el = $(".add-category-clicked"); // See how its usefull right here? 
        // get the data
        var id = el.data('item-id');
        $("#categoryForm").attr('action', '/admin/input-category/'+id);
        // fill the data in the input fields
    })
    // on modal hide
    $('#modal-input-category').on('hide.bs.modal', function() {
        $('.add-categoryclicked').removeClass('add-category-clicked')
        $("#categoryForm").trigger("reset");
    })

    
    //input image
    $(document).on('click', "#add-image", function() {
        $(this).addClass('add-image-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
        'backdrop': 'static'
        };
        $('#modal-input-image').modal(options)
    })
    // on modal show
    $('#modal-input-image').on('show.bs.modal', function() {
        var el = $(".add-image-clicked"); // See how its usefull right here? 
        // get the data
        var id = el.data('item-id');
        $("#imageForm").attr('action', '/admin/input-image/'+id);
        // fill the data in the input fields
    })
    // on modal hide
    $('#modal-input-image').on('hide.bs.modal', function() {
        $('.add-image-clicked').removeClass('add-image-clicked')
        $("#imageForm").trigger("reset");
    })


    //edit
    $(document).on('click', "#edit-item", function() {
        $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
        'backdrop': 'static'
        };
        $('#modal-default').modal(options)
    })

    // on modal show
    $('#modal-default').on('show.bs.modal', function() {
        
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var name = row.children(".product_name").text();
        var price = row.children(".price").text();
        var desc = row.children(".description").text();
        var stok = row.children(".stock").text();
        var weight = row.children(".weight").text();

        $("#edit-form").attr('action', '/admin/product/'+id);
        // fill the data in the input fields
        
        $("#modal-edit-name").val(name);
        $("#modal-edit-price").val(price);
        $("#modal-edit-desc").val(desc);
        $("#modal-edit-stok").val(stok);
        $("#modal-edit-weight").val(weight);
        

    })

    // on modal hide
    $('#modal-default').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })

    $("#image").change(function(){
        const fileName = $(this).val().split("\\");
        var inp = document.getElementById('image');
        var name = "";
        for (var i = 0; i < inp.files.length; ++i) {
            if (i == inp.files.length - 1) {
                name += inp.files.item(i).name;
            }
            else{
                name += inp.files.item(i).name+", ";
            }
        }

        if(fileName.length > 1){
            $("#image-label").html(name);
        } else {
            $("#image-label").html("Click to select the product image");
        }
    });

    $("#single-image").change(function(){
        const fileName = $(this).val().split("\\");
        var inp = document.getElementById('single-image');
        var name = "";
        for (var i = 0; i < inp.files.length; ++i) {
            if (i == inp.files.length - 1) {
                name += inp.files.item(i).name;
            }
            else{
                name += inp.files.item(i).name+", ";
            }
        }

        if(fileName.length > 1){
            $("#single-image-label").html(name);
        } else {
            $("#single-image-label").html("Click to select the product image");
        }
    });

    $(document).on('click', "#delete", function() {
        del = this;
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",            
            type: "warning",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            showCancelButton: true,
        }, function(value) {
            if (value) {
                $(del).closest("form").submit();
            }
        })
    });

    
})
</script>

@endsection