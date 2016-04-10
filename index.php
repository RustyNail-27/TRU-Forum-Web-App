<?php
	if (!isset($_SERVER['HTTPS'])) {
		$url = 'https://' . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];  // https and http_host
		header("Location: " . $url);  // should be before any output; location is changed to the new $url
		                              // with redirect status code
		exit;
	}

	require('TRUForum_module.php');  // Your module file
	
	/*
	session_start();
	if(isset($_SESSION["s_username"])) {
			include ('TRU_Forum_Start.php');
			echo "
        		<script>
            			page_main();		
       			 </script>
       		 ";
			include('TRU_Forum_Main.php');
			exit();
	}	
	*/
	
    if(empty($_POST['page'])) {
		$display_type = 'start';
        include ('TRU_Forum_Start.php');  // Start page
        exit();
    }
	
    
	if ($_POST['page'] == 'start')  // Start page
    {
        $command = $_POST['command'];
    
        switch($command) 
        {
        // The user sent 'SignIn' data.
        case 'signin':
            $username = $_POST['username'];
            $password = $_POST['password'];
            // if the username is valid
			if(validate($username,$password)) {
				session_start();
        		$_SESSION["s_username"] = $username;
				$_SESSION["s_password"] = $password;
				include('TRU_Forum_Main.php');  // Main page
				//print_r($_SESSION);
			}   
            else {
				$display_type = 'signin';  // In order to say 'need to display the sign in box
                $signin_error_message = "<span style='color:Red'>* Wrong username or password<br></span>";  // Signin error message
				include('TRU_Forum_Start.php'); //Re-display start page
			}
            exit();  // exit

        // The user sent 'Join' data
        case 'join':
			$username = $_POST['username'];
            $password = $_POST['password'];
			$email = $_POST['email'];
			
			if(availableName($username)) {
				addUser($username, $password, $email);
				$newName = $username;
				$display_type = 'signin';
				include('TRU_Forum_Start.php');  // Start page
            // For testing
             // for email
			}
			else {
				$display_type = 'join';
				$join_error_message = "<span style='color:Red'>* Username already in use<br></span>";  // Join error message
				include('TRU_Forum_Start.php'); //Re-display start page
			}
            
            exit();

        // The user sent 'ForgotPassword' data
        case 'forgotpassword':
            // Do some your works here, and
            include('TRU_Forum_Start.php');  // Start page
            exit();
        		
        default:
            echo 'Unknown command<br>';
            exit();
        }
    }
    
	else
	{	
        $command = $_POST['command'];
        
        switch($command) 
        {
        	
        	case 'post':
        		include('TRU_Forum_Main.php');
        		inputQuestion();
        		exit();
        	
        	case 'submitpost':
        		session_start();
        		$username = $_SESSION["s_username"];	
        		$question = $_POST['q_text'];
        		addQuestion($username, $question);
        		include('TRU_Forum_Main.php');
        		echo "Your Question Has Been Posted" . "<br>";
        		exit();
        		
        	case 'submitanswer':
        		session_start();
        		$username = $_SESSION["s_username"];
        		$answer = $_POST['a_text'];
        		$q_id = $_POST['q_id'];
        		include('TRU_Forum_Main.php');
        		addAnswer($username,$answer,$q_id);
        		echo "Your Answer Has Been Posted" . "<br>";
        		exit();
        		
        	case 'displayanswers':
        		$q_id = $_POST['q_id'];
        		include('TRU_Forum_Main.php');
        		displayAnswers($q_id);
        		exit();
        		
        	case 'search':
        		include('TRU_Forum_Main.php');
        		searchQs();
        		exit();
        		
        	case 'displayanswers':
        		include('TRU_Forum_Main.php');
        		
        	case 'searchquestions':
        		$keywords = $_POST['search_text'];
        		include('TRU_Forum_Main.php');
        		searchKeywords($keywords);
        		exit();
        		
        	case 'listmine':
				session_start();
       			$username = $_SESSION["s_username"];
        		include('TRU_Forum_Main.php');
        		listMine($username);
        		exit();
        		
        	case 'list10':
        		include('TRU_Forum_Main.php');
        		recentTen();
        		exit();
        	
        	case 'signout':
        		signOut();
        		exit();
        		
        	default:
            	echo 'Unknown command<br>';
            	exit();
        }
    
	}  
	/*
	else {
		 echo 'Unknown page<br>';
    }
    */
?>

	