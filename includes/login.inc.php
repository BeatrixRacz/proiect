<?php

if (isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	require_once 'db.inc.php';
	require_once 'functions.inc.php';

	if(emptyInputLogin($email, $password) !== false)
	{
		header("Location: ../login.php?error=Completați toate informațiile!");
		exit();
	}
	else
		loginUser($conn, $email, $password);
}
else
{
	header("Location: ../login.php");
	exit();
}

?>