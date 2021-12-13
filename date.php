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

    <title>Date student</title>

    <style>
        table{
            width: 100%;
        }

        tr{
            padding: 10px 0;
        }

        #tdName{
            padding: 10px;
        }
    </style>

    <script>
        function show(id)
        {
            var a = document.getElementById('general');
            var b = document.getElementById('school');
            var c = document.getElementById('financiar');
            var d = document.getElementById('discipline');

            switch (id) {
                case 'general':
                    a.style.display = "block";
                    b.style.display = "none";
                    c.style.display = "none";
                    d.style.display = "none";
                    break;

                case 'school':
                    b.style.display = "block";
                    a.style.display = "none";
                    c.style.display = "none";
                    d.style.display = "none";
                    break;

                case 'financiar':
                    c.style.display = "block";
                    a.style.display = "none";
                    b.style.display = "none";
                    d.style.display = "none";
                    break;

                case 'discipline':
                    d.style.display = "block";
                    a.style.display = "none";
                    b.style.display = "none";
                    c.style.display = "none";
                    break;
            
                default:
                    break;
            }
        }
    </script>
</head>
<body class="appBackground">
<div id="mySidebar" class="sidebar" >
    <div class="sidebar-logo"><img src="student.png" alt="logo" width="100%"/></div>
    <a href="home.php"><i class="material-icons">home</i><span class="icon-text">Home</span></a><br>
    <a href="date.html"><i class="material-icons">assignment_ind</i><span class="icon-text">Date personale</span></a><br>
    <a href="discipline.php"><i class="material-icons">source</i><span class="icon-text">Discipline</span></a><br>
    <a href="login.php" style="position: fixed; bottom: 0; width:18%"><i class="material-icons">logout</i><span class="icon-text">Iesire</span></a>
</div>
<div id="main">
<div class="container-fluid outer"  style="background-color: transparent; width: 80%;">
    <div>
        <table>
            <tr>
                <td><img alt="Bootstrap Image Preview" src="user.jpg" style="width: 100px; border-radius: 50%;" /></td>
                <td id='tdName'><h1>Informații Personale</h1></td>

            </tr>
        </table>
    </div>

    <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%; padding: 10px 0;">
        <button type="button" class="btn btn-secondary" onclick="show('general')">Informatii</button>
        <button type="button" class="btn btn-secondary" onclick="show('school')">Scolaritate</button>
        <button type="button" class="btn btn-secondary" onclick="show('financiar')">Financiar</button>
        <button type="button" class="btn btn-secondary" onclick="show('discipline')">Discipline</button>
    </div>

    <?php
        $id = $_SESSION["userid"];
        $sql = "SELECT *
        FROM studenti
        WHERE ID_STUDENT = '$id';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                //$row["NUME"]
                $an = $row['AN'];
                echo "<div id='general'>";
                echo " <h2>Informații student</h2>
                <dl>
                    <dt>
                        Nume: " . $row["NUME"] . "
                    </dt>
                    <dt>
                        Cnp: " . $row["CNP"] . "
                    </dt>
                    <dt>
                        Adresa: " . $row["ADRESA"] . "
                    </dt>
                    <dt>
                        Data nasterii: " . $row["DATA_NASTERII"] . "
                    </dt>
                    <dt>
                        Telefon: " . $row["TELEFON"] . "
                    </dt>                          
                </dl>";
                echo "</div>";

                echo "<div id='school' style='display: none;'>"; 
                echo "<h2>Scolaritate</h2>
                <dl>
                    <dt>
                        Medie admitere: " . $row["MEDIE_ADMITERE"] . "
                    </dt>
                    <dt>
                        Liceu: " . $row["LICEU"] . "
                    </dt>
                    <dt>
                        Facultate/colegiu: " . $row["FACULTATE"] . "
                    </dt>
                    <dt>
                        Specializare: " . $row["SPECIALIZARE"] . "
                    </dt>
                    <dt>
                        An studiu: " . $row["AN"] . "
                    </dt>
                    <dt>
                        Grupă: " . $row["GRUPA"] . "
                    </dt>                                 
                </dl>";
                echo "</div>";
            }    
        }

        $sql = "SELECT *
        FROM MATERII
        WHERE AN = '$an';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0)
        {
            echo "<div id='discipline' style='display: none;'>";
            echo "<h2>Listă discipline</h2>
                <ol>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "
                    <li class='list-item'>
                        " . $row['DENUMIRE'] . "
                    </li>
                ";
            }
            echo "</ol></div>";
        }
    ?>

    <div id='financiar' style="display: none;">
        <h2>Financiar</h2>
        <dl>
            <dt>
                Informatii Financiar
            </dt>
            <dt>
                Informatii Cazare
            </dt>
            <dt>
                Plati
            </dt>                                
        </dl>
    </div>

</div>
</div>
</body>
</html>