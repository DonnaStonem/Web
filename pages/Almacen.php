<?php
session_start();

// Verificar si hay recursos disponibles en la sesión
if (!isset($_SESSION['CatalogoRecursos'])) {
    $_SESSION['CatalogoRecursos'] = []; // Inicializar como arreglo vacío si no existe
}

// Obtener el catálogo de recursos de la sesión
$catalogoRecursos = $_SESSION['CatalogoRecursos'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Plumber</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="./../css/Personal.css" rel="stylesheet">
    <link rel="icon" href="img/logo.png" type="image/png">
</head>

<body>
    <div class="container">
        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#AgregarRecurso">
            <i class="fa-solid fa-folder-plus"></i> <span>Agregar material</span>
        </a>

        <h2>Lista de recursos creados</h2>

        <div class="divTabla">
            <table class="tablaUsuarios table">
                <thead class="tituloUsuarios">
                    <tr>
                        <th>ID Material</th>
                        <th>Nombre del material</th>
                        <th>Costo unitario</th>
                        <th>Tipo</th>
                        <th>Cantidad total</th>
                        <th>Cantidad disponible</th>
                        <th>Cantidad prestada</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody class="contenidoUsuarios">
                    <?php foreach ($catalogoRecursos as $recursos): ?>
                        <tr>
                            <td><?php echo $recursos['IdMaterialAlmacen']; ?></td>
                            <td><?php echo $recursos['NombreMaterial']; ?></td>
                            <td><?php echo $recursos['CostoUnitario']; ?></td>
                            <td><?php echo $recursos['Tipo']; ?></td>
                            <td><?php echo $recursos['CantidadTotal']; ?></td>
                            <td><?php echo $recursos['CantidadDisponible']; ?></td>
                            <td><?php echo $recursos['CantidadPrestada']; ?></td>
                            <td>
                                <a class="btn btn-success btn-sm editar-recurso" data-toggle="modal"
                                    data-target="#EditarRecurso" data-id="<?php echo $recursos['IdMaterialAlmacen']; ?>"
                                    data-nombre="<?php echo $recursos['NombreMaterial']; ?>"
                                    data-total="<?php echo $recursos['CantidadTotal']; ?>"
                                    data-disponible="<?php echo $recursos['CantidadDisponible']; ?>"
                                    data-prestada="<?php echo $recursos['CantidadPrestada']; ?>"
                                    data-costo="<?php echo $recursos['CostoUnitario']; ?>">
                                    <i class="fa-solid fa-folder-plus"></i> <span>Editar</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Agregar Recurso -->
    <div class="modal fade" id="AgregarRecurso" tabindex="-1" role="dialog" aria-labelledby="AgregarRecursoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form action="agregar_recurso.php" method="post" id="formAgregarRecurso" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Agregar recurso</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ElementoCrearUsuairo">
                        <label for="NombreRecurso">Nombre del recurso:</label>
                        <input type="text" id="NombreRecurso" name="NombreRecurso" required>
                    </div>
                    <div class="ElementoCrearUsuairo">
                        <label for="CantidadTotal">Cantidad total:</label>
                        <input type="number" id="CantidadTotal" name="CantidadTotal" required>
                    </div>
                    <div class="ElementoCrearUsuairo">
                        <label for="CostoUnitario">Costo unitario:</label>
                        <input type="number" id="CostoUnitario" name="CostoUnitario" required>
                    </div>
                    <div class="ElementoCrearUsuairo">
                        <label for="Tipo">Tipo:</label>
                        <select name="Tipo" id="Tipo" required>
                            <option value="Consumible">Consumible</option>
                            <option value="NoConsumible">No Consumible</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Recurso -->
    <div class="modal fade" id="EditarRecurso" tabindex="-1" role="dialog" aria-labelledby="EditarRecursoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form action="editar_recurso.php" method="post" id="formEditarRecurso" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Editar recurso</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="modalNombreRecurso"></h5>
                    <div class="ElementoCrearUsuairo">
                        <label for="EditarCantidadTotal">Cantidad total:</label>
                        <input type="number" id="EditarCantidadTotal" name="CantidadTotal" required>
                    </div>
                    <input type="hidden" id="IdCatalogo" name="IdCatalogo">
                    <input type="hidden" id="NombreRecursoHidden" name="NombreRecurso">
                    <input type="hidden" id="CantidadDisponible" name="CantidadDisponible">
                    <input type="hidden" id="CantidadPrestada" name="CantidadPrestada">
                    <input type="hidden" id="CostoUnitario" name="CostoUnitario">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para validaciones -->
    <script>
        $(document).ready(function () {
            $('#EditarRecurso').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var idRecurso = button.data('id');
                var nombreRecurso = button.closest('tr').find('td:eq(2)').text();

                $('#IdCatalogo').val(idRecurso);
                $('#NombreRecursoHidden').val(nombreRecurso);
                $('#modalNombreRecurso').text(nombreRecurso);
            });
        });
    </script>

</body>

</html>