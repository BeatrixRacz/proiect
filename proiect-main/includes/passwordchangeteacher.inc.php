<?php

if (isset($_GET['submit']))
{
	$psw1 = $_GET['psw1'];
	$psw2 = $_GET['psw2'];
    $id = $_GET['id'];

	require_once 'db.inc.php';
	require_once 'functions.inc.php';

	if(emptyInputPasswordForm($psw1, $psw2) !== false)
	{
		header("Location: ../login.php?error=Completați toate informațiile!");
		exit();
	}
	elseif (DifferentPasswordForm($psw1, $psw2) !== false) {
        header("Location: ../login.php?error=Au fost introduse două parole diferite!");
		exit();
    }
	else
    	ChangePasswordTeacher($conn, $psw1, $id);
}
else
{
	header("Location: ../login.php");
	exit();
}

?>