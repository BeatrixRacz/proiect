<?php

function emptyInputLogin($email, $password)
{
    if (empty($email) || empty($password))
        $result = true;
    else
        $result = false;
    return $result;
}

function uidExistsStudent($conn, $email)
{
    $sql = "SELECT * FROM studenti WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location:../login.php?error=Eroare! Baza de date: StmtFailed.");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
}

function uidExistsTeacher($conn, $email)
{
    $sql = "SELECT * FROM profesori WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location:../login.php?error=Eroare! Baza de date: StmtFailed.");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
}

function loginUser($conn, $email, $password)
{
    if (uidExistsStudent($conn, $email) === false && uidExistsTeacher($conn, $email) === false)
    {
        header("Location:../login.php?error=Acest utilizator nu există.");
        exit();
    }

    if (uidExistsStudent($conn, $email) !== false)
    {
        $uidExists = uidExistsStudent($conn, $email);
        if($uidExists === false)
        {
            header("Location:../login.php?error=Acest utilizator nu există.");
            exit();
        }
        if ($password !== $uidExists["PAROLA"])
        {
            header("Location:../login.php?error=Parola introdusă este greșită.");
            exit();
        }
        else if ($password === $uidExists["PAROLA"])
        {
            session_start();
            $_SESSION["userid"] = $uidExists["ID_STUDENT"];
            $_SESSION["type"] = "STUDENT";
            header("Location:../home.php");
            exit();
        }
    }

    if (uidExistsTeacher($conn, $email) !== false)
    {
        $uidExists = uidExistsTeacher($conn, $email);
        if($uidExists === false)
        {
            header("Location:../login.php?error=Acest utilizator nu există.");
            exit();
        }
        if ($password !== $uidExists["PAROLA"])
        {
            header("Location:../login.php?error=Parola introdusă este greșită.");
            exit();
        }
        else if ($password === $uidExists["PAROLA"])
        {
            session_start();
            $_SESSION["userid"] = $uidExists["ID_PROFESOR"];
            $_SESSION["type"] = "PROFESOR";
            header("Location:../studenti.php");
            exit();
        }
    }
}


?>