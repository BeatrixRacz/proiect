<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
include_once 'includes/db.inc.php';
?>

<?php
if(isset($_POST['import'])){

    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE || $line[0] !== 'ID_STUDENT' ){
                // Get row data
                $id   = $line[0];
                $nume  = $line[1];
                $cnp  = $line[2];
                $facultate = $line[3];
                $specializare = $line[4];
                $an = $line[5];
                $grupa = $line[6];
                $email = $line[7];
                $parola = $line[8];
                $iban = $line[9];
                $data_nasterii = $line[10];
                $status = $line[11];
                $telefon = $line[12];
                $adresa = $line[13];
                $media_admitere = $line[14];
                $liceu = $line[15];



                // Check whether member already exists in the database with the same email
                $id = $_SESSION["userid"];
                $sql = "SELECT ID_STUDENT FROM studenti WHERE ID_STUDENT = '".$line[0]."'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0){
                    // Update member data in the database
                    $db = "UPDATE studenti SET nume = '".$nume."', cnp = '".$cnp."', facultate = '".$facultate."', specializare = '".$specializare."', an = '".$an."', grupa = '".$grupa."', email = '".$email."', parola = '".$parola."', iban = '".$iban."', data_nasterii = '".$data_nasterii."' ,status = '".$status."', telefon = '".$telefon."', adresa = '".$adresa."', medie_admitere = '".$media_admitere."', liceu = '".$liceu."' WHERE id = '".$id."'";
                    mysqli_query($conn, $db);

                }else{
                    // Insert member data in the database
                    $db = "INSERT INTO studenti(ID_STUDENT, NUME, CNP, FACULTATE, SPECIALIZARE, AN, GRUPA, EMAIL, IBAN, DATA_NASTERII, STATUS, TELEFON, ADRESA, MEDIE_ADMITERE, LICEU) VALUES (.$id., .$nume., .$cnp., .$facultate., .$specializare., .$an., .$grupa., .$email., .$iban., .$data_nasterii., .$status., .$telefon., .$adresa., .$media_admitere., .$liceu.)";
                    mysqli_query($conn, $db);
                }
            }

            // Close opened CSV file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: addstudent.php".$qstring);