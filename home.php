<?php
	session_start();
	if (!isset($_SESSION["userid"])) {
		header("Location: login.php");
	}
	include_once 'includes/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          <link rel="stylesheet" type="text/css" href="table.css">
          <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>Home</title>
</head>
<body class="appBackground">

<div id="mySidebar" class="sidebar" >
    <div class="sidebar-logo"><img src="student.png" alt="logo" width="100%"/></div>
    <a href="home.php"><i class="material-icons">home</i><span class="icon-text">Home</span></a><br>
    <a href="date.html"><i class="material-icons">assignment_ind</i><span class="icon-text">Date personale</span></a><br>
    <a href="discipline.html"><i class="material-icons">source</i><span class="icon-text">Discipline</span></a><br>
    <a href="login.php" style="position: fixed; bottom: 0;"><i class="material-icons">logout</i><span class="icon-text">Iesire</span></a>
</div>


<div  id="main" >
    <div class="container-fluid" style="margin-top: 10px">

    </div>
</div>

</body>
</html>