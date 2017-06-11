<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

$usuario = App\User::find(1);
$sliders = App\Slide::orderBy('order', 'asc')->get();
    return view('inicio', ['sliders'=>$sliders]) ;
});
Route::get('/nosotros', function () {
    return view('nosotros');
});
Route::get('/proximamente', function () {
    return view('proximamente');
});

Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/clasesdeportivas', function () {
    return view('clasesdeportivas');
});

Route::get('/aviso', function () {
    return view('aviso');
});




// Authentication routes...
Route::get('entrar', 'Auth\AuthController@getLogin');
Route::post('entrar', 'Auth\AuthController@postLogin');
Route::get('salir', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('registro', 'Auth\AuthController@getRegister');
Route::post('registro', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}/{email}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');




//DetallesController
Route::get('/perfil', function () {
  if (Auth::guest()){
    return redirect()->intended(url('/entrar'));
  }
  if (Auth::user()->role=="usuario"||Auth::user()->role=="superadmin") {
    $user = App\User::find(Auth::user()->id);
    return view('perfil', ['user'=>$user]) ;
  }
  if (Auth::user()->role=="instructor") {
    $user = App\User::find(Auth::user()->id);
    return view('instructor', ['user'=>$user]) ;
  }
});

Route::get('/direcciones', function () {
  if (Auth::guest()){
    return redirect()->intended(url('/entrar'));
  }
  else {
    $user = App\User::find(Auth::user()->id);
    return view('direcciones', ['user'=>$user,'mensaje'=>null]) ;
  }
});

Route::get('/tarjetas', function () {
  if (Auth::guest()){
    return redirect()->intended(url('/entrar'));
  }
  else {
    $user = App\User::find(Auth::user()->id);
    return view('tarjetas', ['user'=>$user,'mensaje'=>null]) ;
  }
});

Route::any('actualizar-perfil', 'DetallesController@updateProfile');
Route::any('actualizar-contraseña', 'DetallesController@updatePassword');

Route::get('completar-registro', 'DetallesController@create');
Route::post('completar-registro', 'DetallesController@store');


Route::post('cambiar-foto', 'DetallesController@updatePhoto');
Route::post('agregar-direccion', 'DetallesController@addAddress');
Route::any('actualizar-direccion/{id}', 'DetallesController@updateAddress');
Route::any('eliminar-direccion/{id}', 'DetallesController@destroyAddress');


Route::post('agregar-tarjeta', 'DetallesController@addCard');
Route::any('actualizar-tarjeta/{id}', 'DetallesController@updateCard');
Route::any('eliminar-tarjeta/{id}', 'DetallesController@destroyCard');





//InstructorController
Route::post('cambiar-foto-instructor', 'InstructorController@updatePhoto');
Route::post('llenar-perfil-instructor', 'InstructorController@addDetalles');
Route::post('actualizar-perfil-instructor', 'InstructorController@updateProfile');

Route::get('/vehiculos', function () {

  if (Auth::user()->role=="instructor"){
    $user = App\User::find(Auth::user()->id);
    return view('vehiculos', ['user'=>$user]) ;
  }
  else {
    return redirect()->intended(url('/entrar'));
  }
});

Route::post('agregar-vehiculo', 'InstructorController@addVehiculo');
Route::any('actualizar-vehiculo/{id}', 'InstructorController@updateVehiculo');
Route::any('eliminar-vehiculo/{id}', 'InstructorController@destroyVehiculo');

Route::get('/horarios', function () {
  if (Auth::guest()){
    return redirect()->intended(url('/entrar'));
  }
  else {
    $user = App\User::find(Auth::user()->id);
    $clases = App\Clases::all();
    return view('horarios', ['user'=>$user,'clases'=>$clases]) ;
  }
});
Route::post('agregar-horario', 'InstructorController@addHorario');
Route::any('actualizar-horario/{id}', 'InstructorController@updateHorario');
Route::any('eliminar-horario/{id}', 'InstructorController@destroyHorario');


//Admin controller
Route::get('/clases', function () {
  if (Auth::guest()){
    return redirect()->intended(url('/entrar'));
  }
  else {
    $clases = App\Clases::all();
    return view('clases', ['clases'=>$clases]) ;
  }
});
Route::post('agregar-clase', 'AdminController@addClase');
Route::any('actualizar-clase/{id}', 'AdminController@updateClase');
Route::any('eliminar-clase/{id}', 'AdminController@destroyClase');


//Admin controller
Route::get('/usuarios', function () {
  if (Auth::guest()){
    return redirect()->intended(url('/entrar'));
  }
  else {
    $usuarios = App\User::paginate(10);
    return view('usuarios', ['usuarios'=>$usuarios]) ;
  }
});

Route::post('agregar-usuario', 'AdminController@addUser');
Route::any('actualizar-usuario/{id}', 'AdminController@updateUser');
Route::any('eliminar-usuario/{id}', 'AdminController@destroyUser');

Route::any('buscar-usuario', 'AdminController@buscar');



Route::get('/slides', function () {
  if (Auth::guest()){
    return redirect()->intended(url('/entrar'));
  }
  else {
    $slides = App\Slide::orderBy('order', 'asc')->get();
    return view('slides', ['slides'=>$slides]) ;
  }
});

Route::post('agregar-slide', 'AdminController@addSlide');
Route::any('actualizar-slide/{id}', 'AdminController@updateSlide');
Route::any('eliminar-slide/{id}', 'AdminController@destroySlide');
