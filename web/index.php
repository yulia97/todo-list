<html>
    <head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script >
	 
	 document.addEventListener('DOMContentLoaded', function() {

	     function makeNavCallback(to, postfix, onsuccess){
		 return function(){
		     content.innerHTML = "<img style=\"width:441px; margin:auto; display:block;\" src=\"li.gif\">";
		     var req = new XMLHttpRequest();
		     req.open('GET', to+'.php'+postfix, true); 
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

	     function deleteAutoNoteRefresh(id){
		 return function(){
		     content.innerHTML = "<img style=\"width:441px; margin:auto; display:block;\" src=\"li.gif\">";
		     var req = new XMLHttpRequest();
		     req.open('GET', 'delete.php?del='+id, true); 
		     req.onreadystatechange = function (aEvt) {
			 if (req.readyState == 4) {
			     if(req.status == 200){
				 loadList();
			     }
			     else{
				 console.log("Error loading page\n");}
			 }
		     };
		     req.send(null);
		 }
	     }

	     function insertButton(){
		 var req = new XMLHttpRequest();
		 
		 var addTitle = document.getElementById("addTitle");
		 var addText = document.getElementById("addText");

		 var title = addTitle.value;
		 var text = addText.value;
		 
		 req.open('POST', 'insert.php', true);
		 req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		 
		 req.onload = function (aEvt) {
		     makeShowCallback(req.responseText)();
		 };
		 req.send("title="+encodeURIComponent(title)+"&text="+encodeURIComponent(text));
	     }

	     function updateButton(){
		 var req = new XMLHttpRequest();
		 
		 var editTitle = document.getElementById("editTitle");
		 var editText = document.getElementById("editText");
		 var editId = document.getElementById("editId");

		 var title = editTitle.value;
		 var text = editText.value;
		 var id = editId.value;
		 
		 req.open('POST', 'update.php', true);
		 req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		 
		 req.onload = function (aEvt) {
		     makeShowCallback(req.responseText)();
		 };
		 req.send("id="+encodeURIComponent(id)+"&title="+encodeURIComponent(title)+"&text="+encodeURIComponent(text));
	     }
	     
	     function makeShowCallback(id){
		 return makeNavCallback('show', '?show='+id,
					(function(idD){
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
	     
	     loadMain = makeNavCallback('main', '', function(){});
	     loadAdd = makeNavCallback('add', '', function(){
		 var addSubmit = document.getElementById('addSubmit');
		 addSubmit.onclick = insertButton;
	     });
	     loadList = makeNavCallback('list', '', function(){
		 var listOfLinks = document.getElementById('listOfLinks');
		 for (var i = 0 ; i < listOfLinks.children.length; i++){
		     var id = /#(\d+)/.exec(listOfLinks.children[i].href)[1];
		     listOfLinks.children[i].onclick = makeShowCallback(id);
		 }
		 console.log("listOfLinks",listOfLinks);

	     });

	     
	     var menuList = document.getElementById('menuList');
	     var menuAdd = document.getElementById('menuAdd');
	     var menuMain = document.getElementById('menuMain');
	     var content = document.getElementById('content');
	     
	     menuList.onclick = loadList;
	     menuAdd.onclick = loadAdd;
	     menuMain.onclick = loadMain;

	     loadMain();
	     

	 }, false);
	</script>
    </head>


    <body>
	<div id="navbar" class="collapse navbar-collapse" style="padding-bottom: 50px;">
            <ul class="nav navbar-nav">
		<li><a href="#" id="menuMain">Main</a></li>
		<li><a href="#" id="menuList">List</a></li>
		<li><a href="#" id="menuAdd">Add</a></li>
            </ul>
        </div>
	
	<div id="content" style="width:800px; margin:auto;">
	    HERE is something;
	</div>
	<script>
	 
	 
	</script>
    </body>

</html>
