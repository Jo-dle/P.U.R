<?php
include_once "../Controladores/controladorIndex.PHP"
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>CRUD Lagartos XML</title>
</head>
<body>
<h1>Gestión de Lagartos</h1>
<p><?php echo htmlspecialchars($mensaje); ?></p>

<h2>Crear Nuevo Lagarto</h2>
<form method="post">
    <input type="hidden" name="action" value="create" />
    Nombre: <input type="text" name="nombre" required /><br/>
    Especie: <input type="text" name="especie" required /><br/>
    Clase: <input type="text" name="clase" value="Sauropsida" readonly /><br/>
    Habitat: <input type="text" name="habitat" required /><br/>
    <button type="submit">Crear</button>
</form>

<h2>Lista de Lagartos</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>CIU</th><th>Nombre</th><th>Especie</th><th>Clase</th><th>Habitat</th><th>Acciones</th>
    </tr>
    <?php foreach ($xml->lagarto as $lagarto): ?>
    <tr>
        <td><?php echo $lagarto['CIU']; ?></td>
        <td><?php echo htmlspecialchars($lagarto->nombre); ?></td>
        <td><?php echo htmlspecialchars($lagarto->especie); ?></td>
        <td><?php echo htmlspecialchars($lagarto->clase); ?></td>
        <td><?php echo htmlspecialchars($lagarto->habitat); ?></td>
        <td>
            <!-- Formulario para editar -->
            <form method="post" style="display:inline-block;">
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="ciu" value="<?php echo $lagarto['CIU']; ?>" />
                Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($lagarto->nombre); ?>" required />
                Especie: <input type="text" name="especie" value="<?php echo htmlspecialchars($lagarto->especie); ?>" required />
                Clase: <input type="text" name="clase" value="<?php echo htmlspecialchars($lagarto->clase); ?>" readonly />
                Habitat: <input type="text" name="habitat" value="<?php echo htmlspecialchars($lagarto->habitat); ?>" required />
                <button type="submit">Actualizar</button>
            </form>

            <!-- Formulario para eliminar -->
            <form method="post" style="display:inline-block;" onsubmit="return confirm('¿Seguro que quieres eliminar este lagarto?');">
                <input type="hidden" name="action" value="delete" />
                <input type="hidden" name="ciu" value="<?php echo $lagarto['CIU']; ?>" />
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>