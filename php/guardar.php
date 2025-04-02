<?php  
    // conexion de la base de datos
    require_once "config.php";
    session_start();

    if (isset($_POST['titulo'] , $_POST['prioridad'] , $_POST['descripcion']) &&
    empty($_POST['titulo']) || empty($_POST['prioridad']) || empty($_POST['descripcion'])){
        // $_SESSION['icono_n'] = "fa-solid fa-check icono_activo";
        $_SESSION['icono_n'] = "fa-solid fa-circle-xmark";
        $_SESSION['titulo_n'] = "Datos faltantes";
        $_SESSION['respuesta_n'] = "Por favor rellene todas las casillas hijo de dios.";

        header("location: ../index.php");
    }

    $titulo = $_POST['titulo'];
    $prioridad = $_POST['prioridad'];
    $descripcion = $_POST['descripcion'];
    
    // guardando
    $consult_save_data = $conex->prepare("INSERT INTO GESTION_TAREA (TITULO, DESCRIPCION, PRIORIDAD) 
    VALUES (?, ?, ?)");
    $consult_save_data->execute([$titulo, $descripcion , $prioridad]);

    $_SESSION['icono_n'] = "fa-solid fa-check icono_activo";
    $_SESSION['titulo_n'] = "Datos guardados";
    $_SESSION['respuesta_n'] = "Los datos se han guardado correctamente hijo de diso C:.";

    header("location: ../index.php");
    $conex = null;
?>