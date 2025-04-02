<?php  
    // conexion de la base de datos
    require_once "php/config.php";
    session_start();

    if (isset($conex)){
        // buscando datos
        $consult_data = $conex->prepare("select * from GESTION_TAREA");
        $consult_data->execute();
        $result_D = $consult_data->fetchAll(PDO::FETCH_ASSOC);

        $data_HTML = "";
        if (count($result_D) > 0){
            foreach ($result_D as $row){
                $descripcion =  $row['DESCRIPCION'];

                $data_HTML .= '
                <tr>
                    <td class="indice">'.$row['ID_TAREA'].'</td>
                    <td>'.$row['TITULO'].'</td>
                    <td>'.$descripcion.'</td>
                    <td class="'.$row['PRIORIDAD'].'">
                        <div class="prioridad">
                            <span></span>    
                            '.$row['PRIORIDAD'].'
                        </div>           
                    </td>
                    <td>'.$row['FECHA_CREACION'].'</td>
                    <td>
                        <div class="controles">
                            <button class="btn btn2 btn_delete" onclick="controlesVentana(\'eliminar\' , this)">
                                <i class="fa-solid fa-trash"></i>
                                <p class="none">'.$row['ID_TAREA'].'</p>
                            </button>
                            <button class="btn btn2 btn_update" onclick="controlesVentana(\'modificar\', this)">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <p class="none">'.$row['ID_TAREA'].'</p>
                            </button>
                        </div>
                    </td>
                </tr>';            
            }
        } else {
            $data_HTML = '
                <tr>
                    <td class="indice" colspan="6"><i class="fa-solid fa-server"></i> Sin datos disponibles</td>
                </tr>
            ';
        }

        $conex = null;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con PHP y Oracle</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main_general.css">
    <link rel="stylesheet" href="css/btns.css">
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="stylesheet" href="css/ventana_registro.css">
    <link rel="stylesheet" href="css/notificacion.css">

    <link rel="icon" href="img/logo_portafolio.png" type="image/x-png">

    <script src="https://kit.fontawesome.com/7881bda97f.js" crossorigin="anonymous"></script>

    <!-- Sweetalert2 for alert message -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>
<body>
    <!-- --- Notificacion --- -->
    <!-- funcionalidad de envio de una respuesta a traves de php -->
    <?php if (isset($_SESSION['icono_n'])){ ?>
    <div class="capa_notificacion ani_entrada_notificacion">
        <div class="contenedor_notificacion" id="contenedor_notificacion">
            <div class="encabezado">
                <i class="<?php echo $_SESSION['icono_n'] ?>"></i>
                <p class="titulo"><?php echo $_SESSION['titulo_n'] ?></p>
            </div>
            
            <p class="contenido"><?php echo $_SESSION['respuesta_n'] ?></p>
            <button class="btn1" id="btn_cerrar_notificacion">Okey</button>
        </div>
    </div>
    <?php
        unset($_SESSION['icono_n'], $_SESSION['titulo_n'], $_SESSION['respuesta_n']); 
        } else { ?>
        <div class="capa_notificacion">
            <div class="contenedor_notificacion" id="contenedor_notificacion">
                <div class="encabezado">
                    <i class=""></i>
                    <p class="titulo">Titulo</p>
                </div>
                
                <p class="contenido">Contenido</p>
                <button class="btn1" id="btn_cerrar_notificacion">Aceptar</button>
            </div>
        </div>
    <?php } ?>

    <section class="ventana_registro" id="ventana_registro">
        <span class="btn_close"><i class="fa-solid fa-square-xmark ani1-icon"></i></span>
        <form action="#" method="post" class="formulario" id="formulario">
            <h3 id="title_ventana">
                <i class="fa-solid fa-cash-register"></i>    
                <p>Detalles de la Tarea</p>
            </h3>
            <hr>
            <div class="casillas">
                <h3><i class="fa-solid fa-table"></i> Casillas</h3>
                <div class="subcontenedor_casillas">
                    <input type="hidden" name="id" id="id_ventana">
                    <input type="text" placeholder="* Titulo" id="titulo" name="titulo" class="input1" required />

                    <select class="input1" name="prioridad" id="prioridad" required>
                        <option value="baja">* Baja</option>
                        <option value="media">* Media</option>
                        <option value="alta">* Alta</option>
                    </select>

                    <textarea placeholder="Descripción" id="descripción" name="descripcion" class="input1" placeholder="* Descripción" required></textarea>             
                </div>
            </div>
            <hr>
            <div class="controles">
                <button type="submit" class="btn_change btn2" id="btn_change">
                    <i class="fa-solid fa-server"></i>
                    <p>Realizar cambio</p>
                </button>
            </div>
        </form>
    </section>

    <header>
        <section class="top">
            <div class="logo">
                <img src="./img/create.png" alt="">
                <h1>CRUD con PHP y Oracle</h1>
            </div>

            <div class="account">
                <img src="./img/user.png" alt="">
                <h3>Usuario</h3>
            </div>
        </section>

        <section class="bottom search_bar">
            <span>
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" id="search_input" placeholder="Escribe un titulo">
        </section>
    </header>

    <main>
        <h2 class="title"><i class="fa-solid fa-screwdriver-wrench"></i> Gestión Inteligente de Tareas: Optimiza tu Productividad</h2>

        <button class="guardar_tarea btn2" id="guardar_tarea" onclick="controlesVentana('guardar'), this">
           + Crear tarea
        </button>

        <section class="contenedor_tabla scroll">
            <table>
                <thead>
                    <th><i class="fa-solid fa-arrow-up-1-9"></i> Índice</th>
                    <th><i class="fa-solid fa-heading"></i> Titulo</th>
                    <th><i class="fa-solid fa-book"></i> Descripción</th>
                    <th><i class="fa-solid fa-chart-simple"></i> Prioridad</th>
                    <th><i class="fa-solid fa-calendar-days"></i> Fecha de creación</th>
                    <th><i class="fa-solid fa-gears"></i> Controles</th>
                </thead>

                <tbody id="data">
                   <?php echo $data_HTML ?>
                </tbody>
            </table>
        </section>
    </main>

    <script src="./js/controles_ventana.js"></script>
    <script src="./js/notificacion.js"></script>
    <script src="./js/search.js"></script>

    <!-- AJAX -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Sweetalert2 for alert message -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</body>
</html>