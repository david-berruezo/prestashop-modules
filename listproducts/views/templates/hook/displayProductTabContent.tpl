<h3 class="page-product-heading">List Products</h3>

<div class="rte">
{foreach from=$resultados item=resultado}
	<div class="mymodcomments-comment">
	    <div>{$resultado.firstname} {$resultado.lastname|substr:0:1}. <small>{$resultado.date_add|substr:0:10}</small></div>
		<div class="star-rating"><i class="glyphicon glyphicon-star"></i> <strong>{l s='Grade:' mod='mymodcomments'}</strong></div> <input value="{$resultado.grade}" type="number" class="rating" min="0" max="5" step="1" data-size="xs" />
		<div><i class="glyphicon glyphicon-comment"></i> <strong>{l s='Comment' mod='mymodcomments'} #{$resultado.id_listproducts}:</strong> {$resultado.comment}</div>
	</div>
	<hr />
{/foreach}
</div>

{*Array ( [0] => Array ( [id_listproducts] => 1 [id_shop] => 1 [id_product] => 6 [firstname] => David [lastname] => Berruezo [email] => davidberruezo@davidberruezo.com [grade] => 3 [comment] => Perfecto [date_add] => 2018-09-25 11:13:07 ) ) 1 *}

<div class="row">
    <div class="col-md-3" style="padding:10px;">
        <form action="" name="form1" method="POST" style="padding:10px;padding-top:20px;padding-bottom:20px;">
            <h5>Formulario</h5>
            <label>Nombre:</label>
            <input class="form-control" type="text" name="nombre" id="nombre">
            <label>Apellidos:</label>
            <input class="form-control" type="text" name="apellido" id="apellido">
            <label>Email:</label>
            <input class="form-control" type="text" name="email" id="email">
            <label>Grade:</label>
            <select id="grade" name="grade">
                <option value="1">Grado 1</option>
                <option value="2">Grado 2</option>
                <option value="3">Grado 3</option>
                <option value="4">Grado 4</option>
                <option value="5">Grado 5</option>
            </select>
            <br>
            <label>Comentarios:</label>
            <textarea id="comment" name="comment"></textarea>
            <br>
            <input class="btn btn-primary" name="enviar" type="submit" value="Enviar">
        </form>
    </div>
</div>        