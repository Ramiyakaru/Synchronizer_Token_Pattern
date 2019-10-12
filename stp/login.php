<!DOCTYPE html>
<html lang="en">
<head>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<title>Cross Site Request Forgery Protection</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body background="css/images/back.jpg">
	<h2 style="font-family:Calibri;" class="heading">Welcome</h2>
<?php	

				//start session in  browser
				session_start();

				//Setting and storing session ID
				$sessionID = session_id();

				//Terminate cookie after 1 hour
				setcookie("session_id",$sessionID,time()+3600,"/","localhost",false,true);

				echo'<script>
					var csrf_token;

						function loadDOC(method,url,htmlTag)
						{
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function()
						{
							if(this.readyState==4 && this.status==200)
						{
							console.log("CSRF token scuessfully fetched : "+this.responseText);
							document.getElementById(htmlTag).value = this.responseText;
						}
						};
							xhttp.open(method,url,true);
							xhttp.send();
						}
					</script>';

				echo '
                    <div class="container">
                    <form  method="POST" action="server.php">
					<div class="form-input">
                        <label class="uname">Username:</label>  
                        <input class="w3-input w3-border" type="text" name="user_name"  placeholder="your name" style="width:300px;" autocomplete="off">
                        </div><br>
                        <input type="submit" name="submit" class="login_btn" value="Login"/>


					<div class="spacing"><input type="hidden" id="csToken" name="CSR"/></div>
				</form>';


					//if(isset($_COOKIE['session_id']))
					//{
						echo '<script> var token = loadDOC("POST","server.php","csToken");  </script>';
					//}
?>
</body>
</html>
