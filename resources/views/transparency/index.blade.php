<!DOCTYPE html>
<html>

<head>
    <title>Welcome Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="jumbotron mt-5">
            <h1>Welcome to My Laravel App</h1>
            <p>This is a simple welcome page using Bootstrap and Blade templates.</p>
            <a class="btn btn-primary" href="{{ url('/home') }}">Get Started</a>
            @extends('layouts.app')

            @section('content')
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Sample Form</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('form.submit') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection

        </div>
    </div>
</body>

</html>