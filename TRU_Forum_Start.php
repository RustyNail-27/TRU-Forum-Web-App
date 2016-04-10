<!DOCTYPE html>

<html>
<head>
    <title>TRU Forum Start</title>
    
    <style>
		body {
			margin: 0px; /*removes margin around body */
		}
	
		#date {
			float: left;
			display: block;
		}
		
		#menu {
			float: right;
			display: block;
		}
		
		#dropdown-content {
			float: right;
			clear: right;
			box-shadow: 0px 10px 16px 0px rgba(0,0,0,0.4); /* drops a shadow to enforce the visual of dropdown appearing overtop */
			z-index: 1; 
			list-style-type: none;
			background-color: black;
			display: none;
		}
		
		#dropdown-content ul {
			list-style-type: none;
			padding: 0;
		}
		
		#dropdown-content li{
			background-color: #f9f9f9;
			min-width: 160px;
			padding: 12px 16px;
			margin: 12px;
		}
		
		#dropdown-content li:hover {
			color:LightSkyBlue;
		}
		
		#page_top {
			position: fixed;
			background-color: LightSkyBlue;
			height: 100px;
			width: 100%;
			border: 1px solid black;
			z-index: -2;
			}
			
		#page_bottom {
			background-color: LightSkyBlue;
			height: 50px;
			border: 1px solid black;
			position: fixed;
			bottom: 0;
			width: 100%;
			z-index: -3;
			}
			
		#page_bottom a {
			color: black;
			text-decoration: none;
			display: block;
			text-align: center;
			position: relative;
			top: 18px;
		}
	
		#page_bottom a:hover {
			color: blue;
		}
		
        #outer_box {
            position: absolute; top: 100px; left: 0px;  /* 100px below the heading */
            display: table; 
            width: calc(100% - 2px); 
			height: calc(100% - 150px);  /* calc(): CSS function for simple arithmetic operations */
            border: 1px solid black;
			background-color: White;
			z-index: -4;
        }
        #inner_box {
            display: table-cell; 
            vertical-align: middle;
        }
        .hcenter {
            margin: auto;
        }
		
		#sign_in_box {
			display: none;
			position: fixed;
			top:calc(50% - 100px);
			left:calc(50% - 150px);
			height: 200px; 
			width:300px;
			border: 1px solid black;
			background-color: #e6e6e6;
			z-index: 30;
		}
		
		#join_box {
			display: none;
			position: fixed;
			top:calc(50% - 100px);
			left:calc(50% - 150px);
			height: 200px; 
			width:300px;
			border: 1px solid black;
			background-color: #e6e6e6;
			z-index: 30;
		}
		
		#forgot_box {
			display: none;
			position: fixed;
			top:calc(50% - 60px);
			left:calc(50% - 150px);
			height: 120px; 
			width:300px;
			border: 1px solid black;
			background-color: #e6e6e6;
			z-index: 30;
		}
		
		#blanket {
			width:100%;
			height:100%;
			position: fixed;
			top: 0px;
			left: 0px;
			opacity: 0.7;
			z-index: -1;
			background-color: gray;
			display: none;
		}
		
		.cancel {
			position: absolute;
			bottom: 0px;
			left: 0px;
		}
		
		.submit {
			position: absolute;
			bottom: 0px;
			right: 0px;
		}
		
		.input {
			 border:none;
		}

    </style>
   <script>
        window.addEventListener('load', function() {
            document.getElementById('sign_in').addEventListener('click', displaySignIn);
            <?php
                // In this case, you need to show the signin box.
                if($display_type == 'signin')
					echo 'displaySignIn()';
				else if($display_type == 'join')
					echo 'displayJoin()';
            ?>
        });
		window.addEventListener('load', function() {
			document.getElementById("username").value = "<?php echo $newName; ?>";
		});
	</script>
</head>

