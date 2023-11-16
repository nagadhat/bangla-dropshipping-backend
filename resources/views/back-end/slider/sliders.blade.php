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
                            <h3 class="card-title">Slider List</h3>
                            <a href="{{ route('add_slider') }}" class="btn btn-primary">Add new</a>
                        </div>
                        <div class="card-body">
                            <table id="sub_category_table" class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Serial No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $slide)
                                        <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $slide->title }}</td>
                                        <td>
                                            <img src="{{ $slide->image }}" height="50px" width="50px" alt="">
                                        </td>
                                        <td>
                                            @if( $slide->status == 1 )
                                                <span class="btn btn-success">Active</span>
                                            @else  
                                                <span class="btn btn-danger">Inactive</span> 
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="">Edit</a>
                                            <a class="btn btn-danger" href="">Delete</a>
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
            
            let table = new DataTable('#sub_category_table', {
                responsive: true
            });
        })
    </script>

@endsection

