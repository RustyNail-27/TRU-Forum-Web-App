<?php
	$conn = mysqli_connect('localhost', 'rwalton3540', 'RustyNail-27', 'COMP3540W16_rwalton');  // not 'cs.tru.ca'

    				
    $displayButton = " <form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='displayanswers' required></input> ".
						"<input type='submit' value='Display Answers'></input>" . 
						"</form>" . 
    				"</div>";
	
    if (mysqli_connect_errno()) {
        echo "Failed to connect to DB: " . mysqli_connect_error();
        exit;
    }

    function validate($username, $password) {
         global $conn;  // inorder to access to global variables
        
		$hashed_password = sha1($password);	// Obtain the hashed password using sha1() that uses the SHA1 hash function.
        // select user information with $username and $password
        $sql = "SELECT *
				FROM users
                WHERE password = '$hashed_password' AND username = '$username'";  //the values for the two columns are strings.
                
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) >= 1)  // if the number of rows is >= 1
            return true;
        else
            return false;
    }
	
	function availableName($username) {
         global $conn;  // inorder to access to global variables
        
        // select user information with $username and $password
        $sql = "SELECT *
				FROM users
                WHERE username = '$username'";  // You've got to remember the values for the two columns are strings.
                
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) >= 1)  // if the number of rows is >= 1
            return false;
        else
            return true;
    }
	
	function addUser($username, $password, $email) {
         global $conn;  
        
		$hashed_password = sha1($password);	
		
        // insert user information with $username, $password, $email
        $sql = "INSERT INTO `users`(`username`, `password`, `full_name`, `email_address`) 
				VALUES ('$username','$hashed_password', '', '$email')"; 
				
		mysqli_query($conn, $sql);
                
        return;
	}
	
	function addQuestion($username, $question) {
         global $conn;  
			
		$sql = "INSERT INTO `questions`(`username`, `question`) 
				VALUES ('$username','$question')"; 
				
		mysqli_query($conn, $sql);
                
        return;
	}
	
	function addAnswer($username, $answer, $q_id) {
         global $conn;  // inorder to access to global variables
		
		$sql = "INSERT INTO answer(username, answer, question_id) 
				VALUES ('$username','$answer', '$q_id')"; 
				
		mysqli_query($conn, $sql);
                
        return;
	}
	
	function searchKeywords($keywords) {
		global $conn;
		global $answerInput;
		
		$keywordList = (explode(" ",$keywords));
		$keyListIndexed = array_values($keywordList);
		
		$keywordNum = count($keywordList);
		$i = 0;
		
		while($i < $keywordNum) {
			$singleKeyword = $keyListIndexed[$i];
			
			$sql = "SELECT question, question_id
				FROM questions
                WHERE question LIKE '%$singleKeyword%'";
				
			$result = mysqli_query($conn, $sql);
			
            while($row = $result->fetch_assoc()){
   				echo $row['question'] . '<br />';
   				$currentQid = $row['question_id'];

   				$answerInput = "<form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='submitanswer' required></input> ".
							"<input type='hidden' name='q_id' value=" . "$currentQid"."></input> " .
							"<textarea id='a_text' name='a_text' placeholder='Enter your answer' required></textarea> <br>".
						"<input type='submit' value='Post an Answer'></input>" . 
						"</form>" . 
    				"</div>";
    				
   				echo $answerInput;
   				
   				$displayAnswer = "<form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='displayanswers' required></input> ".
							"<input type='hidden' name='q_id' value=" . "$currentQid"."></input> " .
						"<input type='submit' value='Display Answers'></input>" . 
						"</form>" . 
    				"</div>";
    				
   				echo $displayAnswer . "<br>";
			}	
			$i++;
		}
	
		return;
	}
	
	function recentTen() {
		global $conn;

		
		$sql = "SELECT question, question_id
				FROM questions
                order by question_id desc limit 10";
                
		$result = mysqli_query($conn, $sql);
		/*
		if (mysqli_num_rows($result) >= 1)  // if the number of rows is >= 1
            echo "true";
        else
            echo "false";
		*/
		echo "<h3>The 10 Most Recent Questions</h3>" . "<br>";

		while($row = $result->fetch_assoc()){
   			echo $row['question'] . '<br />';
   			$currentQid = $row['question_id'];

   				$answerInput = "<form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='submitanswer' required></input> ".
							"<input type='hidden' name='q_id' value=" . "$currentQid"."></input> " .
							"<textarea id='a_text' name='a_text' placeholder='Enter your answer' required></textarea> <br>".
						"<input type='submit' value='Post an Answer'></input>" . 
						"</form>" . 
    				"</div>";
    				
   			echo $answerInput;
   			
   			$displayAnswer = "<form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='displayanswers' required></input> ".
							"<input type='hidden' name='q_id' value=" . "$currentQid"."></input> " .
						"<input type='submit' value='Display Answers'></input>" . 
						"</form>" . 
    				"</div>";
    				
   			echo $displayAnswer . "<br>";
		}		
		return;
	}
	
	function listMine($username) {
		global $conn;
		global $answerInput;
        
		$sql = "SELECT question, question_id
				FROM questions
               	WHERE username = '$username'
               	order by question_id desc";
				
		$result = mysqli_query($conn, $sql);
		
		echo "<h3>The Questions You've Posted</h3>" . "<br>";

		while($row = $result->fetch_assoc()){
   			echo $row['question'] . '<br />';
   			$currentQid = $row['question_id'];

   				$answerInput = "<form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='submitanswer' required></input> ".
							"<input type='hidden' name='q_id' value=" . "$currentQid"."></input> " .
							"<textarea id='a_text' name='a_text' placeholder='Enter your answer' required></textarea> <br>".
						"<input type='submit' value='Post an Answer'></input>" . 
						"</form>" . 
    				"</div>";
    				
   			echo $answerInput;
   			
   			$displayAnswer = "<form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='displayanswers' required></input> ".
							"<input type='hidden' name='q_id' value=" . "$currentQid"."></input> " .
						"<input type='submit' value='Display Answers'></input>" . 
						"</form>" . 
    				"</div>";
    				
   			echo $displayAnswer . "<br>";
		}
		return;
	}
	
	function displayAnswers($q_id) {
		global $conn;

		$sql = "SELECT question, username
				FROM questions
                WHERE question_id = '$q_id'";
                
        $result = mysqli_query($conn, $sql);
        
        echo "<h4>Question: </h4>";
        
        while($row = $result->fetch_assoc()){
        	echo $row['username'] . ' asked:'. '<br />';
   			echo $row['question'] . '<br />';
        }
		
		$sql = "SELECT answer, username
				FROM answer
                WHERE question_id = '$q_id'";
                
		$result = mysqli_query($conn, $sql);
		
	 echo "<h4>Answers: </h4>";
		
		while($row = $result->fetch_assoc()){
			echo $row['username'] . ' replied:'.'<br />';
   			echo $row['answer'] . '<br /><br />';
   		}
	}
	
	function searchQs() {
  		echo 	"<div><h3>Search Questions</h3>" .
  						"<form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='searchquestions' required></input> ".
							"<textarea id='search_text' name='search_text' placeholder='Enter keywords for your search' required></textarea> <br>".
						"<input type='submit' value='Search'></input>" . 
						"</form>" . 
    				"</div>";	
	}
	
	function inputQuestion() {
		echo 
        			"<div><h3>Post New Question</h3>" .
  						"<form method='post' action='index.php'>" .
  							"<input type='hidden' name='page' value='main' required></input> ".
							"<input type='hidden' name='command' value='submitpost' required></input> ".
							"<textarea id='q_text' name='q_text' placeholder='Enter your question' required></textarea> <br>".
						"<input type='submit' value='Post'></input>" . 
						"</form>" . 
    				"</div>";
	}
	
	function signOut() {
			session_start();
        	session_unset(); 
			session_destroy();
        	include('TRU_Forum_Start.php');
	}
	
	
?>