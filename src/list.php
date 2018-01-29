<div id="list">
    <ul class="list-group" id="listOfLinks">
	<?php
	$filename = "../static/list.json"; //путь до файла с записями
	$data = file_get_contents( $filename ); //считываем из файла
	$jdata = json_decode($data, true); //раскодировали json

	foreach ($jdata['data'] as $enity){ // для каждого эл-та в цикле выводим ссылку на стр детального просмотра
	    echo "<a href=\"?id=".trim($enity["id"])."&page=show\" class=\"list-group-item\">".$enity["title"]."</a>";
	}
	?>
    </ul>
</div>
