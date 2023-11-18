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
                                            <div class="col-4">
                                                <select class="form-select form-control" name="category_id" id="category" aria-label="Default select example">
                                                    <option selected>Select category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-select form-control" name="sub_category_id" id="subCategory" aria-label="Default select example">
                                                    <option selected>Select sub-category</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-select form-control" name="child_category_id" id="childCategory" aria-label="Default select example">
                                                    <option selected>Select child-category</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Photo</label>
                                    <div class="row align-items-center">
                                        <div class="">
                                            <input type="file" name="images[]" id="selectImage" class="form-control" multiple>
                                        </div>
                                    </div>
                                    <img id="preview" src="#" alt="your image" class="mt-3" style="display:none;height:100px;width:100px;"/>
                                </div>
                                <div class="form-group mb-3">
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
                                </div>
                                <div class="form-group mb-3">
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <div class="col-4">
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
                                            <div class="col-4">
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
                                            <div class="col-4">
                                                <label for="" class="form-label">Quantity</label>
                                                <input type="number" name="quantity" id="" class="form-control">
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

    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
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

        $(document).on('click','#sizeRemovebtn', function(e){
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


