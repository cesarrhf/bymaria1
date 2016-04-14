


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Admin</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
  	<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ URL::asset('assets/css/sigin.css') }}" /> -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>


        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
  <img  class="img-responsive center-block logo" style='height: 150;'src="imagenes/logo_bymaria/logo.png" alt=""/>

  <div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Inicio Sesion</div>
              <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                      {!! csrf_field() !!}

                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Nombre de Usuario</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Contraseña</label>

                          <div class="col-md-6">
                              <input type="password" class="form-control" name="password">

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" name="remember"> Recordar
                                  </label>
                              </div>
                              <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>

                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-btn fa-sign-in"></i>Login
                              </button>

                              <a class="btn btn-link" href="{{ url('/register') }}">Registro</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>


    <!-- JavaScripts -->
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.9.1.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
 </body>
</html>
