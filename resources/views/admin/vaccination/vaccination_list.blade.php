@extends('admin.layout.main_app')
@section('title', 'Vaccination List')
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
                                <h1 class="m-0">Vaccination List</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Vaccination List</li>
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
                                            <h3 class="card-title">Vaccination List</h3>
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
                                                    <th>Member Name</th>
                                                    <th>Vaccination Name</th>
                                                    <th>Type</th>
                                                    <th>Vaccination Date</th>
                                                    <th>Vaccination Next Schedule</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vaccination_list as $vaccination)
                                                <tr>
                                                    <td>{{ ++$i }}.</td>
                                                    <td>{{$vaccination->usersname }}</td>
                                                    <td>{{$vaccination->vaccinationname }}</td>
                                                    <td>
                                                        @if($vaccination->type =='0')
                                                            <p>Optional</p>
                                                        @else
                                                            <p>Required</p>
                                                        @endif
                                                    </td>
                                                    <td>{{$vaccination->vaccination_date }}</td>
                                                    <td>{{$vaccination->vaccination_next_schedule }}</td>
                                                    <td>
                                                        @if($vaccination->vaccination_done =='0')
                                                            <p>Done</p>
                                                        @else
                                                            <p>Due</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-center">
                                            {!! $vaccination_list->links() !!}
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
