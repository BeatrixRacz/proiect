<?php
	session_start();
	if (!isset($_SESSION["userid"])) {
		header("Location: login.php");
	}
	include_once 'includes/db.inc.php';
?>

// Fetch records from database
<?php
$id = $_SESSION["userid"];
$sql = "SELECT ID_STUDENT,NUME,FACULTATE,SPECIALIZARE,AN,CNP,EMAIL, PAROLA, IBAN, DATA_NASTERII, STATUS, TELEFON, ADRESA, MEDIE_ADMITERE, LICEU FROM studenti ORDER by FACULTATE, AN ASC;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck > 0){
    $delimiter = ",";
    $filename = "members-data_" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('ID_STUDENT', 'NUME', 'FACULTATE', 'SPECIALIZARE', 'AN', 'CNP', 'EMAIL', 'PAROLA', 'IBAN', 'DATA_NASTERII', 'STATUS', 'TELEFON', 'ADRESA', 'MEDIE_ADMITERE', 'LICEU');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer
    while($row = mysqli_fetch_assoc($result)){
        $lineData = array($row['ID_STUDENT'] , $row['NUME'], $row['FACULTATE'], $row['SPECIALIZARE'], $row['AN'], $row['CNP'], $row['EMAIL'], $row['PAROLA'], $row['IBAN'],  $row['DATA_NASTERII'], $row['STATUS'], $row['TELEFON'],  $row['ADRESA'],  $row['MEDIE_ADMITERE'],  $row['LICEU']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file
    fseek($f, 0);

    // Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;
?>


