<!DOCTYPE html>
<html>

<head>
    <title>Welcome Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sample Form</div>

                    <div class="card-body">
                        <!-- TODO: change methodo for POST -->
                        <form method="GET" action="{{ route('transparency.results') }}">
                            @csrf

                            <!-- <div class="form-group">
                                <label for="name">Endereço</label>
                                <input type="text" class="form-control" id="url" name="url" required>
                            </div> -->

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
</body>

</html>