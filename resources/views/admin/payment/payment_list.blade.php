@extends('admin.layout.main_app')
@section('title', 'Payment List')
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
                                <h1 class="m-0">Payment List</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Payment List</li>
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
                                            <h3 class="card-title">Payment List</h3>
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
                                                    <th>Receipt.no.</th>
                                                    <th>Member Name</th>
                                                    <th>Amount</th>
                                                    <th>Membership</th>
                                                    <th>Payment Mode</th>
                                                    <th>Payment Status</th>
                                                    <th>Invoice Date</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach ($payment_list as $payment)
                                                        <tr>
                                                            <td>NIRO{{$payment->user_package_id }}.</td>
                                                            <td>{{$payment->name }}</td>
                                                            <td>{{$payment->amount }}</td>
                                                            <td>{{$payment->memberships_name }}</td>
                                                            <td>
                                                                @if($payment->pay_mode =='0')
                                                                    <p>Offline</p>
                                                                @else
                                                                    <p>Online</p>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($payment->pay_status =='0')
                                                                    <p>Fail</p>
                                                                @elseif($payment->pay_status =='1')
                                                                    <p>Pending</p>
                                                                @else
                                                                    <p>Success</p>
                                                                @endif
                                                            </td>
                                                            <td>{{$payment->created_at }}</td>
                                                            <td>{{$payment->start_date }}</td>
                                                            <td>{{$payment->end_date }}</td>
                                                            <td><a href="#" class="btn btn-primary">View</a></td>
                                                        </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-center">
                                            {!! $payment_list->links() !!}
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
