@extends('admin.layout.main_app')
@section('title', 'Compliances List')
@section('content')

<style>
    .compplineimg{
        width:100%;
    }
    .thcompimg{
        width: 10%;
    }
</style>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Compliances List</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Compliances List</li>
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
                                            <h3 class="card-title">Compliances List</h3>
                                        </div>
                                        <div class="col-md-5">
                                        </div>
                                        <div class="col-md-1">
                                            
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="customer_list" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.no.</th>
                                                    <th>Title</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th class="thcompimg">Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($compliances_list as $compliances)
                                                <tr>
                                                    <td>{{ ++$i }}.</td>
                                                    <td>{{$compliances->titel }}</td>
                                                    <td>{{$compliances->name }}</td>
                                                    <td>{{$compliances->description }}</td>
                                                    <td><img class="compplineimg" src="{{$compliances->file }}" alt=""></td>
                                                    <td>
                                                        @if($compliances->replyed =='0')
                                                            <a href="{{ route('admin.complains.edit',$compliances->id) }}" class="btn btn-danger">Reply</a>
                                                        @else
                                                            <a href="{{ route('admin.complains.edit',$compliances->id) }}" class="btn btn-success">Reply</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-center">
                                            {!! $compliances_list->links() !!}
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
