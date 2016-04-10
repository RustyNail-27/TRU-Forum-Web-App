<!DOCTYPE html>
<HTML>
   <HEAD>
      <TITLE>
         TRU Forum Main Page
      </TITLE>
      <style>
      	body {
			margin: 0px; /*removes margin around body */
		}
      	.nav_item {
      		display: block;
      		background-color: #f9f9f9;
			min-width: 75px;
			padding: 12px 16px;
			margin: 12px;
      	}
      	
      	.nav_item:hover {
      		color:LightSkyBlue;
      	}
      
      	#main_nav {
      		float: left;
      		
      	}
      	
      	#page_top {
			background-color: LightSkyBlue;
			height: 100px;
			width: 100%;
			border: 1px solid black;	
		}
		
		#main_iframe {
			width: 80%; 
			height: 500px;
		}
		
      	.submit {
      		background:none;
  			border:none;
  			font-size:1em;
  			color:black;
  			font-family:serif;
		}
		
		.submit:hover {
			color:LightSkyBlue;
      	}
      	
      	#q_text {
      			width: 500px;
      			height: 150px;
      	}
      	
      	#a_text {
      			width: 200px;
      			height: 20px;
      	}
      	#search_text {
      			width: 200px;
      			height: 15px;
      	}
      </style>
     
      
   </HEAD>
<BODY>
	<div id='page_top'>
  		<h1 style='text-align: center'>TRU Forum Main Page</h1>
    </div>

<ul id='main_nav'>
  	<li id='post' class='nav_item'>
  		<form method='post' action='index.php'>
			<input type='hidden' name='page' value='main' required></input>
			<input type='hidden' name='command' value='post' required></input>
			<input id='lpost_submit' class='submit' type='submit' value='Post'></input>
		</form>
  	</li>
	<li id='list10' class='nav_item'>
		<form method='post' action='index.php'>
			<input type='hidden' name='page' value='main' required></input>
			<input type='hidden' name='command' value='list10' required></input>
			<input id='list10_submit' class='submit' type='submit' value='List 10'></input>
		</form></li>
	<li id='list_mine' class='nav_item'>
		<form method='post' action='index.php'>
			<input type='hidden' name='page' value='main' required></input>
			<input type='hidden' name='command' value='listmine' required></input>
			<input id='listmine_submit' class='submit' type='submit' value='List Mine'></input></li>
		</form></li>
	<li id='search' class='nav_item'>
		<form method='post' action='index.php'>
			<input type='hidden' name='page' value='main' required></input>
			<input type='hidden' name='command' value='search' required></input>
			<input id='search_submit' class='submit' type='submit' value='Search'></input></li>
		</form></li>
	<li id='sign_out' class='nav_item'>
		<form method='post' action='index.php'>
			<input type='hidden' name='page' value='main' required></input>
			<input type='hidden' name='command' value='signout' required></input>
			<input id='signout_submit' class='submit' type='submit' value='Sign Out'></input></li>
		</form></li>
</ul>


</BODY>
 <script>
 		var count = 0;
 		window.addEventListener('load', function() {
 			setInterval(function() {
 				count++;
 				if(count >= 300)
 					sign_out();
 			}, 1000);
 			document.addEventListener('mousemove', function() {
 				count = 0;
 			});
 			document.addEventListener('keydown', function() {
 				count = 0;
 			});
      	});
      	
      	function sign_out() {
      		var form = document.createElement('FORM');
      		form.method = 'post';
      		form.action = 'index.php';
      		var input1 = document.createElement('INPUT');
      		input1.type = 'text';
      		input1.name = 'page';
      		input1.value = 'main';
      		form.appendChild(input1);
      		var input2 = document.createElement('INPUT');
      		input1.type = 'text';
      		input1.name = 'command';
      		input1.value = 'signout';
      		form.appendChild(input2);
      		form.submit();
      	}
      	
      	function page_main() {
      		var form = document.createElement('FORM');
      		form.method = 'post';
      		form.action = 'index.php';
      		var input1 = document.createElement('INPUT');
      		input1.type = 'hidden';
      		input1.name = 'page';
      		input1.value = 'main';
      		form.appendChild(input1);
      		var input2 = document.createElement('INPUT');
      		input1.type = 'hidden';
      		input1.name = 'command';
      		input1.value = 'test';
      		form.appendChild(input2);
      		form.submit();
      	}
      		     
</script>
</HTML>