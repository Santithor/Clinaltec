<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Lista de Pacientes</h2>
    <table id="tablaPacientes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Género</th>
                <th>Departamento</th>
                <th>Municipio</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <h2>Registrar Nuevo Paciente</h2>
    <form id="formularioPaciente">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="edad">Edad:</label>
        <input type="text" id="edad" name="edad" required><br><br>

        <label for="genero">Género:</label>
        <input type="text" id="genero" name="genero" required><br><br>

        <label for="departamento">Departamento:</label>
        <input type="text" id="departamento" name="departamento" required><br><br>

        <label for="municipio">Municipio:</label>
        <input type="text" id="municipio" name="municipio" required><br><br>

        <button type="submit">Agregar Paciente</button>
    </form>

    <script src="script.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            requisitos( "POST", 
                            "../../../peticiones/pacientes.php", 
                            "&jsonp=?",
                            function(data){
                                if(data["DATA"].length > 0){
                                    var data2 = ``;
                                    $.each(data["DATA"], function(i, val) {
                                        data2 += ` <tr>
                                                    <td>${val.NUMERO}</td>
                                                    <td>${val.NOMBRE}</td>
                                                    <td>${val.ESTADO}</td>
                                                    <td>
                                                        <button type="button" id="AsignarRebateNuevo1" class="btn btn-sm" style="color:white; background-color: #e3b04b;">
                                                            <i class="fa fa-group"></i> &nbsp; Asignar
                                                        </button>
                                                    </td>
                                                    <td>${val.FECHA_CREATE}</td>
                                                    <td>
                                                        <button type="button" id="AsignarRebateNuevo1" class="btn btn-sm" style="color:white; background-color: #e3b04b;">
                                                            <i class="fa fa-file-pdf-o"></i> &nbsp; Generar
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button type="button" id="AsignarRebateNuevo1" class="btn btn-sm" style="color:white; background-color: #e3b04b;">
                                                            <i class="fa fa-dropbox"></i> &nbsp; Generar
                                                        </button>
                                                    </td>
                                                    <td>${val.NOMBRE_USUARIO_CREATE}</td>
                                                </tr>`;
                                    });
                                    var data_table = $(`<tbody id="datos_tabla_inventario">
                                                            ${data2}
                                                        </tbody>`);
                                    $("#datos_tabla_inventario").replaceWith(data_table);
                                }
                            }, 
                            "",  
                            Array()
                        );
        });
        
        function requisitos(method, url, data, successCallback, errorCallback, headers) {
            $.ajax({
              type: method,
              url: url,
              data: data,
              success: successCallback,
              error: errorCallback,
              headers: headers
            });
        }
    </script>
</body>
</html>
