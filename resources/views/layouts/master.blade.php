<!DOCTYPE html>
<html>
    <head>
        <title>
            @yield('title', 'Expenses')
        </title>

        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/expenses.css" rel="stylesheet">
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>



        @stack('head')

    </head>
    <body>

        <div id='content'>
            @if(Session::get('message') != null)
                <div class='message'>{{ Session::get('message') }}</div>
            @endif

            <header>
                <div id='logo'>
                    <a href='/'>
                        <img
                        src='img/expenses.png'
                        alt='Expenses Logo' width="420px" height="140px">
                    </a>
                </div>


                <nav class="navbar navbar-default">
                    <div class="container">
                        <ul class="nav navbar-nav">

                            <li><a href='#'>Transactions</a></li>
                            <li><a href='#'>Categories</a></li>
                            <li><a href='#'>Expense Report</a></li>

                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                        </ul>
                        
                    </div>
                </nav>

            </header>

            <section>
                @yield('content')
            </section>

            <footer class='container-fluid text-center'>
                &copy; {{ date('Y') }} &nbsp;&nbsp;Taras Dundyak
            </footer>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        @stack('body')

    </body>
</html>
