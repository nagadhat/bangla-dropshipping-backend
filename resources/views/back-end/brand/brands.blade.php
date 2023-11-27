@extends('back-end.layouts.app')
@extends('back-end.layouts.header')
@extends('back-end.layouts.left-sidebar')
            
@section('page-content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
               <!--  <div class="col-12 py-3">
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
                            <h3 class="card-title">Brand List</h3>
                            <a href="{{ route('add_brand') }}" class="btn btn-primary">Add new</a>
                        </div>
                        <div class="card-body">
                            <table id="category_table" class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Serial No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brands as $brand)
                                        <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->description }}</td>
                                        <td>
                                            <a href="{{ route('edit_brand', ['id' => $brand->id]) }}" class="btn btn-primary">Edit</a>
                                            @if($brand->status == 1)
                                            <a href="{{ route('change_status', ['id' => $brand->id]) }}" class="btn btn-success">Active</a>
                                            @else
                                            <a href="{{ route('change_status', ['id' => $brand->id]) }}" class="btn btn-danger">Inactive</a>
                                            @endif
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>               
                </div> -->

                <div>
              <div class="brandsCartHeader">
                <div class="p-2 w-50 bd-highlight ">
                  <input class="form-control " type="text" placeholder="Search" aria-label="default input example">
                </div>
                <div class="ms-auto  p-2 bd-highlight">
                  <button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Create New</button>
                </div>
              </div>

            <div class="row row-cols-1 row-cols-lg-5 row-cols-md-3 row-cols-sm-3 g-4">
                <div class="col pb-3">
                  <div class="card h-100" >
                    <img src="{{ asset('/images/brands.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body ">
                      <h5 class="card-title">Card title</h5> 
                    </div>
                    <div class="card-footer text-muted">
                      <div class="d-flex justify-content-around align-items-center">
                        <div  class="brandsCustomDesign">
                          <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                          <button type="button" class="btn btn-primary">Active</button>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col pb-3">
                  <div class="card h-100" >
                    <img src="Images/brands.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                     
                
                    </div>
                    <div class="card-footer text-muted">
                      <div class="d-flex justify-content-around align-items-center">
                        <div  class="brandsCustomDesign">
                          <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                          <button type="button" class="btn btn-primary">Active</button>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col pb-3">
                  <div class="card h-100" >
                    <img src="Images/brands.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                    
                    </div>
                    <div class="card-footer text-muted">
                      <div class="d-flex justify-content-around align-items-center">
                        <div  class="brandsCustomDesign">
                          <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                          <button type="button" class="btn btn-primary">Active</button>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col pb-3">
                  <div class="card h-100" >
                    <img src="Images/brands.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      
                    </div>
                    <div class="card-footer text-muted">
                      <div class="d-flex justify-content-around align-items-center">
                        <div  class="brandsCustomDesign">
                          <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                          <button type="button" class="btn btn-primary">Active</button>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col pb-3">
                  <div class="card h-100"  >
                    <img src="Images/brands.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      
                    </div>
                    <div class="card-footer text-muted">
                      <div class="d-flex justify-content-around align-items-center">
                        <div  class="brandsCustomDesign">
                          <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                          <button type="button" class="btn btn-primary">Active</button>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col pb-3">
                  <div class="card h-100" >
                    <img src="Images/brands.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      
                    </div>
                    <div class="card-footer text-muted">
                      <div class="d-flex justify-content-around align-items-center">
                        <div  class="brandsCustomDesign">
                          <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                          <button type="button" class="btn btn-primary">Active</button>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col pb-3">
                  <div class="card h-100" >
                    <img src="Images/brands.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                     
                    </div>
                    <div class="card-footer text-muted">
                      <div class="d-flex justify-content-around align-items-center">
                        <div  class="brandsCustomDesign ">
                          <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                          <button type="button" class="btn btn-primary">Active</button>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col pb-3">
                  <div class="card h-100" >
                    <img src="Images/brands.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                     
                    </div>
                    <div class="card-footer text-muted">
                      <div class="d-flex justify-content-around align-items-center">
                        <div  class="brandsCustomDesign">
                          <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                          <button type="button" class="btn btn-primary">Active</button>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </div>







            </div>
        </div> <!-- content -->
    </div>
    <script>
        $(document).ready(function() {
            
            let table = new DataTable('#brand_table', {
                responsive: true
            });
        })
    </script>

@endsection

