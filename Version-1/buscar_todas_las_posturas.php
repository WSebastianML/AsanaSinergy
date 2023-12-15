<?php

$sql = "SELECT pd.terminoID, pd.terminoEnglish, pd.terminoSanskrit, pd.terminoSpanish, pd.imagenURL, m.morfemaSanskrit AS traduccionMorfemaSanskrit, m.morfemaSpanish AS traduccionMorfemaSpanish ";
$sql .= "FROM postura pd ";
$sql .= "LEFT JOIN relacion_postura_morfema rpm ON pd.terminoID = rpm.terminoID ";
$sql .= "LEFT JOIN morfema m ON rpm.morfemaID = m.morfemaID ";
// Ejecutar la consulta

$resultado = mysqli_query($connection, $sql) or die(mysqli_error($connection));

// Verificar si hay resultados
if (mysqli_num_rows($resultado) > 0) {
    $posturas = array();

    // Iterar sobre los resultados y organizar la información por postura
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $terminoID = $fila['terminoID'];
        $terminoEnglish = $fila['terminoEnglish'];
        $terminoSanskrit = $fila['terminoSanskrit'];
        $terminoSpanish = $fila['terminoSpanish'];
        $imagenURL = $fila['imagenURL'];

        // Organizar la información por postura
        if (!isset($posturas[$terminoID])) {
            $posturas[$terminoID] = array(
                'terminoID' => $terminoID,
                'terminoEnglish' => $terminoEnglish,
                'terminoSanskrit' => $terminoSanskrit,
                'terminoSpanish' => $terminoSpanish,
                'imagenURL' => $imagenURL,
                // Agregar información de morfemas a la postura
                'morfemas' => array()
            );
        }

        // Verificar si hay morfemas relacionados antes de agregar la información de morfemas
        if (!empty($fila['traduccionMorfemaSanskrit']) || !empty($fila['traduccionMorfemaSpanish'])) {
            // Agregar información de morfemas a la postura
            $traduccionMorfemaSanskrit = $fila['traduccionMorfemaSanskrit'];
            $traduccionMorfemaSpanish = $fila['traduccionMorfemaSpanish'];

            $posturas[$terminoID]['morfemas'][] = array(
                'traduccionMorfemaSanskrit' => $traduccionMorfemaSanskrit,
                'traduccionMorfemaSpanish' => $traduccionMorfemaSpanish,
            );
        }
    }
}
?>