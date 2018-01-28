<?php
$filename = "../static/list.json";
$data = file_get_contents( $filename );
$jdata = json_decode($data, true);


$found;
foreach($jdata['data'] as $enity){
    if ($enity["id"] == $_GET["edit"]){
	$found = $enity;
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
	    <textarea class="form-control" rows="8" id="editText"><?= $found["text"] ?></textarea>
	</div>
	<input type="button" class="btn btn-info" value="Submit Button" id="editSubmit">
    </form>
</div>

