@extends('plantilla')

@section('pagecontent')

  <section class="container-bootstrap">
    <div class="row">
      <div class="topclear">
        &nbsp;
      </div>
      <div class="checkoutPage clear">
        <div class="clear"></div>
        @include('content_holders.notificaciones')
        <div class="col-sm-6">
  				<h3>Iniciar Sesión</h3>
          <form class="row" action="{{ url('/entrar') }}" method="post">
            <p class="col-sm-6">
    					<label>Usuario</label><br>
    					<input class="form-control" type="email" value="{{ old('email') }}" placeholder="tu@email.com" name="email">
    				</p>
    				<p class="col-sm-6">
    					<label>Contraseña</label><br>
    					<input class="form-control" type="password" value="" placeholder="" name="password">
              {!! csrf_field() !!}
    				</p>


              <div class="checkbox col-sm-12">
                  <label><input name="remember" type="checkbox"> Recordarme</label>
              </div>

            <div class="col-sm-12">
              <input class="btn btn-primary" type="submit" value="Enviar">
              <a href="{{ url('password/email') }}" style="float: right;">¿Olvidaste tu contraseña?</a>
            </div>

          </form>
  				<div class="clear"></div>
  			   </div>
          <div class="clear"></div>
		     </div>
       </div>
     </section>
        @endsection
