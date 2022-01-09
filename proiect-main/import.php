<?php
if(isset($_POST['import'])) {
    require_once 'includes/db.inc.php';
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

        // If the file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // Parse data from CSV file line by line
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                // Get row data
                $id = $line[0];
                $nume = $line[1];
                $facultate = $line[2];
                $specializare = $line[3];
                $an = $line[4];
                $grupa = $line[5];
                $cnp = $line[6];
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

                $sql = "SELECT CNP FROM studenti WHERE CNP = $cnp;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    // Update member data in the database

                    $query = "UPDATE studenti SET NUME = '$nume', CNP = '$cnp ', FACULTATE = '$facultate ', 
                    SPECIALIZARE = '$specializare ', AN = '$an', GRUPA = '$grupa', EMAIL = '$email', PAROLA = '$parola', 
                    IBAN = ' $iban', DATA_NASTERII = '$data_nasterii' ,ADRESA = '$status', TELEFON = '$telefon', 
                    MEDIE_ADMITERE = '$media_admitere', LICEU = '$liceu' 
                    WHERE CNP = '$cnp';";
                    mysqli_query($conn, $query);



                } else {
                    // Insert member data in the database

                    $query1 = "INSERT INTO studenti(NUME, CNP, FACULTATE, SPECIALIZARE, AN, GRUPA, 
                     EMAIL, IBAN, DATA_NASTERII, STATUS, TELEFON, ADRESA, MEDIE_ADMITERE, LICEU) 
                     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $query1)) {
                        header("Location: addstudent.php");
                        exit();

                    }
                    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $nume, $cnp, $facultate, $specializare,
                                        $an, $grupa, $email, $iban,
                                        $data_nasterii, $status, $telefon, $adresa, $media_admitere, $liceu);
                    mysqli_stmt_execute($stmt);

                }
            }

            // Close opened CSV file
            fclose($csvFile);

            $qstring = '?status=succ';
        } else {
            $qstring = '?status=err';
        }
    } else {
        $qstring = '?status=invalid_file';
    }
    header("Location: addstudent.php"); exit();
}
// Redirect to the listing page
else{ header("Location: addstudent.php");exit(); }
//VALUES ($nume, $cnp, $facultate, $specializare, $an, $grupa, $email, $iban,
//                           $data_nasterii, $status, $telefon, $adresa, $media_admitere, $liceu)";
