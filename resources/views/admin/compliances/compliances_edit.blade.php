@extends('admin.layout.main_app')
@section('title', 'Compliances Reply')
@section('content')
<style>
    .compplineimg{
        width: 19%;
    }

    .adminmsgcard{
        background-color: #f5f6f7;
    }
    .reciverimgcss{
        width: 45px;
        height: 45px;
        border-radius: 50%;
    }

    .senderimgcss{
        width: 45px;
        height: 45px;
        border-radius: 50%;
    }
</style>
            <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Compliances Edit</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Compliances Edit</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Compliances Detail</h3>
                            <p>{{ $compliances->titel }}</p>
                            <p>{{ $compliances->description }}</p>
                            <img class="compplineimg" src="{{$compliances->file }}" alt="">
                        </div>
                        <!-- /.card-header -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <div class="col-md-12">
                    <section style="background-color: #eee;">
                        <div class="container py-5">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="card" id="chat2">
                                        <div class="card-header d-flex justify-content-between align-items-center p-3">
                                            <h5 class="mb-0">Compliances</h5>
                                        </div>
                                        <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative;">
                                            
                                        
                                            @foreach ($compliancesmessage as $compliancesmsg)
                                                    
                                                <div class="d-flex flex-row {{ $compliancesmsg['message_user_type'] == 0 ? 'justify-content-start' : 'justify-content-end mb-4 pt-1' }}">
                                                    @if($compliancesmsg['message_user_type'] == 0)
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp" class="senderimgcss" alt="avatar 1"/>
                                                    @endif
                                                    <div>
                                                        <p class="small p-2 ms-3 mb-1 rounded-3 {{ $compliancesmsg['message_user_type'] == 0 ? 'adminmsgcard' : 'bg-primary' }}">{{ $compliancesmsg['message'] }}</p>
                                                        <p class="small ms-3 mb-3 rounded-3 text-muted {{ $compliancesmsg['message_user_type'] == 0 ? 'd-flex justify-content-end' : '' }}">{{ $compliancesmsg['message_at'] }}</p>
                                                    </div>
                                                    @if($compliancesmsg['message_user_type'] == 1)
                                                        <img src="{{ $compliancesmsg['profile_image'] }}" class="reciverimgcss" alt="avatar 1"/>
                                                    @endif
                                                </div>

                                            @endforeach
                                        </div>
                                        <form role="form" action="{{ route('admin.complains.reply') }}" method="post">
                                            @csrf
                                            <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp" alt="avatar 3" style="width: 40px; height: 100%;" />
                                                <input type="hidden" name="user_id" value="{{ $user_data->id }}">
                                                <input type="hidden" name="compliances_id" value="{{ $compliances->id }}">
                                                <input type="text" class="form-control form-control-lg" name="message" id="exampleFormControlInput1" placeholder="Type message" />
                                                <button class="btn btn-success " type="submit" id="button-addon2">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
