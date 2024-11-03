@extends('admin.layout.main_app')
@section('title', 'Customer Document And Report')
@section('content')

<style>
    .kycimage{
        width: 58%;
        margin: 2%;
    }
    .cardheight{
        height: 321px;
    }
    .kycnumber{
        text-align: center;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Document({{$user_detail['name'] ? $user_detail['name'] : ''}})</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer Document</li>
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
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">KYC Document</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Reports</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="kycnumber">KYC Number :- {{$user_detail['kyc_detail']}}</h3>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card cardheight">
                                                <img class="card-img-top kycimage" src="{{$user_detail['kyc_front_image']}}" alt="Front Image">
                                                <div class="card-body">
                                                    <h5 class="card-title">Front Image</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card cardheight">
                                                <img class="card-img-top kycimage" src="{{$user_detail['kyc_back_image']}}" alt="Back Image">
                                                <div class="card-body">
                                                    <h5 class="card-title">Back Image</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <table id="customer_list" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Category Name</th>
                                                    <th>Title</th>
                                                    <th>Date</th>
                                                    <th>Report</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user_report as $report)
                                                <tr>
                                                    <td>{{ $report['cat_name'] }}</td>
                                                    <td>{{ $report['titel'] }}</td>
                                                    <td>{{ $report['date'] }}</td>
                                                    <td><img class="kycimage" src="{{$report['file']}}" alt="Back Image"></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!--/.col (left) -->
            </div>
        </div>
    </section>
</div>

@endsection
