<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/mi_primera_ruta', function() {
    return 'Hello World.';
});*/

Route::resource('centros', 'CentroController');

Route::get('/centros/eliminar/{id}', 'CentroController@eliminarCentro')->name('eliminarCentro');

Route::post('/eliminar/centro/{id}', 'CentroController@eliminarCentroBD')->name('eliminarCentroBD');

Route::resource('usuarios', 'UserController');

Route::resource('aulas', 'AulaController');

Route::get('/aulas/eliminar/{id}', 'AulaController@eliminarAula')->name('eliminarAula');

Route::post('/eliminar/aulas/{id}', 'AulaController@eliminarAulaBD')->name('eliminarAulaBD');

Route::resource('ninos', 'NinoController');

Route::resource('menus', 'MenuController');

Route::resource('actividades', 'ActividadController');

Route::resource('tutores', 'TutorController');

Route::resource('mensajes', 'MensajeController');

/*Mostrar Registro de actividades dado el ID del niño*/
Route::get('/actividad/nino/{id}', 'ActividadController@actividadNino')->name('actividadNino');

/*Mostrar detalle de actividad dado el ID de la actividad*/
Route::get('/actividad/detalle/{registro_id}', 'ActividadController@actividadDetalleNino')->name('actividadDetalleNino');

Route::resource('aula_menu', 'AulaMenuController');

Route::resource('mensajes', 'MensajeController');

/*Ruta para ver el Calendario de Actividades asociados a un niño*/
Route::get('/calendario/nino/{id}', 'TutorController@calendarioNino')->name('calendarioNino');

/*Ruta a Mensaje de difusión del centro -> destinatarios: profesores y tutores del centro*/
Route::get('/mensajes/centro/{slug}', 'MensajeController@mensajeDifusionCentro')->name('mensajeDifusionCentro');
//Route::get('/mensajes/mensaje-difusion', 'MensajeController@storeMensajeDifusionAdmin')->name('storeMensajeDifusionAdmin');

/* Ruta a Mensaje de difusión del aula -> destinatarios: tutores del aula*/
Route::get('/mensajes/aulas/{slug}', 'MensajeController@mensajeProfesorAulas')->name('mensajeProfesorAulas');

/* Ruta a Mensaje privado de Profesor a Tutor*/
Route::get('/mensajes/profesor/tutor/{id}', 'MensajeController@mensajeProfesorTutor')->name('mensajeProfesorTutor');

/* Ruta a Mensaje privado de Tutor a Profesor */
Route::get('/mensajes/tutor/profesor/{id}', 'MensajeController@mensajeTutorProfesor')->name('mensajeTutorProfesor');

/* Ruta al listado de profesores del aula del hijo del tutor para mensajería */
Route::get('/mensajes/tutor/profesores/nino/{id}', 'MensajeController@mensajeTutorProfesores')->name('mensajeTutorProfesores');

/* Ruta a Mensaje privado de Tutor a Director */
Route::get('/mensajes/tutor/director/{id}', 'MensajeController@mensajeTutorDirector')->name('mensajeTutorDirector');

/* Ruta a Mensaje privado de Director a Tutor */
Route::get('/mensajes/director/tutor/{id}', 'MensajeController@mensajeDirectorTutor')->name('mensajeDirectorTutor');

/* Todos los mensajes del usuario Logueado */
Route::get('/mensajes/usuario/{id}', 'MensajeController@todosMensajesPorUsuario')->name('todosMensajesPorUsuario');

/* Ruta a Mensaje Difusion del Director a un profesor específico */
Route::get('/mensajes/director/profesor/{id_director}', 'MensajeController@mensajeDirectorProfesor')->name('mensajeDirectorProfesor');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
