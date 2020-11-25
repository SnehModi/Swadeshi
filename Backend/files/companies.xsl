<?xml version="1.0"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <body>
    <h2>Contributers</h2>
    <table border="1">
      <tr bgcolor="#9acd32">
        <th>Name</th>
        <th>Image file</th>
      </tr>
      <xsl:for-each select="Contributers/company">
        <tr>
          <td><xsl:value-of select="name"/></td>
          <td><xsl:value-of select="image"/></td>
        </tr>
      </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>