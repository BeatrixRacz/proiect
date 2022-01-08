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
$sql = "SELECT m.DENUMIRE,s.NUME, n.NOTE_TESTE, n.NOTA_PARTIAL, n.NOTA_EXAMEN from note n
                            INNER JOIN studenti s  ON n.ID_STUDENT=s.ID_STUDENT
                            INNER JOIN materii m ON n.ID_MATERIE=m.ID_MATERIE
                            INNER join profesori p ON m.ID_PROFESOR=p.ID_PROFESOR where p.ID_PROFESOR = '$id';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck > 0){
    $delimiter = ",";
    $filename = "members-data_" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('DENUMIRE', 'NUME', 'NOTE_TESTE', 'NOTA_PARTIAL', 'NOTA_EXAMEN');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer
    while($row = mysqli_fetch_assoc($result)){
        $lineData = array($row['DENUMIRE'] , $row['NUME'], $row['NOTE_TESTE'], $row['NOTA_PARTIAL'], $row['NOTA_EXAMEN']);
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


