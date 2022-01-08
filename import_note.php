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
                $id_materie = $line[0];
                $id_student = $line[1];
                $note_teste = $line[2];
                $nota_partial = $line[3];
                $nota_examen = $line[4];

                // Check whether member already exists in the database with the same email

                $sql = "SELECT ID_MATERIE, ID_STUDENT FROM note WHERE ID_MATERIE = $id_materie AND ID_STUDENT = $id_student;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    // Update member data in the database

                    $query = "UPDATE note SET NOTE_TESTE = '$note_teste', NOTA_PARTIAL = '$nota_partial', NOTA_EXAMEN = '$nota_examen'
                    WHERE ID_MATERIE = $id_materie AND ID_STUDENT = $id_student;";
                    mysqli_query($conn, $query);



                } else {
                    // Insert member data in the database

                    $query1 = "INSERT INTO `note`(`ID_MATERIE`, `ID_STUDENT`, `NOTE_TESTE`, `NOTA_PARTIAL`, `NOTA_EXAMEN`) 
                     VALUES (?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $query1)) {
                        header("Location: note.php");
                        exit();

                    }
                    mysqli_stmt_bind_param($stmt, "sssss", $id_materie, $id_student, $note_teste, $nota_partial,
                        $nota_examen);
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
    header("Location: note.php"); exit();
}
// Redirect to the listing page
else{ header("Location: note.php");exit(); }

