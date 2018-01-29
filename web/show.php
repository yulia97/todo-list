<div id="show">
    <?php
    $idT = 0;
    $filename = "../static/list.json";
    $data = file_get_contents( $filename );
    $jdata = json_decode($data, true);
    foreach($jdata['data'] as $enity){
	if ($enity["id"] == $_GET["show"]){
	   $idT = $enity["id"];
	    echo "<h3>".$enity["title"]."</h3>";
	    echo "<pre>".$enity["text"]."</pre>";
	    break;
	}
    }
    
    ?>
    
    
    <a class="btn btn-default" id="showEdit" href="index.php?page=edit&id=<?= $idT ?>">Edit</a>
    <a class="btn btn-danger" id="showDelete">Delete</a>
    
</div>
