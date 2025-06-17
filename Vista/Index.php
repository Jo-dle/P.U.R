<?php
include_once "../Controladores/controladorIndex.PHP";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>CRUD Lagartos XML</title>

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Estilo opcional-->
  <style>
    body {
      font-family: sans-serif;
      margin: 2rem;
    }

    table.dataTable {
      border-collapse: collapse !important;
      width: 100%;
    }

    table.dataTable th, table.dataTable td {
      padding: 0.75rem;
    }

    table.dataTable tbody tr {
      background-color: #fff;
    }

    table.dataTable thead {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>

<h1>Gestión de Lagartos</h1>
<p><?php echo htmlspecialchars($mensaje ?? ''); ?></p>
<p>
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#crearnuevolagarto" aria-expanded="false" aria-controls="crearnuevolagarto">
    Crear Nuevo Lagarto
  </button>
</p>
<div style="min-height: 150px;">
  <div class="collapse collapse-horizontal" id="crearnuevolagarto">
    <div class="card card-body" style="width: 300px;">
      <form method="post">
      <input type="hidden" name="action" value="create" />
       Nombre: <input type="text" name="nombre" required /><br/>
       Especie: <input type="text" name="especie" required /><br/>
       Clase: <input type="text" name="clase" value="Sauropsida" readonly /><br/>
       Habitat: <input type="text" name="habitat" required /><br/>
      <button type="submit">Crear</button>
</div>
  </div>
    </div>
</form>

    </div>
  </div>
</div>
<h2>Lista de Lagartos</h2>
<?php if (isset($xml)): ?>
<table id="tablaLagartos" class="display responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>CIU</th><th>Nombre</th><th>Especie</th><th>Clase</th><th>Habitat</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($xml->lagarto as $lagarto): ?>
    <tr>
      <td><?php echo $lagarto['CIU']; ?></td>
      <td><?php echo htmlspecialchars($lagarto->nombre); ?></td>
      <td><?php echo htmlspecialchars($lagarto->especie); ?></td>
      <td><?php echo htmlspecialchars($lagarto->clase); ?></td>
      <td><?php echo htmlspecialchars($lagarto->habitat); ?></td>
      <td>
        <form method="post" style="display:inline-block;">
          <input type="hidden" name="action" value="update" />
          <input type="hidden" name="ciu" value="<?php echo $lagarto['CIU']; ?>" />
          <input type="text" name="nombre" value="<?php echo htmlspecialchars($lagarto->nombre); ?>" required />
          <input type="text" name="especie" value="<?php echo htmlspecialchars($lagarto->especie); ?>" required />
          <input type="text" name="clase" value="<?php echo htmlspecialchars($lagarto->clase); ?>" readonly />
          <input type="text" name="habitat" value="<?php echo htmlspecialchars($lagarto->habitat); ?>" required />
          <button type="submit">Actualizar</button>
        </form>
        <form method="post" style="display:inline-block;" onsubmit="return confirm('¿Seguro que quieres eliminar este lagarto?');">
          <input type="hidden" name="action" value="delete" />
          <input type="hidden" name="ciu" value="<?php echo $lagarto['CIU']; ?>" />
          <button type="submit">Eliminar</button>
        </form>
</form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    $('#tablaLagartos').DataTable({
      responsive: true,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      }
    });
  });
</script>

</body>
</html>