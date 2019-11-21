<!DOCTYPE html>
<html>
<head>
    <title>Subiendo Archivo</title>
</head>
<body>
<?php

echo '<pre>';
$archivo = $_FILES['imagenes'];
$reporte_error = "";
$reporte_subido = "";
if (!empty($archivo)) {
    $desc_archivo = reArrayFiles($archivo);
    //print_r($desc_archivo);
    foreach ($desc_archivo as $val) {
        $extension = strtolower(pathinfo($val['name'], PATHINFO_EXTENSION));
        //print_r("EXTENSION: ".$extension);
        if ($extension == "jpg" || $extension == "png" || $extension == "gif") {
            if ($val['size'] > 800000) {
                echo "<br>";
                $imagen = optimizar_imagen($val['tmp_name'], "imagenes_comprimidas/" . $val['name'], 25);
                //print_r("IMAGEN:  ".$imagen);
                echo "<br>";
                $reporte_subido.= "<hr>";
                $reporte_subido.= "Imagen comprimida en ruta: " . $imagen . "<br>";
                $estado = move_uploaded_file($val['tmp_name'], 'imagenes_normales/' . $val['name']);
                if ($estado == 1) {
                    //echo "<script>alert('Archivo Subido Exitosamente.!!!');</script>";
                    //echo "<script>location='index.php';</script>";
                    //print_r("IMAGEN SUBIDA");
                    $reporte_subido.= "Subido exitosamente, nombre archivo: " . $val['name'] . "<br>";
                }
                if (file_exists($imagen)) {
                    $reporte_subido.= "Imagen " . $val['name'] . " está comprimida y guardada en ruta: " . $imagen . "<br>";
                } else {
                    $reporte_error.= "Imagen " . $val['name'] . " no se pudo guardar por una razón desconocida.<br>";
                }
                echo "<br>";
            } else {
                $reporte_error.= "Imagen " . $val['name'] . " ya está optimizada.";
                copy($val['tmp_name'], 'imagenes_comprimidas/' . $val['name']);
                $estado = move_uploaded_file($val['tmp_name'], 'imagenes_normales/' . $val['name']);
                if ($estado == 1) {
                    //echo "<script>alert('Archivo Subido Exitosamente.!!!');</script>";
                    //echo "<script>location='index.php';</script>";
                    //print_r("IMAGEN SUBIDA");
                    $reporte_subido.= "Subido exitosamente, nombre archivo: " . $val['name'] . "<br>";
                }
            }
        } else {
            //echo "<script>alert('Error al subir este archivo: Formato incorreto. Archivo Identificado: ".$val['name']."');</script>";
            //echo "<script>location='index.php';</script>";
            $reporte_error.= "Formato incorrecto, archivo afectado: " . $val['name'] . "<br>";
            $reporte_error.= "<hr>";
        }
    }
    if ($reporte_error == "") {
        echo "<script>alert('Archivo subido exitosamente.!!!');</script>";
        echo "<script>location='index.php';</script>";
    } else {
        echo "REPORTE DE ERRORES:<br><hr>" . $reporte_error;
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "REPORTES DE ARCHIVOS SUBIDOS: <br>" . $reporte_subido;
    }
} else {
    echo "<script>alert('No ha seleccionado archivo.!!!');</script>";
    echo "<script>location='index.php';</script>";
}

function reArrayFiles($file) {
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    for ($i = 0;$i < $file_count;$i++) {
        foreach ($file_key as $val) {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}

function optimizar_imagen($origen, $destino, $calidad) {
    $info = getimagesize($origen);
    if ($info['mime'] == 'image/jpeg') {
        $imagen = imagecreatefromjpeg($origen);
    } else if ($info['mime'] == 'image/gif') {
        $imagen = imagecreatefromgif($origen);
    } else if ($info['mime'] == 'image/png') {
        $imagen = imagecreatefrompng($origen);
    }
    imagejpeg($imagen, $destino, $calidad);
    return $destino;
}

?>
</body>
</html>