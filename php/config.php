<?php
    $username = 'ANDEL_DATABASE';
    $password = '1212';
    $dsn = 'oci:dbname=//localhost:1521/xe';

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lanzar excepciones en caso de error
        PDO::ATTR_EMULATE_PREPARES => false, // Deshabilitar la emulación de sentencias preparadas
        PDO::ATTR_STRINGIFY_FETCHES => true // hace que todos los valores numéricos y CLOBs sean tratados como strings automáticamente
    ];

    try {
        // Crear una instancia de PDO con las opciones de seguridad
        $conex = new PDO($dsn, $username, $password, $options);
        
    } catch (PDOException $e) {
        // Capturar y mostrar el mensaje de error
        echo "Error de conexión: " . $e->getMessage();
    }
?>
