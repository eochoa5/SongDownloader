<!DOCTYPE html>
<html>
<head>
    <title>Song Downloader</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
<style>

#container{
width: 70%;
margin:0 auto;
text-align:center;

}
#input{
width: 100%; 
height:40px;
}
#results {
margin-top:5%;
text-align:left;
width: 100%;
word-wrap:break-word;
}

	</style>
	<script>
function search(y){ 
		if(y.length ===0){return;}
		$('#results').html('<h3 style="color:red">Searching...</h3>');
		var x = y;
		$('#input').val('');
		
		var req = new XMLHttpRequest();
		req.open("POST", "server.php", true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.onreadystatechange = function() {
			if(req.readyState == 4 && req.status == 200) {
				$('#results').html('<h3><u>Showing 4 most popular results:</u></h3>');
				
				var myarray = req.responseText.split("|");
				for(i=0; i<myarray.length; i++){
					var array2 = myarray[i].split('^');
					var content = '';
					for(j=0; j<array2.length-1; j++){
						if(j != 2)
						content += '<p>'+ array2[j]+ '</p>';
						else
							content += '<p><a href="http://www.youtubeinmp3.com/fetch/?video='+array2[j]+'"><button class="btn btn-warning">Download</button></a></p>';
							
						
					}
					$('#results').append('<div class="well">'+content+'</div>');
						
				}
				
			}
		}
	
		req.send("query="+x); 					
	}

	</script>
	
</head>
<body> 
<div id="container">
<label style="margin-top: 4%;">Enter the name of the song you want to download </label>
<input type="text" class="form-control" placeholder="Enter song name" id="input"/><br>
<button class="btn btn-primary" style="width: 100%; height:40px;" onclick="search($('#input').val())">Search</button>
<br>
<div id="results"></div>

</div>

</body>
    
</html>
