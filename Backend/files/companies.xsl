<<<<<<< HEAD
<?xml version="1.0" encoding="UTF-8"?>
<html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<body style="font-family:sans-serif; font-size:24pt; background-color:#4d3319">

<xsl:for-each select="companies/category">

  <div style="background-color:#CCBDA2;color:#8F4827;padding:4px">
    <span style="font-weight:bold"><xsl:value-of select="name"/></span>
    </div>

  <div style="margin-left:20px;margin-bottom:1em;font-size:20pt;color:#be6633;font-family:sans-serif;">
    <p>
    <xsl:value-of select="description"/>
    </p>
  </div>

</xsl:for-each>

</body>
</html>
=======
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
>>>>>>> d919e6da9779dcd28aefa247f214eb98fc46c26b
