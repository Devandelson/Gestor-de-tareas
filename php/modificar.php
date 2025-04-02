<?php  
    // conexion de la base de datos
    require_once "config.php";
    session_start();

    if (isset($_POST['titulo'] , $_POST['prioridad'] , $_POST['descripcion'], $_POST['id']) &&
    empty($_POST['titulo']) || empty($_POST['prioridad']) || empty($_POST['descripcion'])
    || empty($_POST['id'])){
        // $_SESSION['icono_n'] = "fa-solid fa-check icono_activo";
        $_SESSION['icono_n'] = "fa-solid fa-circle-xmark";
        $_SESSION['titulo_n'] = "Datos faltantes";
        $_SESSION['respuesta_n'] = "Por favor rellene todas las casillas hijo de dios.";

        header("location: ../index.php");
    }

    $titulo = $_POST['titulo'];
    $prioridad = $_POST['prioridad'];
    $descripcion = $_POST['descripcion'];
    $id = $_POST['id'];
    
    // guardando
    $consult_update_data = $conex->prepare("UPDATE GESTION_TAREA 
    SET TITULO = ?, DESCRIPCION = ?, PRIORIDAD = ?
    WHERE ID_TAREA = ?");
    $consult_update_data->execute([$titulo, $descripcion , $prioridad, $id]);

    $_SESSION['icono_n'] = "fa-solid fa-check icono_activo";
    $_SESSION['titulo_n'] = "Datos modificados";
    $_SESSION['respuesta_n'] = "Los datos se han modificado correctamente hijo de diso C:.";

    header("location: ../index.php");
    $conex = null;
?>