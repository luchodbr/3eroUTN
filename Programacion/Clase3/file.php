<?php

var_dump($_FILES['archivo']);
$name=$_FILES['archivo']['name'];
$tmp_name = $_FILES['archivo']['tmp_name'];
$nombre = $_FILES['legajo']."-".$name;
//copy('datos.json','personas.json');
$folder = 'images/';
echo move_uploaded_file($tmp_name,$nombre);