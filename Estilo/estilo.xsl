<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <xsl:template match="/">

    <html lang="es">
      <head>
        <meta charset="UTF-8"/>
        <title>Listado de Lagartos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
      </head>
      <body>
        <div class="container mt-5">
          <h1 class="mb-4">Listado de Lagartos</h1>

          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>CIU</th>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Hábitat</th>
                <th>Clase</th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="lagartos/lagarto">
                <tr>
                  <td><xsl:value-of select="@CIU"/></td>
                  <td><xsl:value-of select="nombre"/></td>
                  <td><xsl:value-of select="especie"/></td>
                  <td><xsl:value-of select="habitat"/></td>
                  <td><xsl:value-of select="clase"/></td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
        </div>
      </body>
    </html>

  </xsl:template>
</xsl:stylesheet>
