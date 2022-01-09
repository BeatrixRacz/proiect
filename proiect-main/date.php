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

        .open-button {
    background-color: #555;
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    opacity: 0.8;
    position: fixed;
    bottom: 23px;
    right: 28px;
    width: 280px;
    display: none;
    border-radius: 10px;
    }

    .form-popup {
    display: none;
    position: fixed;
    bottom: 0px;
    right: 15px;
    border: 2px solid #555;
    z-index: 9;
    }

    .form-container {
    max-width: 300px;
    padding: 10px;
    background: transparent;
    }

    .form-container input[type=text], .form-container input[type=password] {
    width: 100%;
    padding: 10px;
    margin: 5px 0 20px 0;
    border: none;
    background: #f1f1f1;
    border-radius: 10px;
    }

    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
    background-color: lightgray;
    outline: none;
    }

    .form-container .btn {
    background-color: #04AA6D;
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom:10px;
    border-radius: 10px;
    }

    .form-container .cancel {
    background-color: red;
    border-radius: 10px;
    }

    .form-container .btn:hover, .open-button:hover {
    opacity: 1;
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
    <a href="date.php"><i class="material-icons">assignment_ind</i><span class="icon-text">Date personale</span></a><br>
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
                    <?php
                        $id = $_SESSION["userid"];
                        $sql = "SELECT PAROLA
                        FROM studenti
                        WHERE ID_STUDENT = '$id';";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                if ($row['PAROLA'] == "DefaultPassword123")
                                    echo "<button style='display:block;' class='open-button' onclick='openForm()'>Schimbă parola</button>";
                            }
                        }
                    ?>
            </tr>
        </table>
    </div>

    

    <div class="form-popup" id="myForm">
    <form action="includes/passwordchangestudent.inc.php" class="form-container">
        <h1>Schimbă parola</h1>
        <?php
            $id = $_SESSION["userid"];
            echo "<input type='hidden' name='id' value='{$id}'/>"
        ?>

        <label for="psw1"><b>Introduceți parola nouă</b></label>
        <input type="text" autocomplete="off" placeholder="Enter Password" name="psw1" required>

        <label for="psw2"><b>Confirmă parola</b></label>
        <input type="text" autocomplete="off" placeholder="Confirm Password" name="psw2" required>

        <button type="submit" name="submit" class="btn">Accept</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Închide</button>
    </form>
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
                    <dt>
                        IBAN: ";
                    if ($row["IBAN"] == NULL) {
                        echo "-";
                    }
                    else echo $row["IBAN"];
                    echo "</dt></dl>";
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

        echo "<div id='discipline' style='display: none;'>";
            echo "<h2>Listă discipline</h2> <h4> Semestrul I </h4>
                <ol>";
        $sql = "SELECT *
        FROM MATERII
        WHERE AN = '$an' AND SEMESTRU = 1;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0)
        {
            
            while($row = mysqli_fetch_assoc($result))
            {
                echo "
                    <li class='list-item'>
                        " . $row['DENUMIRE'] . "
                    </li>
                ";
            }
        }
        echo "</ol>";

        echo "<h4> Semestrul II </h4> <ol>";
        $sql = "SELECT *
        FROM MATERII
        WHERE AN = '$an' AND SEMESTRU = 2;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0)
        {
            
            while($row = mysqli_fetch_assoc($result))
            {
                echo "
                    <li class='list-item'>
                        " . $row['DENUMIRE'] . "
                    </li>
                ";
            }
        }
        echo "</ol>";
        echo "</div>";

        echo "<div id='financiar' style='display: none;'> <h2>Financiar</h2> <dl> <dt>Burse</dt>";
        $sql = "SELECT *
        FROM BURSE_STUDENTI bs, BURSE b
        WHERE bs.ID_STUDENT = '$id' AND b.ID_BURSA = bs.ID_BURSA;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo $row['DENUMIRE'] . ": " . $row['VALOARE'] . " RON";
            }
        }
        else
            echo "Nu s-a gasit nicio bursa pentru acest student.";                            
        echo "</dl></div>";
    ?>
</div>
</div>

<script>
    function openForm() {
    document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
    document.getElementById("myForm").style.display = "none";
    }
</script>

</body>
</html>