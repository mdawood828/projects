<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	session_start();
    if($_SESSION["email"]==null)
        {
        header("location:http://localhost/GIL/login.php");    
        }
?>
<div class="container">
  <ul class="nav nav-tabs">
    <li><a href="http://localhost/GIL/add_employee.php">Add Employee</a></li>
    <li><a href="http://localhost/GIL/employee_details.php">Employee Details</a></li>
    <li><a href="http://localhost/GIL/add_designation.php">Add Designation</a></li>
    <li><button class="btn btn-primary btn-sm" onclick="get_salary()">Salary</button></li>
    <form method="post" action="">
  <button type="submit" name="log_out" class="btn btn-danger" style="margin-top: 1%;">Log Out</button>
  </form> 
  </ul> 
</div>
<?php
	if(isset($_POST["log_out"]))
        {
            session_destroy();
            header("location:http://localhost/GIL/login.php");
        }
?>
<p id="sl">...</p>
</body>
<script>
function get_salary()
    {
        var=a;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("sl").innerHTML=this.responseText; 
    }
    };
    xmlhttp.open("POST", "js_queries.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("salary=" + a);
    } 
    }
</script>
</html>
