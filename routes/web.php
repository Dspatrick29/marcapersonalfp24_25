<?php

use App\Http\Controllers\HomeController;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'getHome']);

Route::get('login', function () {
    return view('auth.login');
});

Route::get('logout', function () {
    return 'Logout usuario';
});

Route::get('perfil/{id?}', function ($id = null) {
    return $id ? 'Visualizar el currículo de ' . $id : 'Visualizar el currículo propio';
})->where('id', '[0-9]*');

Route::get('pruebaDB/{votos?}', function ($votos = null) {
    $html = getEstadisticas();
    //Para hacer un AND hay que encadenar los where
    Estudiante::where('nombre', 'Juan')
    ->where('apellidos', 'Martínez')
    ->delete();
    $html .= getEstadisticas();

    return $html;

  /*  $estudiantes = Estudiante::where('votos', '>', $votos)->take(5)->get();

    foreach ($estudiantes as $est) {
        $html .= '<li>' . $est->nombre . '</li>';
    };





    $count = Estudiante::where('votos', '>', 100)->count();
    $html .= 'Antes: ' . $count . '<br />';

    // $estudiante = new Estudiante;
    $id = $votos ? $votos : 1;
    $estudiante = Estudiante::findOrFail($id);
    $estudiante->nombre = 'Juan';
    $estudiante->apellidos = 'Martínez';
    $estudiante->direccion = 'Dirección de Juan';
    $estudiante->votos = 130;
    $estudiante->confirmado = true;
    $estudiante->ciclo = 'DAW';
    $estudiante->save();

    $count = Estudiante::where('votos', '>', 100)->count();
    $html .=  'Después: ' . $count . '<br />';

    return $html . '</ul>';

    foreach ($estudiante as $est) {
        echo $est->nombre;
    } */
});

    //Se crea una función que devuelve un string con las estadísticas de los estudiantes
function getEstadisticas(){

    $count = Estudiante::where('votos', '>', 100)->count();
    $votosM = Estudiante::max('votos');
    $votosm = Estudiante::min('votos');
    $votosAvg = Estudiante::avg('votos');
    $total = Estudiante::sum('votos');

    $html  = '<ul>';
    $html .= '<li>Estudiantes con más de 100 votos: ' . $count . '</li>';
    $html .= '<li>Estudiante con más votos: ' . $votosM . '</li>';
    $html .= '<li>Estudiante con menos votos: ' . $votosm . '</li>';
    $html .= '<li>Media de votos: ' . $votosAvg . '</li>';
    $html .= '<li>Total de votos: ' . $total . '</li>';
    $html .= "</ul>";
    return $html;
    };

include __DIR__ . '/actividades.php';
include __DIR__ . '/curriculos.php';
include __DIR__ . '/proyectos.php';
include __DIR__ . '/reconocimientos.php';
include __DIR__ . '/users.php';
