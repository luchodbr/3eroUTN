<?php
/**
 * GET obtener recursos
 *  GET id obtener uno
 * POST crear recursos 
 * PUT modificar
 * DELETE borrar
 */
/** Peticiones que va a tener mi api
 *paises 
 *regiones
 *subregiones 
*/
// $datos;
// $request_method = $_SERVER['REQUEST_METHOD'];
// $path_info = $_SERVER['PATH_INFO'];

// $respuesta = new stdclass;
// switch ($request_method) {
//     case 'GET':
//         if($path_info == '/paises')
//         {
//             $respuesta->data = array('chile','argentina');}
//             else if($path_info == '/regiones')
//             {
//                 $respuesta->data = array('asia','europa');
//             }
//         break;
//     case 'POST':
//     if($path_info == '/paises')
//         $respuesta->data = array('chile','argentina');
//     break;
//         # code...
//         break;
// }
// echo json_encode($respuesta);

// if(isset($_GET['caso']))
// {
//     switch ($_GET['caso']) {
//         case 'paises':
//             # code...
//              $datos=array('chile,argentina');
//             break;
//          case 'regiones':
//             # code...
//                 $datos=array('chile,argentina');
//             break;
//          case 'subregiones':
//             # code...
//             $datos=array('chile,argentina');
//             break;
//         default:
//         $datos = "Caso no valido";
//         break;
//     }
//     echo $_GET['nombre'];
// } 
// if(isset($_POST['nombre']))
// {
//     echo $_POST['nombre'];
// } 
// // echo json_encode($_POST);

// $rta=array(
//     'succes' => true,
//     'data' => $datos
// );
// echo json_encode($rta);
// die();


/**
 * MANEJO DE ARCHIVOS
 * fopen   (archivo,modo)  devuelve un puntero al archivo, siempre hay que cerrarlo(liberarlo) r:solo lec, w: solo esc. a:append agrega
 * fgets lee la linea y corre el puntero a la proxima
 * fclose   
 * freadfgets
 */
 $archivo = fopen('datos.txt','a+');
$escritura = fwrite($archivo,'Nueva Linea' .PHP_EOL);
// echo fread($archivo,filesize('datos.txt'));
while(!feof($archivo))
{
    echo fgets($archivo);
}
fclose($archivo);