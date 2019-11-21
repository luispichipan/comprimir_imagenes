<!DOCTYPE html>
<html>
<head>
	<title>Subir Imagenes Comprimidas</title>
</head>
<style type="text/css">
	#contenedor{
		width: 100%;
		text-align: center;
	}
	table{
		margin-left: auto;
		margin-right: auto;
	}
	.button {
	  background-color: #4CAF50; /* Green */
	  border: none;
	  color: white;
	  padding: 16px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  cursor: pointer;
	}
	.button_archivo{
	  background-color: white; 
	  color: black; 
	  border: 2px solid #008CBA;
	}
	.btn_subir{
		background-color: #4CAF50;
		border-radius: 5px;
	}
</style>
<script type="text/javascript">
	function Upload_Imagenes() {
		 var x = document.getElementById("imagenes");
		 if (x.value=="") {
		 	alert("Debe seleccionar al menos una imagen");
		 }
		 else{
		 	document.form_subir_imagen.submit();
		 }
	}
</script>

<body>
	<div id="contenedor">
		<form name="form_subir_imagen" action="upload_imagenes.php" method="post" multipart="" enctype="multipart/form-data">
			<table>
				<tr>
					<td><input type="file" class="button button_archivo" name="imagenes[]" id="imagenes" multiple="" accept="image/*"></td>
				</tr>
				<tr>
					<td><input type="button" class="button btn_subir" value="Subir" onclick="Upload_Imagenes();"></td>
				</tr>
			</table>
	    </form>
	</div>
</body>
</html>