<body>
	<div id='blanket' style="display: none;">
	</div>

	<div id='page_top'>
		<p id='date'></p>
		<img id='menu' src="menu_symbol.jpg" alt="Menu" style="width:50px;height:50px;">
		<div id='dropdown-content' style="display: none;">
			<ul>
					<li id='sign_in'>Sign In</li>
					<li id='join'>Join</li>
					<li id='forgot_password'>Forgot Password</li>
			</ul>
		</div>
		<h1 style='text-align: center'>TRU Forum</h1>
    </div>
	
	
    <div id='outer_box'>
		<div id='inner_box'>
			
			<p id='direction' class='hcenter' style='height: 20px; width:400px; background-color:Yellow; text-align: center; border:1px solid black'>
			</p>
			
		</div>
    </div>
	
	<div id='sign_in_box' class='hcenter' style="display: none;">
		<h2 style='text-align: center'>Sign In</h2>
			<form method='post' action='index.php'>
					<input type='hidden' name='page' value='start' required></input>
					<input type='hidden' name='command' value='signin' required></input>
					Username: <input id='username' class='input' type='text' name='username' placeholder='Enter username' autocomplete="on" required></input><br>
					Password: <input id='password' class='input' type='password' name='password' placeholder='Enter password' autocomplete="on" required></input><br>
					<?php echo $signin_error_message; ?>
					<input id='signin_cancel' class='cancel' type='button' value='Cancel'></input>
					<input class='submit' type='submit' value='Sign In'></input>
					
			</form>	
	</div>
	
	<div id='join_box'class='hcenter' style="display: none;">
		<h2 style='text-align: center'>Join</h2>
		<form method='post' action='index.php'>
			<input type='hidden' name='page' value='start' required></input>
			<input type='hidden' name='command' value='join' required></input>
			Username: <input id='username' class='input' type='text' name='username' placeholder='Enter username' autocomplete="on" required></input><br>
			Password: <input id='password' class='input' type='password' name='password' placeholder='Enter password' autocomplete="on" required></input><br>
			Email: <input id='email' class='input' type='email' name='email' placeholder='Enter email address' required></input><br>
			<?php echo $join_error_message; ?>
			<input id='join_cancel' class='cancel' type='button' value='Cancel'></input>
			<input class='submit' type='submit' value='Join'></input>
		</form>
	</div>
	
	<div id='forgot_box' class='hcenter' style="display: none;">
		<h2 style='text-align: center'>Forgot Password</h2>
		<form method='post' action='index.php'>
			<input type='hidden' name='page' value='start' required></input>
			<input type='hidden' name='command' value='forgotpassword' required></input>
			Username: <input id='username' class='input' type='text' name='username' placeholder='Enter username' autocomplete="on" required></input><br>
			<input id='forgot_cancel' class='cancel' type='button' value='Cancel'></input>
			<input class='submit' type='submit' value='Submit'></input>			
		</form>
	</div>
	
	<div id='page_bottom'>
		<a href="http://cs.tru.ca/">About Us</a>
	</div>
	
</body>

