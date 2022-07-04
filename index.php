<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <?php
    function ejecutar_consulta($busqueda){
        $db_host="sql104.byethost17.com";
        $db_namedb="b17_32099679_pruebas";
        $db_user="b17_32099679";
        $db_pass="Galadriel94*";
        //$busqueda= $_GET["buscar"];

        $conexion=mysqli_connect($db_host, $db_user, $db_pass);
        if(mysqli_connect_errno()){
            echo "fallo al conectar la base de datos";
            exit();
        }

        mysqli_select_db($conexion, $db_namedb) or die ("No se encuentra la base de datos");
        mysqli_set_charset($conexion, "utf8");

        if($busqueda=="allDataBase"){
            $consulta= "SELECT * FROM productos";
        }else{
            $consulta= "SELECT * FROM productos WHERE Nombre like '%$busqueda%'";
        }

        $resultados= mysqli_query($conexion, $consulta);
        echo ' <a href="index.php"><button>Volver</button></a>';
    
        echo "<div class='container'>
        <div class='row border'>";
        echo "<div class='col border'>" . 'Codigo' . "</div>";
        echo "<div class='col border'>" . 'Nombre' . "</div>";
        echo "<div class='col border'>" . 'Presentacion' . "</div>";
        echo "<div class='col border'>" . 'Cantidad' . "</div>";
        echo "<div class='col border'>" . "$ " . 'Precio' . "</div>";
        echo "<div class='col-sm-4 border'>" . 'Descripcion' . "</div>";
        echo "  </div>
        </div>";

        while($fila=mysqli_fetch_array($resultados, MYSQLI_ASSOC)){

            echo "<div class='container'>
            <div class='row border'>";
            echo "<div class='col border'>" . $fila['Codigo'] . "</div>";
            echo "<div class='col border'>" . $fila['Nombre'] . "</div>";
            echo "<div class='col border'>" . $fila['Presentacion'] . "</div>";
            echo "<div class='col border'>" . $fila['Cantidad'] . "</div>";
            echo "<div class='col border'>" . "$" . $fila['Precio'] . "</div>";
            echo "<div class='col-sm-4 border'>" . $fila['Descripcion'] . "</div>";
            echo "  </div>
            </div>";
        }


        echo ' <a href="index.php"><button>Volver</button></a>';


    }
?>

<script>
    function todos(){
    var buscar=document.getElementById('buscar');
    var enviar=document.getElementById('enviar');
    buscar.value="allDataBase";
    enviar.click();
    buscar.value="";

}</script>

</head>

<body>

<div class="container-xl" style="display:flex; flex-wrap:wrap; justify-content:center;">
    <div style="width:800px;">
    <br>
<?php

    $mibusqueda=$_GET["buscar"];
    $mipag=$_SERVER["PHP_SELF"];

    if($mibusqueda!=NULL){
        ejecutar_consulta($mibusqueda);
    } else{
        echo("<form action='" . $mipag . "' method='get'>
        <div class='input-group mb-3'>
        <input type='text' class='form-control' placeholder='Escriba un termino' aria-label='Escriba un termino' aria-describedby='enviar' id='buscar' name='buscar'>
        <button class='btn btn-outline-primary' type='submit' id='enviar'>Buscar producto</button><br>
        <button class='btn btn-outline-secondary' type='button' onclick='todos();' id='buscar-todos'>Ver todos los productos</button>
        </div>
        </form>
        
       ");
        
    }
?>

</div>
    </div>
   
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>