<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Home</title>
</head>

<body>
    @auth
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">COVID-19</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        {{ Auth::user()->name }}
                        <img src="{{ Auth::user()->photo }}" class="rounded" style="width: 36px;" alt="Avatar's user">
                    </span>
                </div>
            </div>
        </nav>
    @else
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5" align="center">
                    <div class="badge bg-danger px-5 py-3">
                        <a href="{{ route('login') }}" style="text-decoration: none;color:white">You must to login to use service!</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</body>

</html>