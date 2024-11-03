@extends('admin.layout.main_app')
@section('title', 'Banner Edit')
@section('content')


<style>
    .categoryimg {
        width: 7%;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Banner Edit</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Banner Edit</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Customer Detail</h3>
                        </div> -->
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('admin.banner.update') }}" method="post" id="coustomer_add" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->banner_id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->banner_titel }}" placeholder="Enter Name" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <img src="{{ $category->banner_image }}" class="categoryimg">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="caticon" class="form-label">Image</label>
                                    <input class="form-control" type="file" name="caticon" id="caticon">
                                </div>
                                <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
        </div>
    </section>
</div>

@endsection
