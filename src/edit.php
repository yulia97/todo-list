<?php
$filename = "../static/list.json";// путь
$data = file_get_contents( $filename );//считывание
$jdata = json_decode($data, true);//раскодировака json


$found;
foreach($jdata['data'] as $enity){//ищем запись с переданным id
    if ($enity["id"] == $_GET["edit"]){
	$found = $enity;//помещаем в переменную запись
	break;
    }
}
?>
<div id="add">
    <form>
	<input type="hidden" value="<?= $found["id"] ?>" class="form-control" id="editId">
	<div class="form-group">
	    <label for="title">Title:</label>
	    <input type="text" class="form-control" value="<?= $found["title"] ?>" id="editTitle">
	</div>
	<div class="form-group">
	    <label for="title">Text:</label>
	    <textarea class="form-control" rows="8" id="editText"><?= $found["text"] ?></textarea> <!-- Внуть текстового поля поместили текст найденной записи-->
	</div>
	<input type="button" class="btn btn-info" value="Submit Button" id="editSubmit">
    </form>
</div>

