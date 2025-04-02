let formulario = document.getElementById("formulario");
let ventana_registro = document.getElementById("ventana_registro");
let title_ventana = document.getElementById("title_ventana");
let titulo = document.getElementById("titulo");
let descripción = document.getElementById("descripción");
let id_ventana = document.getElementById("id_ventana");
let btn_change = document.getElementById("btn_change");


function limpiarCasillas(){
    formulario.querySelector("#titulo").value = "";
    formulario.querySelector("#descripción").value = "";
}

// controles crud de la ventana
function controlesVentana(control, btn){
    console.log(btn);

    if (control == "guardar"){
        formulario.action = "php/guardar.php";
        btn_change.querySelector("p").innerHTML = "Guardar tarea";
        btn_change.name = "guardar";

        formulario.children
        limpiarCasillas();
        ventana_registro.classList.add("ventana_registro_active");
    }

    if (control == "eliminar"){
        let publicationId = btn.querySelector("p").innerHTML;
        
        Swal.fire({
            title: "¿Desea eliminar esta publicación?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar"
        }).then((result) => {
        // if confirm asnwer, so publication delete
        if (result.isConfirmed) {
            $.ajax({
                // parametes
                url: 'php/eliminar.php',
                type: 'POST', // type of send
                data: {
                    id_delete: publicationId,
                },
                // correct answer
                success: function(response){    
                    Swal.fire({
                        title: "¡Eliminado con éxito!",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                    }).then((result) => {
                        if (result.isConfirmed){
                            location.reload();
                        }
                    });
                },
                // bad answer
                error: function(xhr){
                    console.error(xhr.responseText);
                }
            });

        } else {
            Swal.fire({
                title: "Acción cancelada",
                icon: "info"
            });  
        }
        });
    }

    if (control == "modificar"){
        formulario.action = "php/modificar.php";
        btn_change.querySelector("p").innerHTML = "Modificar tarea";

        btn_change.name = "modificar";

        limpiarCasillas();

        // datos de la tabla
        let fila = btn.closest("tr");
        let titulo_tabla = fila.children[1].innerHTML;
        let descripcion_tabla = fila.children[2].innerHTML;
        let id_modificar = btn.querySelector("p").innerHTML;
        
        console.log(id_modificar);
        
        // colocando datos
        titulo.value = titulo_tabla;
        descripción.value = descripcion_tabla;
        id_ventana.value = id_modificar;

        ventana_registro.classList.add("ventana_registro_active");
    }
}

// btn de cerrar la ventana
let btn_close = document.querySelector(".btn_close");
btn_close.addEventListener("click" , () => {
    ventana_registro.classList.remove("ventana_registro_active");
});
