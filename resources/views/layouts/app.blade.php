<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <title>My first BootstrapVue app</title>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
</head>

<body>
    <!-- Our application root element -->
    <div id="app">
        <!-- header start -->
        <header id="appHeader">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="/">ADFX Send SMS</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/my-campaigns">My Campaigns</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            @if(session()->has('success'))
                <div class="container mt-5">
                    <div class="alert alert-success">{{session()->get('success')}}</div>
                </div>
            @elseif(session()->has('error'))
                <div class="container mt-5">
                    <div class="alert alert-danger">{{session()->get('error')}}</div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>


    <script src="{{mix('/js/app.js')}}"></script>
</body>

</html>
