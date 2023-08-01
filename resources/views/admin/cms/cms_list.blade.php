@extends('admin.layout.main_app')
@section('title', 'CMS List')
@section('content')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">CMS List</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">CMS List</li>
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="card-title">CMS List</h3>
                                        </div>
                                        <div class="col-md-5">
                                        </div>
                                        <div class="col-md-1">
                                            <a href="{{ route('admin.cms.add') }}" class="btn btn-block btn-primary">Add</a>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="customer_list" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.no.</th>
                                                    <th>Name</th>
                                                    <th>Slug</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cms_list as $cms)
                                                <tr>
                                                    <td>{{ ++$i }}.</td>
                                                    <td>{{ $cms->page_name }}</td>
                                                    <td>{{ $cms->page_slug }}</td>
                                                    <td>
                                                        @if($cms->status =='0')
                                                            <a href="javascript:void(0)" data-id="{{ $cms->id }}" data-status="1" data-url="{{ route('admin.cms.status',$cms->id) }}" class="btn btn-danger status">InActive</a>
                                                        @else
                                                            <a href="javascript:void(0)" data-id="{{ $cms->id }}" data-status="0" data-url="{{ route('admin.cms.status',$cms->id) }}" class="btn btn-success status">Active</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" id="delete-user" data-id="{{ $cms->id }}" data-url="{{ route('admin.cms.delete',$cms->id) }}"  class="btn btn-danger delete">Delete</a>
                                                        <a href="{{ route('admin.cms.edit',$cms->id) }}" class="btn btn-warning">Edit</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>S.no.</th>
                                                    <th>Name</th>
                                                    <th>Slug</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <div class="d-flex justify-content-center">
                                            {!! $cms_list->links() !!}
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
@endsection
