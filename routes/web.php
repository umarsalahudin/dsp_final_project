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

use Cornford\Googlmapper\Facades\MapperFacade;
use Illuminate\Support\Facades\Route;

Route::get('/', 'Controller@index');
Route::get('autocomplete', 'Controller@autocomplete');

Route::get('result', 'Controller@show');
Route::get('about', 'Controller@about');
Route::get('test', 'Controller@test');


Route::get('TownMap&{lng}&{lat}',function($lng,$lat){
	 Mapper::map(
        $lat,
        $lng,
        [
            'zoom'=>13,
            'draggable'=> true,
            'marker'=>true,
            'eventAfterLoad'=>
            'circleListener(map[0].shapes[0].circle_0);'
        ]
    );
print '<div style="height:aut0; width:100%">';
print Mapper::render();
print '</div>';
});