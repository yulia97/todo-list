<div id="show">
    <?php
    $idT = 0;
    $filename = "../static/list.json";//путь
    $data = file_get_contents( $filename );//считали
    $jdata = json_decode($data, true);//раскодировали
    foreach($jdata['data'] as $enity){//ищем запись с нужным id
	if ($enity["id"] == $_GET["show"]){//передаем id
	   $idT = $enity["id"];//запомнили id
	    echo "<h3>".$enity["title"]."</h3>";//заголовок
	    echo "<pre>".$enity["text"]."</pre>";//текст
	    break;
	}
    }
    
    ?>
    
    
    <a class="btn btn-default" id="showEdit" href="index.php?page=edit&id=<?= $idT ?>">Edit</a> <!-- кнопка, передающая наш id--> 
    <a class="btn btn-danger" id="showDelete">Delete</a>
    
</div>
