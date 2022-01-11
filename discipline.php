<?php
	session_start();
	if (!isset($_SESSION["userid"])) {
		header("Location: login.php");
	}
    if ($_SESSION["type"] != "STUDENT") {
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
                            Note Teste
                        </th>
                        <th>
                            Medie Teste
                        </th>
                        <th>
                            Notă partial
                        </th>
                        <th>
                            Notă examen
                        </th>
                        <th>
                            Nr. credite
                        </th>
                    </tr>
                    </thead>
                    <tbody>


                        <?php
                            $id = $_SESSION["userid"];
                            $sql = "SELECT materii.DENUMIRE, materii.CREDITE,materii.SEMESTRU, note.NOTE_TESTE, note.NOTA_EXAMEN, note.NOTA_PARTIAL
                            FROM note, materii
                            WHERE materii.ID_MATERIE = note.ID_MATERIE AND note.ID_STUDENT = $id
                            ORDER BY materii.SEMESTRU, materii.DENUMIRE";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);
                            if($resultCheck > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $note = $row["NOTE_TESTE"];
                                    $keywords = preg_split("/[\s,;:.]+/", $note);
                                    $media = 0;
                                    $nr = 0;
                                    foreach ($keywords as $key => $value) {
                                        $media += (int) $value;
                                        $nr += 1;
                                    }
                                    echo " <tr><td>-</td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td>" . $row["DENUMIRE"] . "</td>
                                    <td>" . $row["SEMESTRU"] . "</td>
                                    <td>" . $row["NOTE_TESTE"] . "</td>
                                    <td>" . $media/$nr . "</td>
                                    <td>" . $row["NOTA_PARTIAL"] . "</td>
                                    <td>" . $row["NOTA_EXAMEN"] . "</td>
                                    <td>" . $row["CREDITE"] . "</td></tr>";
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