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
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('edit_category',['id' => $category->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Category Name</label>
                                    <input type="text" name="name" id="" class="form-control" value="{{ $category->name }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Parent Category</label>
                                    <select class="form-select form-control" name="parent_category" id="subCategory" aria-label="Default select example">
                                        <option value="" selected>Select parent-category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                @foreach($category->children as $child)
                                                <div class="py-5">
                                                    <option class="py-5" value="{{ $child->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }} 
                                                </div>
                                                        @foreach($child->children as $child2)
                                                            <option value="{{ $child2->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child2->name }} </option>
                                                        @endforeach
                                                    </option>
                                                @endforeach
                                        
                                            </option>
                                        @endforeach
                                        
                                    </select>    
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="summernote" cols="30" rows="10">{{ $category->description }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Photo</label>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <input type="file" name="icon" id="selectImage" class="form-control" value="{{ $category->image }}">
                                        </div>
                                    </div>
                                    <img id="preview" src="{{ $category->image }}" alt="your image" class="mt-3" style="height:100px;width:100px;"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Priority</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="high" name="priority" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            High
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="medium" name="priority" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Medium
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="low" name="priority" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Low
                                        </label>
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
         $(document).ready(function() {
            $('#summernote').summernote({
                height: 300
            });                
         });
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection

