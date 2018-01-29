<div id="list">
    <ul class="list-group" id="listOfLinks">
	<?php
	$filename = "../static/list.json";
	$data = file_get_contents( $filename );
	$jdata = json_decode($data, true);
	
	foreach ($jdata['data'] as $enity){
	    echo "<a href=\"?id=".trim($enity["id"])."&page=show\" class=\"list-group-item\">".$enity["title"]."</a>";
	}
	?>
    </ul>
</div>
