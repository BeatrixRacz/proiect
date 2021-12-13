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
    <title>Discipline</title>
</head>
<body class="appBackground">

<div id="mySidebar" class="sidebar" >
    <div class="sidebar-logo"><img src="student.png" alt="logo" width="100%"/></div>
    <a href="home.php"><i class="material-icons">home</i><span class="icon-text">Home</span></a><br>
    <a href="date.php"><i class="material-icons">assignment_ind</i><span class="icon-text">Date personale</span></a><br>
    <a href="discipline.php"><i class="material-icons">source</i><span class="icon-text">Discipline</span></a><br>
    <a href="login.php" style="position: fixed; bottom: 0; width:18%"><i class="material-icons">logout</i><span class="icon-text">Iesire</span></a>
</div>


<div id="main">
    <div class="container-fluid "  style="width: 90%; margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <h3>Note Discipline</h3>


            </div>
        </div>
        <div class="row ">
            <div class="col-md-12 ">
                <table class="table  table-sm table-hover " >
                    <thead >
                    <tr >
                        <th >
                            P
                        </th>
                        <th>
                            D
                        </th>
                        <th>
                            R
                        </th>
                        <th>
                            Disciplină
                        </th>
                        <th>
                            Sem
                        </th>
                        <th>
                            Notă activități
                        </th>
                        <th>
                            Notă finală
                        </th>
                        <th>
                            Nr. credite
                        </th>
                        <th>
                            Nr. puncte credite
                        </th>
                    </tr>
                    </thead>
                    <tbody>


                        <?php
                                $id = $_SESSION["userid"];
                                $sql = "SELECT materii.DENUMIRE, materii.CREDITE,materii.SEMESTRU, note.NOTA_EXAMEN, note.NOTA_PARTIAL FROM note, materii where materii.ID_MATERIE=note.ID_MATERIE and note.ID_STUDENT=$id";
                                $result = mysqli_query($conn, $sql);
                                $resultCheck = mysqli_num_rows($result);
                                if($resultCheck > 0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {

                                        echo " <tr><td>-</td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td>" . $row["DENUMIRE"] . "</td>
                                        <td>" . $row["SEMESTRU"] . "</td>
                                        <td>" . $row["NOTA_PARTIAL"] . "</td>
                                        <td>" . $row["NOTA_EXAMEN"] . "</td>
                                        <td>" . $row["CREDITE"] . "</td>
                                        <td> - </td></tr>";



                                       }
                                }
                               ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>