<?php  
    // conexion de la base de datos
    require_once "config.php";
    session_start();

    $id_delete = $_POST['id_delete'];
    
    // ELIMINANDO
    $consult_save_data = $conex->prepare("DELETE FROM GESTION_TAREA WHERE ID_TAREA = ?");
    $consult_save_data->execute([$id_delete]);

    $conex = null;
?>

