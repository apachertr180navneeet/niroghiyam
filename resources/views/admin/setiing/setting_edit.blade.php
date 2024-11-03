@extends('admin.layout.main_app')
@section('title', 'Setting Edit')
@section('content')
            <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Setting Edit</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Setting Edit</li>
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
                        <form role="form" action="{{ route('admin.setting.edit') }}" method="post" id="coustomer_Edit" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="id" value="{{ $settingdata->id }}" >
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $settingdata->title }}" placeholder="Enter title" />
                                </div>
                                <div class="form-group">
                                    <label for="andriod_app_link">Andriod App Link</label>
                                    <input type="text" class="form-control" id="andriod_app_link" name="andriod_app_link" value="{{ $settingdata->andriod_app_link }}" placeholder="Enter link" />
                                </div>
                                <div class="form-group">
                                    <label for="ios_app_link">IOS App Link</label>
                                    <input type="text" class="form-control" id="ios_app_link" name="ios_app_link" value="{{ $settingdata->ios_app_link }}" placeholder="Enter link" />
                                </div>
                                <div class="form-group">
                                    <label for="vedio">Vedio File</label>
                                    <input type="file" class="form-control" id="vedio" name="vedio" value="{{ $settingdata->vedio }}" placeholder="Uplload vedio" />
                                </div>
                                <div class="form-group">
                                    <label for="app_logo">App Logo File</label>
                                    <input type="file" class="form-control" id="app_logo" name="app_logo" value="{{ $settingdata->app_link }}" placeholder="Uplload App Logo" />
                                </div>
                                <div class="form-group">
                                    <label for="andqr">Andriod QR CODE</label>
                                    <input type="file" class="form-control" id="andqr" name="andqr" value="" placeholder="Uplload App Logo" />
                                </div>
                                <div class="form-group">
                                    <label for="iosqrcode">IOS QR CODE</label>
                                    <input type="file" class="form-control" id="iosqrcode" name="iosqrcode" value="" placeholder="Uplload App Logo" />
                                </div>
                                <div class="form-group">
                                    <label for="iosqrcode">Vaccination Chart</label>
                                    <input type="file" class="form-control" id="vaccinationchart" name="vaccinationchart" value="" placeholder="Uplload vaccinationchart" />
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $settingdata->facebook }}" placeholder="Enter Facebook" />
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $settingdata->instagram }}" placeholder="Enter instagram" />
                                </div>

                                <div class="form-group">
                                    <label for="twitter">twitter</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $settingdata->twitter }}" placeholder="Enter twitter" />
                                </div>
                                <div class="form-group">
                                    <label for="linkedin">linkedin</label>
                                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $settingdata->linkedin }}" placeholder="Enter linkedin" />
                                </div>
                                <div class="form-group">
                                    <label for="razor_pay_key">Razor Pay Key</label>
                                    <input type="text" class="form-control" id="razor_pay_key" name="razor_pay_key" value="{{ $settingdata->razor_pay_key }}" placeholder="Enter Razor Pay Key" />
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
