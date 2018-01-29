<?php
//echo 'Hhhh';
if (isset($_GET["api"])){
    switch($_GET["api"]){
    case "update":
	{
	    require('../src/update.php');
	}
	break;
    case "insert":
	{
	    require('../src/insert.php');
	}
	break;
    case "delete":
	{
	    require('../src/delete.php');
	}
	break;
    case "show":
	{
	    require('../src/show.php');
	}
	break;
    case "edit":
	{
	    require('../src/edit.php');
	}
	break;
    case "add":
	{
	    require('../src/add.php');
	}
	break;
    case "main":
	{
	    require('../src/main.php');
	}
	break;
    case "list":
	{
	    require('../src/list.php');
	}
	break;
    }
    exit(0);
}

?>

<html>
    <head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script >
    
document.addEventListener('DOMContentLoaded', function() {
    
    function makeNavCallback(to, postfix, onsuccess){//делает запрос на сервер и записывает в контент полученный результат 
	return function(){
	    content.innerHTML = "<img style=\"width:441px; margin:auto; display:block;\" src=\"li.gif\">";//загрузочка
	    var req = new XMLHttpRequest();
	    req.open('GET', to+postfix, true); 
	    req.onreadystatechange = function (aEvt) {
		if (req.readyState == 4) {
		    if(req.status == 200){
			content.innerHTML = req.responseText;
			onsuccess();
		    }
		    else{
			console.log("Error loading page\n");}
		}
	    };
	    req.send(null);
	}
    }

    function deleteAutoNoteRefresh(id){//делает запрос и после получения ответа переходит на страницу списка
	return function(){
	    content.innerHTML = "<img style=\"width:441px; margin:auto; display:block;\" src=\"li.gif\">";//загрузочка
	    var req = new XMLHttpRequest();
	    req.open('GET', 'index.php?api=delete&del='+id, true); 
	    req.onreadystatechange = function (aEvt) {
		if (req.readyState == 4) {
		    if(req.status == 200){
			window.location.search = 'page=list';
			//loadList();
		    }
		    else{
			console.log("Error loading page\n");}
		}
	    };
	    req.send(null);
	}
    }

    function insertButton(){//обработка кнопки для добавления нового элемента
	var req = new XMLHttpRequest();
	
	var addTitle = document.getElementById("addTitle");
	var addText = document.getElementById("addText");

	var title = addTitle.value;
	var text = addText.value;
	
	req.open('POST', 'index.php?api=insert', true);//делаем запрос на файл 
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//просигнализировали, что значения пришли из формы
	
	req.onload = function (aEvt) {
	    window.location.search = 'page=show&id='+req.responseText;//перешли на страницу детального просмтра после завершения запроса
	    //makeShowCallback(req.responseText)();
	};
	req.send("title="+encodeURIComponent(title)+"&text="+encodeURIComponent(text)); //отправили данные на сервер
    }

    function updateButton(){//аналогично, но для трех параметров
	var req = new XMLHttpRequest();
	
	var editTitle = document.getElementById("editTitle");
	var editText = document.getElementById("editText");
	var editId = document.getElementById("editId");

	var title = editTitle.value;
	var text = editText.value;
	var id = editId.value;
	
	req.open('POST', 'index.php?api=update', true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	req.onload = function (aEvt) {
	    window.location.search = 'page=show&id='+req.responseText;
	    //makeShowCallback(req.responseText)();
	};
	req.send("id="+encodeURIComponent(id)+"&title="+encodeURIComponent(title)+"&text="+encodeURIComponent(text));
    }
    
    function makeShowCallback(id){//переход на стр детального просмотра для канкретной записи
	return makeNavCallback('index.php', '?api=show&show='+id,
			       (function(idD){//передача нашего id кнопкам
				   return function(){
				       
				       var showEdit = document.getElementById('showEdit');
				       var showDelete = document.getElementById('showDelete');

				       showEdit.onclick =
					   makeNavCallback('edit', '?edit='+idD,
							   function(){
							       var editSubmit = document.getElementById('editSubmit');
							       editSubmit.onclick = updateButton;
							   });
				       showDelete.onclick = deleteAutoNoteRefresh(idD);
				   }})(id) );
    }
    

//обрабатываем внутренность страницы в зависимости от того, откуда мы пришли
    loadMain = makeNavCallback('index.php', '?api=main', function(){});//загружаем внуть станицы контента
    loadAdd = makeNavCallback('index.php', '?api=add', function(){
	var addSubmit = document.getElementById('addSubmit');
	addSubmit.onclick = insertButton;
    });
    loadList = makeNavCallback('index.php', '?api=list', function(){});
    

	//нашли на странице кнопки навигации и блок с контентом
    var menuList = document.getElementById('menuList');
    var menuAdd = document.getElementById('menuAdd');
    var menuMain = document.getElementById('menuMain');
    var content = document.getElementById('content');
    

//роутинг - в зависимости от ссылки меняем контент страницы
    var urlParams = new URLSearchParams(window.location.search);

    switch(urlParams.get("page")){
    case 'add':
	loadAdd();
	break;
    case 'list':
	loadList();
	break;
    case 'show':{
	makeShowCallback(urlParams.get("id"))();
	break;
    }
    case 'edit'://не вынесен в отдельную функцию
	makeNavCallback('index.php', '?api=edit&edit='+urlParams.get("id"),
			function(){
			    var editSubmit = document.getElementById('editSubmit');
			    editSubmit.onclick = updateButton;
			})();
	//makeShowCallback(urlParams.get("id"))();
	break;
    default:
	loadMain();
	break;
    }
    
}, false);
	</script>
    </head>


    <body>
	<div id="navbar" class="collapse navbar-collapse" style="padding-bottom: 50px;"><!--Менюшка -->
            <ul class="nav navbar-nav">
		<li><a href="index.php?page=main" id="menuMain">Main</a></li>
		<li><a href="index.php?page=list" id="menuList">List</a></li>
		<li><a href="index.php?page=add" id="menuAdd">Add</a></li>
            </ul>
        </div>
	
	<div id="content" style="width:800px; margin:auto;"> <!-- Блок с контентом -->
	    HERE is something;
	</div>
	<script>
	 
	 
	</script>
    </body>

</html>

