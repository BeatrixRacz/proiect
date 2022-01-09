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

        if ($password == 'DefaultPassword123') {
            if ($password == $uidExists['PAROLA']) {
                session_start();
                $_SESSION["userid"] = $uidExists["ID_STUDENT"];
                $_SESSION["type"] = "STUDENT";
                header("Location:../home.php");
                exit();
            }
            else{
                header("Location:../login.php?error=Parola introdusă este greșită.");
                exit();
            }
        }
        else
        {
            $pwdHashed = $uidExists['PAROLA'];
            $checkPwd = password_verify($password, $pwdHashed);

            if ($checkPwd === false) {
                header("Location:../login.php?error=Parola introdusă este greșită.");
                exit();
            }
            else {
                session_start();
                $_SESSION["userid"] = $uidExists["ID_STUDENT"];
                $_SESSION["type"] = "STUDENT";
                header("Location:../home.php");
                exit();
            }
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

        if ($password == 'DefaultPasswordTeacher123') {
            if ($password == $uidExists['PAROLA']) {
                session_start();
                $_SESSION["userid"] = $uidExists["ID_PROFESOR"];
                $_SESSION["type"] = "PROFESOR";
                header("Location:../home2.php");
                exit();
            }
            else{
                header("Location:../login.php?error=Parola introdusă este greșită.");
                exit();
            }
        }
        else
        {
            $pwdHashed = $uidExists['PAROLA'];
            $checkPwd = password_verify($password, $pwdHashed);

            if ($checkPwd === false) {
                header("Location:../login.php?error=Parola introdusă este greșită.");
                exit();
            }
            else {
                session_start();
                $_SESSION["userid"] = $uidExists["ID_PROFESOR"];
                $_SESSION["type"] = "PROFESOR";
                header("Location:../home2.php");
                exit();
            }
        }
    }
}

function emptyInputPasswordForm($psw1, $psw2)
{
    if (empty($psw1) || empty($psw2))
        $result = true;
    else
        $result = false;
    return $result;
}

function DifferentPasswordForm($psw1, $psw2)
{
    if ($psw1 !== $psw2)
        $result = true;
    else
        $result = false;
    return $result;
}

function ChangePasswordStudent($conn, $psw1, $id)
{
    $hashedPwd = password_hash($psw1, PASSWORD_DEFAULT);

    $sql = "UPDATE studenti
            SET PAROLA = '$hashedPwd'
            WHERE ID_STUDENT = '$id';";

    $result = mysqli_query($conn, $sql);
    if ($result)
    {
        header("Location: ../date.php?info=Success");
		exit();
    }
    else
    {
        header("Location: ../date.php?info=Error");
		exit();
    }
}

function ChangePasswordTeacher($conn, $psw1, $id)
{
    $hashedPwd = password_hash($psw1, PASSWORD_DEFAULT);

    $sql = "UPDATE profesori
            SET PAROLA = '$hashedPwd'
            WHERE ID_PROFESOR = '$id';";

    $result = mysqli_query($conn, $sql);
    if ($result)
    {
        header("Location: ../home2.php?info=Success");
		exit();
    }
    else
    {
        header("Location: ../home2.php?info=Error");
		exit();
    }
}

?>