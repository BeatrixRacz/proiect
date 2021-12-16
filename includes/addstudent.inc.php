<?php

if (isset($_POST['addstudent']))
{	
	$nume = $_POST['nume'];
	$cnp = $_POST['cnp'];
	$facultate = $_POST['facultate'];
	$specializare = $_POST['specializare'];
	$an = $_POST['an'];
	$grupa = $_POST['grupa'];
    $iban = $_POST['iban'];
    $nastere = $_POST['nastere'];
	$tel = $_POST['tel'];
	$adresa = $_POST['adresa'];
	$medie = $_POST['medie'];
	$liceu = $_POST['liceu'];

	require_once 'db.inc.php';
	require_once 'functions.inc.php';
	
	if(emptyAddStudent($nume, $cnp, $facultate, $specializare, $an, $grupa, $nastere, $tel, $adresa, $medie, $liceu))
	{
		header("Location: ../addstudent.php?error=Completați toate informațiile!");
		exit();
	}
	elseif (studentAlreadyExists($conn, $cnp) === true)
	{
		header("Location: ../addstudent.php?error=Studentul există deja in baza de date!");
		exit();
	}
	else
	{
		addNewStudent($conn, $nume, $cnp, $facultate, $specializare, $an, $grupa, $iban, $nastere, $tel, $adresa, $medie, $liceu);
	}
}
else
{
	header("Location: ../login.php;");
	exit();
}

?>