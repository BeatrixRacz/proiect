<?php
	session_start();
	if (!isset($_SESSION["userid"])) {
		header("Location: login.php");
	}
    if ($_SESSION["type"] != "PROFESOR") {
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

    <title>Studenti</title>
</head>
<body class="appBackground">

<div id="mySidebar" class="sidebar" >
    <div class="sidebar-logo"><img src="student.png" alt="logo" width="100%"/></div>
    <a href="home2.php"><i class="material-icons">home</i><span class="icon-text">Home</span></a><br>
    <a href="studenti.php"><i class="material-icons">source</i><span class="icon-text">Lista Studenți</span></a><br>
    <a href="note.php"><i class="material-icons">grading</i><span class="icon-text">Note Studenți</span></a><br>
    <a href="login.php" style="position: fixed; bottom: 0; width:18%"><i class="material-icons">logout</i><span class="icon-text">Iesire</span></a>
</div>

<div  id="main">
<div class="container-fluid "  style="width: 90%; margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <h3>Lista discipline</h3>

            </div>
        </div>

    <form class="form-horizontal" action="import_note.php" method="post"
          name="frmCSVImport" id="frmCSVImport"
          enctype="multipart/form-data">
        <div class="input-row">
            <label class="col-md-4 control-label">Choose CSV
                File</label> <input type="file" name="file"
                                    id="file" accept=".csv">
            <button type="submit" id="import" name="import"
                    class="btn-submit">Import</button>
            <br />

        </div>

    </form>

    <div class="col-md-6" >
        <div class="btn buton " style="background-color: rgba(0,0,0, 0.4);">
            <a href="export_note.php" >Export</a>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-12 ">
            <table class="table  table-sm table-hover " >
                <thead >
                <tr >

                    <th>
                        Nume Discipliă
                    </th>
                    <th>
                        Nume Student
                    </th>
                    <th>
                        Note teste
                    </th>
                    <th>
                        Nota partial
                    </th>
                    <th>
                        Nota examen
                    </th>
                </tr>
                </thead>
                <tbody>

                 <?php
                    $id = $_SESSION["userid"];
                    $sql = "SELECT m.DENUMIRE,s.NUME, n.NOTE_TESTE, n.NOTA_PARTIAL, n.NOTA_EXAMEN from note n
                            INNER JOIN studenti s  ON n.ID_STUDENT=s.ID_STUDENT
                            INNER JOIN materii m ON n.ID_MATERIE=m.ID_MATERIE
                            INNER join profesori p ON m.ID_PROFESOR=p.ID_PROFESOR where p.ID_PROFESOR = '$id';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo " <tr>
                            <td>" . $row["DENUMIRE"] . "</td>
                            <td>" . $row["NUME"] . "</td>
                            <td>" . $row["NOTE_TESTE"] . "</td>
                            <td>" . $row["NOTA_PARTIAL"] . "</td>
                            <td>" . $row["NOTA_EXAMEN"] . "</td>
                            </tr>";
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