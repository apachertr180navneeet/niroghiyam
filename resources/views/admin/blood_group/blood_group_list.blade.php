@extends('admin.layout.main_app')
@section('title', 'Blood Group List')
@section('content')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Blood Group List</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Blood Group List</li>
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
                                            <h3 class="card-title">Blood Group List</h3>
                                        </div>
                                        <div class="col-md-5">
                                        </div>
                                        <div class="col-md-1">
                                            <a href="{{ route('admin.blood_group.add') }}" class="btn btn-block btn-primary">Add Blood Group</a>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="customer_list" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.no.</th>
                                                    <th>name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($blood_group_list as $blood_group)
                                                <tr>
                                                    <td>{{ ++$i }}.</td>
                                                    <td>{{ $blood_group->name }}</td>
                                                    <td>
                                                        @if($blood_group->status =='0')
                                                            <a href="javascript:void(0)" data-id="{{ $blood_group->id }}" data-status="1" data-url="{{ route('admin.blood_group.status',$blood_group->id) }}" class="btn btn-danger status">InActive</a>
                                                        @else
                                                            <a href="javascript:void(0)" data-id="{{ $blood_group->id }}" data-status="0" data-url="{{ route('admin.blood_group.status',$blood_group->id) }}" class="btn btn-success status">Active</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" id="delete-user" data-id="{{ $blood_group->id }}" data-url="{{ route('admin.blood_group.delete',$blood_group->id) }}"  class="btn btn-danger delete">Delete</a>
                                                        <a href="{{ route('admin.blood_group.edit',$blood_group->id) }}" class="btn btn-warning">Edit</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>S.no.</th>
                                                    <th>name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <div class="d-flex justify-content-center">
                                            {!! $blood_group_list->links() !!}
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
