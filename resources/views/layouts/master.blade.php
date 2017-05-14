<!DOCTYPE html>
<html>
    <head>
        <title>
            @yield('title', 'Expenses')
        </title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="/css/expenses.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        @stack('head')

    </head>
    <body>

        @if(Session::get("message") != null)
            <div class="alert alert-success alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get("message") }}
            </div>
        @endif
        @if(Session::get("failure") != null)
            <div class="alert alert-danger alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get("failure") }}
            </div>
        @endif

        <header>
            <div id="logo">
                <a href="/">
                    <img
                    src="/img/expenses_X_cool.png"
                    alt="Expenses Logo" width="420" height="140">
                </a>
            </div>

            <nav class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">
                            <img alt="Brand" src="/img/expenses.png" width="138" height="40">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        @if (Auth::check())
                            <ul class="nav navbar-nav">
                                <li><a href="/">Transactions</a></li>
                                <li><a href="/categories">Categories</a></li>
                                <li><a href="/report">Expense Report</a></li>
                            </ul>
                            <form method='POST' id='logout' action='/logout'>
                                {{ csrf_field() }}
                            </form>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="#" id="logoutLink"><span class="glyphicon glyphicon-log-out"></span> Log Out</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </nav>
        </header>

        <section>
            @yield('content')
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="/js/expenses.js"></script>

        @stack('body')

    </body>
</html>