<script>
		window.addEventListener('load', function(e) {
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1;

			var yyyy = today.getFullYear();
			if(dd<10){
				dd='0'+dd
			} 
			if(mm<10){
				mm='0'+mm
			} 
			var today = dd+'/'+mm+'/'+yyyy;
			
           document.getElementById('date').innerHTML = today;
        });
		
		document.getElementById('menu').addEventListener('click',displayMenu);
		document.getElementById('dropdown-content').addEventListener('click',displayMenu);
		
		function displayMenu() {
				if(document.getElementById('dropdown-content').style.display == "none")
				document.getElementById('dropdown-content').style.display = "block";
			else
				document.getElementById('dropdown-content').style.display = "none";
        }
		
		
		
		document.getElementById('blanket').addEventListener('click',displayBlanket);
		
		function displayBlanket() {
			if(document.getElementById('blanket').style.display == "none")
			{
				document.getElementById('blanket').style.display = "block";
			}
			else
			{
				document.getElementById('blanket').style.display = "none";
				hideSignIn();
				hideJoin();
				hideForgot();
			}
				
        }
		
		
		document.getElementById('sign_in').addEventListener('click',displaySignIn);
		
		function displaySignIn() {
			document.getElementById('sign_in_box').style.display = "block";
			displayBlanket();
        }
		
		function hideSignIn() {
			document.getElementById('sign_in_box').style.display = "none";
        }
		
		
		
		
		document.getElementById('join').addEventListener('click',displayJoin);
		
		function displayJoin() {
			document.getElementById('join_box').style.display = "block";
			displayBlanket();
		}
		
		function hideJoin() {
			document.getElementById('join_box').style.display = "none";
		}
		
		
		
		
		document.getElementById('forgot_password').addEventListener('click',displayForgot);
		
		function displayForgot() {
			document.getElementById('forgot_box').style.display = "block";
			displayBlanket();
		}
		
		function hideForgot() {
			document.getElementById('forgot_box').style.display = "none";
		}
		
		
		
		
		
		document.getElementById('signin_cancel').addEventListener('click',signInCancel);
		
		function signInCancel() {
			displayBlanket();
			document.getElementById('signin_password').value = '';
			document.getElementById('signin_username').value = '';
		}
		
		
		
		document.getElementById('join_cancel').addEventListener('click',joinCancel);
		
		function joinCancel() {
			displayBlanket();
			document.getElementById('join_password').value = '';
			document.getElementById('join_username').value = '';
			document.getElementById('join_email').value = '';
		}
		
		
		
		document.getElementById('forgot_cancel').addEventListener('click',forgotCancel);
		
		function forgotCancel() {
			displayBlanket();
			document.getElementById('forgot_username').value = '';
		}
		
		
		
        var x0, y0;
        var direction = "not determined yet";
        
        window.addEventListener('load', function(e) {
            x0 = window.innerWidth / 2;
            y0 = (window.innerHeight - 100) / 2 + 100;
            
            displayDirectionToMouse();
        });
        
        // For 'resize'
        window.addEventListener("resize", function(e) {
            x0 = window.innerWidth / 2;
            y0 = (window.innerHeight - 100) / 2 + 100;
        });
		

        // For 'mousemove'
        document.addEventListener("mousemove", function(e) {
            var x = e.clientX;
            var y = e.clientY;
            var angle;
         
			 
            // Upper and right
            if (x >= x0 && y <= y0) {
                angle = Math.atan((y0 - y) / (x - x0));
                if (angle >= (Math.PI / 2) * (5 / 6))
                    direction = "12 o'clock";
                else if (angle < (Math.PI / 2) * (5 / 6) && angle >= (Math.PI / 2) * (3 / 6))
                    direction = "1 o'clock";
                else if (angle < (Math.PI / 2) * (3 / 6) && angle >= (Math.PI / 2) * (1 / 6))
                    direction = "2 o'clock";
                else
                    direction = "3 o'clock";
            }
            
            // Upper and left
            else if (x < x0 && y <= y0) {
                angle = Math.atan((y - y0) / (x - x0));
                if (angle >= (Math.PI / 2) * (5 / 6))
                    direction = "12 o'clock";
                else if (angle < (Math.PI / 2) * (5 / 6) && angle >= (Math.PI / 2) * (3 / 6))
                    direction = "11 o'clock";
                else if (angle < (Math.PI / 2) * (3 / 6) && angle >= (Math.PI / 2) * (1 / 6))
                    direction = "10 o'clock";
                else
                    direction = "9 o'clock";
            }
           
            // Lower and left
            else if (x < x0 && y > y0) {
                angle = Math.atan((y0 - y) / (x - x0));
                if (angle >= (Math.PI / 2) * (5 / 6))
                    direction = "6 o'clock";
                else if (angle < (Math.PI / 2) * (5 / 6) && angle >= (Math.PI / 2) * (3 / 6))
                    direction = "7 o'clock";
                else if (angle < (Math.PI / 2) * (3 / 6) && angle >= (Math.PI / 2) * (1 / 6))
                    direction = "8 o'clock";
                else
                    direction = "9 o'clock";
            }
            
            // Lower and right
            else {
                angle = Math.atan((y - y0) / (x - x0));
                if (angle >= (Math.PI / 2) * (5 / 6))
                    direction = "6 o'clock";
                else if (angle < (Math.PI / 2) * (5 / 6) && angle >= (Math.PI / 2) * (3 / 6))
                    direction = "5 o'clock";
                else if (angle < (Math.PI / 2) * (3 / 6) && angle >= (Math.PI / 2) * (1 / 6))
                    direction = "4 o'clock";
                else
                    direction = "3 o'clock";
            }
           

           displayDirectionToMouse();
		   
        });
        
        function displayDirectionToMouse() {
            document.getElementById('direction').innerHTML = 'The direction to Mouse Pointer is ' + direction + '.';
        }
	
	
		function page_main() {
      		var form = document.createElement('FORM');
      		form.method = 'post';
      		form.action = 'index.php';
      		var input1 = document.createElement('INPUT');
      		input1.type = 'text';
      		input1.name = 'page';
      		input1.value = 'main';
      		form.appendChild(input1);
      		/*
      		var input2 = document.createElement('INPUT');
      		input1.type = 'text';
      		input1.name = 'command';
      		input1.value = 'signout';
      		form.appendChild(input2);
      		*/
      		form.submit();
      	}
    </script>
</html>
