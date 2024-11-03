<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico" />

        <title>Nirogyam|Report</title>

        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>

    <body>
        <header>
            <div class="navbar navbar-dark box-shadow">
                <div class="container d-flex justify-content-between">
                    <a href="#" class="navbar-brand d-flex align-items-center">
                        <img src="https://niroghyam.com/public/uploads/1695053522.jpg" style="width: 8%;" />
                    </a>
                </div>
            </div>
        </header>
        
        <div class="container d-flex">
            <div class="row">
                <div class="col-md-12">
                    @if (session('message'))
            <div class="alert alert-success">
            {{ session('message') }}
            </div>
          @endif
                    <form role="form" action="{{ route('download.otpcheck') }}" method="post">
                    @csrf
                        <input type="hidden" name="userid" value="{{ $usercheck->id }}"/>
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Report Otp</label>
                            <input type="text" class="form-control" name="otp" placeholder="Enter Otp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
