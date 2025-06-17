<!--
$archivoXML = "P.U.R.xml";
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $clase = $_POST['clase'] ?? '';
    $habitat = $_POST['habitat'] ?? '';
}
-->

<?php
$archivoXML = "P.U.R.xml";
$mensaje = "";

// Carga el XML
if (!file_exists($archivoXML)) {
    die("Archivo XML no encontrado");
}
$xml = simplexml_load_file($archivoXML);
// Genera un nuevo CIU basado en el último CIU
function generarCIU($xml) {
    
    $max = 0;
    foreach ($xml->lagarto as $lagarto) {
        $ciu = (string) $lagarto['CIU'];
        $num = intval(substr($ciu, 1));
        if ($num > $max) $max = $num;
    }
    $nuevoNum = $max + 1;
    return "A" . str_pad($nuevoNum, 3, "0", STR_PAD_LEFT);
}

// Crear nuevo lagarto
if (isset($_POST['action']) && $_POST['action'] === 'create') {
    $nombre = trim($_POST['nombre'] ?? '');
    $especie = trim($_POST['especie'] ?? '');
    $clase = trim($_POST['clase'] ?? '');
    $habitat = trim($_POST['habitat'] ?? '');

    if ($nombre && $especie && $clase && $habitat) {
        $nuevoCIU = generarCIU($xml);
        $nuevo = $xml->addChild('lagarto');
        $nuevo->addAttribute('CIU', $nuevoCIU);
        $nuevo->addChild('nombre', $nombre);
        $nuevo->addChild('especie', $especie);
        $nuevo->addChild('clase', $clase);
        $nuevo->addChild('habitat', $habitat);
        $xml->asXML($archivoXML);
        $mensaje = "Nuevo lagarto creado con CIU $nuevoCIU.";
    } else {
        $mensaje = "Todos los campos son obligatorios para crear.";
    }
}

// Actualizar lagarto
if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $ciu = $_POST['ciu'] ?? '';
    $nombre = trim($_POST['nombre'] ?? '');
    $especie = trim($_POST['especie'] ?? '');
    $clase = trim($_POST['clase'] ?? '');
    $habitat = trim($_POST['habitat'] ?? '');

    if ($ciu && $nombre && $especie && $clase && $habitat) {
        $encontrado = false;
        foreach ($xml->lagarto as $lagarto) {
            if ((string)$lagarto['CIU'] === $ciu) {
                $lagarto->nombre = $nombre;
                $lagarto->especie = $especie;
                $lagarto->clase = $clase;
                $lagarto->habitat = $habitat;
                $encontrado = true;
                break;
            }
        }
        if ($encontrado) {
            $xml->asXML($archivoXML);
            $mensaje = "Lagarto con CIU $ciu actualizado.";
        } else {
            $mensaje = "Lagarto con CIU $ciu no encontrado.";
        }
    } else {
        $mensaje = "Todos los campos son obligatorios para actualizar.";
    }
}

// Eliminar lagarto
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $ciu = $_POST['ciu'] ?? '';
    if ($ciu) {
        $index = 0;
        $encontrado = false;
        foreach ($xml->lagarto as $lagarto) {
            if ((string)$lagarto['CIU'] === $ciu) {
                unset($xml->lagarto[$index]);
                $encontrado = true;
                break;
            }
            $index++;
        }
        if ($encontrado) {
            $xml->asXML($archivoXML);
            $mensaje = "Lagarto con CIU $ciu eliminado.";
        } else {
            $mensaje = "Lagarto con CIU $ciu no encontrado para eliminar.";
        }
    } else {
        $mensaje = "Debe especificar CIU para eliminar.";
    }
}
?>