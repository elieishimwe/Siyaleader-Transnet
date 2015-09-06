

<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">
        <meta name="description" content="Siyaleader Ports Case Console Management">
        <meta name="keywords" content="Siyaleader, Ports, Trasnet,">
        <link rel="icon" type="image/x-icon" sizes="16x16" href="/img/favicon.ico?v1">

        <title>Siyaleader</title>

        <!-- CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/form.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('css/generics.css') }}" rel="stylesheet">
    </head>
    <body id="skin-blur-sunset">
    {{ status }}
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <section id="login">
            <header>
                <h1></h1>
                <p></p>
            </header>

            <div class="clearfix"></div>

            <!-- resources/views/auth/reset.blade.php -->

            <form method="POST" class="box animated tile" action="{{ url('/password/reset') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <h2 class="m-t-0 m-b-15">Password Resett</h2>

                    <input type="email" class = "login-control m-b-10" name="email" value="{{ old('email') }}" placeholder="Email Address">
                    <input type="password" name="password" class = "login-control m-b-10" placeholder="Password">
                    <input type="password" name="password_confirmation" class = "login-control m-b-10" placeholder="Password Confirmation">
                    <button type="submit" class="btn btn-sm m-r-5">
                        Reset Password
                    </button>
            </form>

        </section>

        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script> <!-- jQuery Library -->

        <!-- Bootstrap -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <!--  Form Related -->
        <script src="{{ asset('js/icheck.js') }}"></script> <!-- Custom Checkbox + Radio -->

        <!-- All JS functions -->
        <script src="{{ asset('js/functions.js') }}"></script>
    </body>
</html>
































