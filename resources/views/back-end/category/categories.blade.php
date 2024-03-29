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
                            <h3 class="card-title">Category List</h3>
                            <a href="{{ route('add_category') }}" class="btn btn-primary">Add new</a>
                        </div>
                        <div class="card-body">
                            <table id="category_table" class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Serial No</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            @if( $category->image == null )
                                                <p>Image not found</p>
                                            @else
                                                <img src="{{ $category->image }}" height="50" width="50" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            @if(isset($category->parentCategory->name))
                                            {{ $category->parentCategory->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($category->priority == 'high')
                                                <span class="badge bg-success">High</span>   
                                            @elseif($category->priority == 'medium')
                                                <span class="badge bg-warning">Medium</span>
                                            @else
                                                <span class="badge bg-danger">Low</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit_category', ['id' => $category->id]) }}" class="btn btn-primary">Edit</a>
                                            @if($category->status == 1)
                                            <a href="{{ route('change_category_status', ['id' => $category->id]) }}" class="btn btn-success">Active</a>
                                            @else
                                            <a href="{{ route('change_category_status', ['id' => $category->id]) }}" class="btn btn-danger">Inactive</a>
                                            @endif
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>               
                </div>
            </div>
        </div> <!-- content -->
    </div>
    <script>
        $(document).ready(function() {
            
            let table = new DataTable('#category_table', {
                responsive: true
            });
        })
    </script>

@endsection

