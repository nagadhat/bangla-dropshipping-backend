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
                            <h3 class="card-title">Edit Brand</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('edit_brand',['id' => $brand->id ]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Brand Name</label>
                                    <input type="text" name="name" id="" class="form-control" value="{{ $brand->name }}">
                                </div>
                               
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ $brand->description }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" name="icon" id="selectImage" class="form-control">
                                    <img id="preview" src="{{ $brand->image }}" alt="your image" class="mt-3" style="height:100px;width:100px;"/>
                                
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
@endsection

