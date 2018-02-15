<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
                <title>
                    PLN | Log in
                </title>
                <!-- Tell the browser to be responsive to screen width -->
                <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                    <!-- Bootstrap 3.3.7 -->
                    <link href="{{url('backoffice/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
                        <!-- Font Awesome -->
                        <link href="{{url('backoffice/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
                            <!-- Ionicons -->
                            <link href="{{url('backoffice/bower_components/Ionicons/css/ionicons.min.css')}}" rel="stylesheet">
                                <!-- Theme style -->
                                <link href="{{url('backoffice/dist/css/AdminLTE.min.css')}}" rel="stylesheet">
                                    <!-- iCheck -->
                                    <link href="{{url('backoffice/bower_components/iCheck/square/blue.css')}}" rel="stylesheet">
                                        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                                        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                                        <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
                                        <!-- Google Font -->
                                        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
                                        </link>
                                    </link>
                                </link>
                            </link>
                        </link>
                    </link>
                </meta>
            </meta>
        </meta>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{url('/')}}">
                    <b>
                        PLN
                    </b>
                    Login
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">
                    Sign in to start your session
                </p>
                {!! Form::open(['role' => 'form', 'route' => 'backoffice.login']) !!}
                {{ csrf_field() }}
                @include('backoffice._partials.notifications')
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input autofocus="" class="form-control" id="email" name="email" placeholder="email" required="" type="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('email') }}
                            </strong>
                        </span>
                        @endif
                        <span class="glyphicon glyphicon-envelope form-control-feedback">
                        </span>
                    </input>
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input class="form-control" name="password" placeholder="Password" type="password">
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('password') }}
                            </strong>
                        </span>
                        @endif
                        <span class="glyphicon glyphicon-lock form-control-feedback">
                        </span>
                    </input>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button class="btn btn-primary btn-block btn-flat" type="submit">
                            <span class="fa fa-sign-in">
                            </span>
                            Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
                {!! Form::close() !!}
                <!-- /.social-auth-links -->
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery 3 -->
        <script src="{{url('backoffice/bower_components/jquery/dist/jquery.min.js')}}">
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{url('backoffice/bower_components/bootstrap/dist/js/bootstrap.min.js')}}">
        </script>
        <!-- iCheck -->
        <script src="{{url('backoffice/bower_components/iCheck/icheck.min.js')}}">
        </script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
