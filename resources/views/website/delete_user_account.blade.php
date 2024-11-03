<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico" />

        <title>Nirogyam|Delete User Account</title>

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

        <main role="main">
            <section class="jumbotron">
                <div class="container">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('delete_user') }}" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </section>
        </main>
    </body>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
