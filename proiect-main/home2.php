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

    <title>Home</title>

    <style>

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

</head>
<body class="appBackground">


<div id="mySidebar" class="sidebar" >
    <div class="sidebar-logo"><img src="student.png" alt="logo" width="100%"/></div>
    <a href="home2.php"><i class="material-icons">home</i><span class="icon-text">Home</span></a><br>
    <a href="studenti.php"><i class="material-icons">source</i><span class="icon-text">Lista Studenți</span></a><br>
    <a href="note.php"><i class="material-icons">grading</i><span class="icon-text">Note Studenți</span></a><br>
    <a href="login.php" style="position: fixed; bottom: 0; width:18%"><i class="material-icons">logout</i><span class="icon-text">Iesire</span></a>
</div>

<div   id="main">
    <div class="container-fluid "  style="width: 90%; margin-top: 50px">
        <div class="row">
            <h3>Materii</h3>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="btn buton float-right"  style="background-color: rgba(0,0,0, 0.4);" >
                    <a href="inscriere.php"  >Inscrie student</a>
                </div>
            </div>

        </div>
        <div class="row ">
            <div class="col-md-12 ">
                <table class="table  table-sm table-hover " >
                    <thead >
                    <tr >
                        <th >
                            Id
                        </th>
                        <th>
                            Denumire
                        </th>
                        <th>
                            Credite
                        </th>
                        <th>
                            An
                        </th>
                        <th>
                            Semestru
                        </th>
                    </tr>
                    </thead>
                    <tbody>



                    <?php
                    $id = $_SESSION["userid"];
                    $sql = "SELECT m.ID_MATERIE, m.DENUMIRE, m.CREDITE, m.AN, m.SEMESTRU from materii m 
                            INNER join profesori p ON m.ID_PROFESOR=p.ID_PROFESOR where p.ID_PROFESOR = '$id'";

                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {

                            echo " <tr>
                     <td>" . $row["ID_MATERIE"] . "</td>
                     <td>" . $row["DENUMIRE"] . "</td>
                     <td>" . $row["CREDITE"] . "</td>
                     <td>" . $row["AN"] . "</td>
                     <td>" . $row["SEMESTRU"] . "</td>
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


</div>

                    <?php
                        $id = $_SESSION["userid"];
                        $sql = "SELECT PAROLA
                        FROM profesori
                        WHERE ID_PROFESOR = '$id';";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                if ($row['PAROLA'] == "DefaultPasswordTeacher123")
                                    echo "<button style='display:block;' class='open-button' onclick='openForm()'>Schimbă parola</button>";
                            }
                        }
                    ?>

    <div class="form-popup" id="myForm">
    <form action="includes/passwordchangeteacher.inc.php" class="form-container">
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