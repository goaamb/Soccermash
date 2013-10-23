<style>

</style>
<form id="formMasivo">
<table>
	<tbody>
		<tr>
			<td valign="top">Asunto:</td>
			<td><input name="asunto" size="255" style="width: 900px;"/></td>
		</tr>
		<tr>
			<td valign="top">Mensaje</td>
			<td><textarea id="editorMensaje" name="mensaje"></textarea></td>
		</tr>
		<tr>
		<td colspan="2" align="center"><input type="button" value="enviar" onclick="enviarMailMasivo.call(this.form);"/></td>
		</tr>
	</tbody>
</table>
</form>