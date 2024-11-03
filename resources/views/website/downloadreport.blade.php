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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Download Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersReport as $usersReportlist ) 
                                <tr>
                                    <th scope="row"></th>
                                    <td>{{$usersReportlist['titel']}}</td>
                                    <td><a href="{{$usersReportlist['file']}}">Download</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
