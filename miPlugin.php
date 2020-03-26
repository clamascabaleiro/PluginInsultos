<?php
/*
Plugin Name: miPlugin
Plugin URI:  http://18.216.246.168/miplugin
Description: This plugin replaces words with your own choice of words.
Version:     1.0
Author:      CLAMAS 
Author URI:  http://link to your website
License:     GPL2 etc
License URI: https://link to your plugin license

Copyright YEAR PLUGIN_AUTHOR_NAME (email : your email address)
(Plugin Name) is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
(Plugin Name) is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with (Plugin Name). If not, see (http://link to your plugin license).
*/


//Filtro que llama a la función que le dice qué palabra debe sustituir por otra.
add_filter( 'the_content', 'changeWord' );

//Filtro para dar un aviso si la contraseña es errónea.
add_filter( 'login_errors', 'wrongPass' );

//Funcion que reemplaza la primera palabra dada, por la segunda
function changeWord( $text ) {
return str_replace( 'WordPress', 'WordPressDAM', $text );
}

//Función que lanza un aviso cuando escribimos mal nuestra contraseña
function wrongPass(){
return 'La contraseña es incorrecta';
}


// Al activar el plugin se crea la tabla en la base de datos y se insertan los insultos.
add_action( 'plugins_loaded', 'create_table' );

//Función que crea la tabla en la base de datos cuando es llamada.
function create_table() {
   
global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

//prefijo de la tabla
$table_name = $wpdb->prefix . 'censura';

// creamos la sentencia sql

$sql = "CREATE TABLE $table_name (
palabras varchar(20) PRIMARY KEY
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}


//Se llama a esta acción cuando el plugin es activado de modo que hace los insert
register_activation_hook( __FILE__, 'insertInsultos' );

//Función para insertar una serie de insultos en la tabla creada.
function insertInsultos() {

global $wpdb;
// le añado el prefijo a la tabla
$table_name = $wpdb->prefix . 'insultos';
$wpdb->insert($table_name, array('insulto' => 'caca'),array('%s'));
$wpdb->insert($table_name, array('insulto' => 'pedo'),array('%s'));
$wpdb->insert($table_name, array('insulto' => 'culo'),array('%s'));
$wpdb->insert($table_name, array('insulto' => 'pis'),array('%s'));
}

//Filtro que sustituye insultos, recogiéndolas de la base de datos
add_filter( 'the_content', 'changeInsulto' );

//Función que hace un select que recoge el resultado en forma de array, del que sacamos la palabra sobre la que se hace la búsqueda en la página.

function changeInsulto( $text ) {
global $wpdb;
$result = $wpdb->get_results( 'SELECT insulto FROM wp_2insultos', ARRAY_A );

//Substituye caca 
return str_replace( $result[0],'c*c*', $text );
}

//Filtro que sustituye insultos, recogiéndolas de la base de datos
add_filter( 'the_content', 'changeInsulto2' );

//Función que hace un select que recoge el resultado en forma de array, del que sacamos la palabra sobre la que se hace la búsqueda en la página.

function changeInsulto2( $text ) {
global $wpdb;
$result = $wpdb->get_results( 'SELECT insulto FROM wp_2insultos', ARRAY_A );

//Substituye pedo 
return str_replace( $result[1],'p*d*', $text );
}

//Filtro que sustituye insultos, recogiéndolas de la base de datos
add_filter( 'the_content', 'changeInsulto3' );

//Función que hace un select que recoge el resultado en forma de array, del que sacamos la palabra sobre la que se hace la búsqueda en la página.

function changeInsulto3( $text ) {
global $wpdb;
$result = $wpdb->get_results( 'SELECT insulto FROM wp_2insultos', ARRAY_A );

//Substituye culo 
return str_replace( $result[1],'c*l*', $text );
}

//Filtro que sustituye insultos, recogiéndolas de la base de datos
add_filter( 'the_content', 'changeInsulto4' );

//Función que hace un select que recoge el resultado en forma de array, del que sacamos la palabra sobre la que se hace la búsqueda en la página.

function changeInsulto4( $text ) {
global $wpdb;
$result = $wpdb->get_results( 'SELECT insulto FROM wp_2insultos', ARRAY_A );

//Substituye pis 
return str_replace( $result[1],'p*s', $text );


?>