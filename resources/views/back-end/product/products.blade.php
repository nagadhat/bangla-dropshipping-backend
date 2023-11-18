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
                            <h3 class="card-title">Product List</h3>
                            <a href="{{ route('add_product') }}" class="btn btn-primary">Add new</a>
                        </div>
                        <div class="card-body">
                            <table id="product_table" class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Serial No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <img src="{{ $product->image }}" height="50" width="50" alt="">
                                           
                                        </td>
                                        
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Delete</button>
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
            
            let table = new DataTable('#product_table', {
                responsive: true
            });
        })
    </script>

@endsection

