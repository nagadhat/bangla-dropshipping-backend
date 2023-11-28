@extends('back-end.layouts.app')
@extends('back-end.layouts.header')
@extends('back-end.layouts.left-sidebar')
            
@section('page-content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="col-12 py-3">
                    @if (session()->has('message'))
                        <div class="alert bg-info">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert bg-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-12 pt-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Product</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('add_product') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Product Name</label>
                                    <input type="text" name="name" id="" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <div class="col-6">
                                                <select class="form-select form-control" name="category_id" id="category" aria-label="Default select example">
                                                    <option selected>Select category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <select class="form-select form-control" name="sub_category_id" id="subCategory" aria-label="Default select example">
                                                    <option selected>Select brand</option>                  
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="summernote" cols="30" rows="10"></textarea>
                                </div>
                                <div id="singleImageProduct" class="form-group mb-3">
                                    <label for="" class="form-label">Photo</label>
                                    <!-- <div class="row align-items-center"> -->
                                        
                                            <input type="file" name="images[]"  onchange="preview(this)" id="selectImage" class="form-control" multiple>
                                            <div class="me-2"></div>
                                        
                                    <!-- </div> -->
                                    <!-- <img id="preview" src="#" alt="your image" class="mt-3" style="display:none;height:100px;width:100px;"/> -->
                                </div>

                                <!-- <div class="form-group mb-3 productPrice">
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <div class="col-6"> 
                                                <label for="" class="form-label">Price</label>
                                                <input type="number" name="price" id="" class="form-control" step="any">                                             
                                            </div>
                                            <div class="col-6">   
                                                <label for="" class="form-label">Discount Price</label>
                                                <input type="number" name="discountPrice" id="" class="form-control">                                            
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="productVariants py-3 addVariants">
                                    <h1 class="text-center pb-4">Variations</h1>
                                    <div class="form-group mb-3 py-1 variantsForms">
                                        <div class="col-11">
                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <label for="" class="form-label">Image</label>
                                                    <input type="file" name="image[]" id="sizeField" class="form-control" multiple>
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Size</label>
                                                    <select class="form-select form-control"  name="size[]" id="subCategory" aria-label="Default select example">
                                                        <option selected>Select Size</option>                  
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Colour</label>
                                                    <select class="form-select form-control"  name="colour[]" id="subCategory" aria-label="Default select example">
                                                        <option selected>Select Colour</option>                  
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-11 py-1">
                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <label for="" class="form-label">Price</label>
                                                    <input type="number" name="price" id="" class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Discount Price</label>
                                                    <input type="number" name="discountPrice" id="" class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Quantity</label>
                                                    <input type="number" name="quantity" id="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="addVariant" class="col-1">
                                            <label for="" class="form-label"></label>
                                            <a href="" id="variantBtn" class="btn btn-success mt-3">+</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group mb-3 productVariants">
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <div class="col-6">
                                                <label for="" class="form-label">Size</label>
                                                <div class="col-12 addSize">
                                                    <div class="row justify-content-center">
                                                        <div class="col-10">
                                                            <input type="text" name="size[]" id="sizeField" class="form-control">
                                                        </div>
                                                        <div class="col-2 me-2">
                                                            <button class="btn btn-success" id="addSizeInput">+</button>
                                                        </div>
                                                    </div>       
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label">Colour</label>
                                                <div class="col-12 addColour">
                                                    <div class="row justify-content-center">
                                                        <div class="col-10">
                                                            <input type="text" name="colour[]" id="" class="form-control">
                                                        </div>
                                                        <div class="col-2 me-2">
                                                            <button class="btn btn-success" id="addColourInput">+</button>
                                                        </div>
                                                    </div>       
                                                </div>                
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group mb-3">
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <div class="col-3">
                                                <label for="" class="form-label">Type</label>
                                                <select class="form-select form-control" name="product_type" id="product_type" aria-label="Default select example">
                                                    <!-- <option selected>Select type</option> -->
                                                    <option value="1">Single</option>
                                                    <option value="2">Variant</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="" class="form-label">Model</label>
                                                <input type="text" name="model" id="" class="form-control">   
                                            </div>
                                            <div class="col-3">
                                                <label for="" class="form-label">SKU</label>
                                                <input type="number" name="product_code" id="" class="form-control" value="{{ $product_code }}">
                                            </div>
                                            <div id="singleProductPrice" class="col-3"> 
                                                <label for=""  class="form-label">Price</label>
                                                <input type="number" name="price" id="" class="form-control" step="any">                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <!-- script to preview multiple image before upload -->
    <script>
       
       $("document").ready( function(){
        $('#summernote').summernote({
                height: 300
            }); 
        $(".productVariants").hide();
        $(".productPrice").hide();
       
       });

       $("#product_type").on('change', function(){
        const singleProductPrice=document.querySelector("#singleProductPrice");
        const singleImageProduct=document.querySelector("#singleImageProduct");
        console.log(singleProductPrice)
        var variantId = this.value;
        if( variantId == 1){
            $(".productPrice").show();
            $(".productVariants").hide();
            singleProductPrice.style.display="block"
            singleImageProduct.style.display="block"
        }else{
            $(".productPrice").show();
            $(".productVariants").show();
            singleProductPrice.style.display="none"
            singleImageProduct.style.display="none"

        }

        alert(categoryId);
        // $("p").toggle();
       });

    function preview(elem, output = '') {
        Array.from(elem.files).map((file) => {
            const blobUrl = window.URL.createObjectURL(file)
            output+=`<img class="my-2 me-2" height="100px" width="100px" class="me-1" src=${blobUrl}>`
        })   
        elem.nextElementSibling.innerHTML = output
    }

    </script>

    <script>
        $('#category').on('change',function(){
            var categoryId = this.value;
            $('#subCategory').html('');
            $.ajax({
                url:"{{ url('/get-sub-category') }}",
                type:'post',
                data: {
                        category_id: categoryId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                success:function( res ){
                    console.log(res);
                    $('#subCategory').html('<option value="">Select sub-category</option>');
                        $.each(res, function (key, value) {
                            // console.log(value.id);
                            $("#subCategory").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                },
            });
        });
    </script>

<script>
        $('#subCategory').on('change',function(){
            var subCategoryId = this.value;
            // alert(categoryId);
            $('#childCategory').html('');
            $.ajax({
                url:"{{ url('/get-child-category') }}",
                type:'post',
                data: {
                        sub_category_id: subCategoryId,
                        _token: '{{csrf_token()}}'
                    },
                dataType: 'json',
                success:function( res ){
                    // console.log(res);
                    $('#childCategory').html('<option value="">Select child-category</option>');
                        $.each(res, function (key, value) {
                            
                            $("#childCategory").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                },
            });
        });

        $("#addSizeInput").click(function(e){
            e.preventDefault();
            $(".addSize").append(` <div class="row justify-content-center py-2">
                                        <div class="col-10">
                                            <input type="text" name="size[]" id="sizeField" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-danger" id="sizeRemovebtn">-</button>
                                        </div>
                                    </div> `);
        });
        $("#variantBtn").click(function(e){
            e.preventDefault();
            $(".addVariants").append(` <div class="form-group mb-3 py-1">
                                        <div class="col-12">
                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <label for="" class="form-label">Image</label>
                                                    <input type="file" name="image[]" id="sizeField" class="form-control" multiple>
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Size</label>
                                                    <select class="form-select form-control"  name="size[]" id="subCategory" aria-label="Default select example">
                                                        <option selected>Select Size</option>                  
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Colour</label>
                                                    <select class="form-select form-control"  name="colour[]" id="subCategory" aria-label="Default select example">
                                                        <option selected>Select Colour</option>                  
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 py-1">
                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <label for="" class="form-label">Price</label>
                                                    <input type="number" name="price" id="" class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Discount Price</label>
                                                    <input type="number" name="discountPrice" id="" class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Quantity</label>
                                                    <input type="number" name="quantity" id="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                                    <label for="" class="form-label"></label>
                                                    <a href="" id="variantRemovebtn" class="btn btn-danger mt-3">-</a>
                                                </div>
                                    </div> 
                                    `);
        });

        $(document).on('click','#variantRemovebtn', function(e){
            e.preventDefault();
            $(this).parent().parent().remove();

            // $(rowItem).remove();

        });

        $("#addColourInput").click(function(e){
            e.preventDefault();
            $(".addColour").append(` <div class="row justify-content-center py-2">
                                        <div class="col-10">
                                            <input type="text" name="colour[]" id="" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-danger" id="colourRemovebtn">-</button>
                                        </div>
                                    </div> `);
        });

        $(document).on('click','#colourRemovebtn', function(e){
            e.preventDefault();
            $(this).parent().parent().remove();
            // $(rowItem).remove();

        });
    </script>
@endsection


