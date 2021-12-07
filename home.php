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

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>Home</title>
</head>
<body class="appBackground">

<div id="mySidebar" class="sidebar" >
   <div class="sidebar-logo">Logo</div>
  <a href="home.php"><i class="material-icons">home</i><span class="icon-text">Home</span></a><br>
  <a href="date.html"><i class="material-icons">assignment_ind</i><span class="icon-text"></span>Date personale</a></span>
  </a><br>
  <a href="discipline.html"><i class="material-icons">source</i><span class="icon-text"></span>Discipline</span></a><br>
  <a href="login.php" style="position: fixed; bottom: 0;"><i class="material-icons">logout</i><span class="icon-text">Iesire</span></a>
</div>



<div class="container" id="main"  style="margin-top: 10px">
    <h2>Ce oferim</h2>
    <div id="myCarousel" class="carousel slide " data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner ">
            <div class="item active">
                <img src="grade.jpg" alt="Note" style="width:100%;">
                <div class="carousel-caption" style="color:black">
                    <h3>Afisarea notelor</h3>
                    <p>Urmăresteți notele cu usurință!</p>
                </div>
            </div>

            <div class="item">
                <img src="finance.jpg" alt="Financiar" style="width:100%;">
                <div class="carousel-caption" style="color:black">
                    <h3 >Financiar</h3>
                    <p>Rezolvă orice plată în doar câțiva pasi!</p>
                </div>
            </div>

            <div class="item">
                <img src="studies.jpg" alt="Studii" style="width:100%;">
                <div class="carousel-caption" style="color:black">
                    <h3 >Studii</h3>
                    <p>Vezi ce cursuri oferă facultatea ta</p>
                </div>
            </div>

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

</body>
</html>