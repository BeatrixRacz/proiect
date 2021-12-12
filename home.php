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
          <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
          <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="num.js"></script>
          <link rel="stylesheet" type="text/css" href="table.css">
          <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>Home</title>
</head>
<body class="appBackground">

<div id="mySidebar" class="sidebar" >
    <div class="sidebar-logo"><img src="student.png" alt="logo" width="100%"/></div>
    <a href="home.php"><i class="material-icons">home</i><span class="icon-text">Home</span></a><br>
    <a href="date.php"><i class="material-icons">assignment_ind</i><span class="icon-text">Date personale</span></a><br>
    <a href="discipline.html"><i class="material-icons">source</i><span class="icon-text">Discipline</span></a><br>
    <a href="login.php" style="position: fixed; bottom: 0; width:18%"><i class="material-icons">logout</i><span class="icon-text">Iesire</span></a>
</div>


<div   id="main">
    <div class="container-fluid" style="margin-top: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 titlu">
                        Choose the<br>
                        Best Education for your future
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 inf">
            <div class="row text-center">
            	<div class="col">
            	        <div class="counter">
                             <i class="fa fa-code fa-2x"></i>
                   <h2 class="timer count-title count-number" data-to="1700" data-speed="1500"></h2>
                   <p class="count-text ">Studenti online</p>
                </div>
            	        </div>
                          <div class="col">
                           <div class="counter">
                  <i class="fa fa-coffee fa-2x"></i>
                  <h2 class="timer count-title count-number" data-to="100" data-speed="1500"></h2>
                  <p class="count-text ">Discipline</p>
                </div>
                          </div>
                          <div class="col">
                              <div class="counter">
                  <i class="fa fa-lightbulb-o fa-2x"></i>
                  <h2 class="timer count-title count-number" data-to="20" data-speed="1500"></h2>
                  <p class="count-text ">Facultăți</p>
                </div></div>
                          <div class="col">
                          <div class="counter">
                  <i class="fa fa-bug fa-2x"></i>
                  <h2 class="timer count-title count-number" data-to="1" data-speed="1500"></h2>
                  <p class="count-text ">Universitate</p>
                </div>
                          </div>
                     </div>
            </div>
            </div>
        </div>

        <div class="row">
                <div class="col-md-12 inf">
                    <h1>Welcome To College Track</h1>
                    College Track te poate ajuta să fi în pas cu notele .
                </div>
            </div>
        <div class="row ">
                <div class="col-md-4 ">
                    <div class="reclama "  >
                        <div class="photo" style="background-image: url('grade.jpg'); "></div>
                         <div class="bg-text">Note</div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="reclama "  >
                        <div class="photo" style="background-image: url('books.jpg'); "></div>
                         <div class="bg-text">Discipline</div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="reclama "  >
                        <div class="photo" style="background-image: url('finance.jpg'); "></div>
                        <div class="bg-text">Financiar</div>
                    </div>

                </div>
            </div>
    </div>
</div>



</body>
</html>