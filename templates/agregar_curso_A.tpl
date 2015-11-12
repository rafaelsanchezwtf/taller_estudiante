<div class="square">
<h1 class="title">Agregar Curso</h1>
<form action="{$gvar.l_global}agregar_curso_A.phpoption=insert" method="post">
	<label for="id">Identificacion: </label><input id="id" name="id" type="text"/><br/>
	<label for="nombre">Nombre: </label>
	<input id="nombre" name="nombre" type="text"  /><br/>
	<label for="facultad">Facultad: </label>
	<input id="facultad" name="facultad" type="text"  /><br/>
	<input class="btn btn-primary" type="submit" value="Agregar"/>
</form>
</div>