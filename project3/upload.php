<?php
include('database.php');
require 'vendor/autoload.php';

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $tmpFilePath = $file['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($tmpFilePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        $existingIds = [];

        $existingQuery = "SELECT id FROM artikel";
        $existingResult = mysqli_query($dbconn, $existingQuery);
        while ($row = mysqli_fetch_array($existingResult)) {
            $existingIds[] = $row['id'];
        }

        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false)[0];

            $id = $rowData[0];
            $artikelnaam = $rowData[1];
            $artikelgroep = $rowData[2];
            $kleur = $rowData[3];
            $prijs = floatval($rowData[4]);
            $BTW = $rowData[5];
            $voorraad = intval($rowData[6]);
            


            if (in_array($id, $existingIds)) {
                $updateQuery = "UPDATE artikel SET artikelnaam = ?, artikelgroep = ?, kleur = ?, prijs = ?, BTW = ?, voorraad = ? WHERE id = ?";
                $updateStatement = mysqli_prepare($dbconn, $updateQuery);
                mysqli_stmt_bind_param($updateStatement, 'sssdiii', $artikelnaam, $artikelgroep, $kleur, $prijs, $BTW, $voorraad, $id);
                mysqli_stmt_execute($updateStatement);
                mysqli_stmt_close($updateStatement);
            } else {
                $insertQuery = "INSERT INTO artikel (id, artikelnaam, artikelgroep, kleur, prijs, BTW, voorraad) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $insertStatement = mysqli_prepare($dbconn, $insertQuery);
                mysqli_stmt_bind_param($insertStatement, 'issdsii', $id, $artikelnaam, $artikelgroep, $kleur, $prijs, $BTW, $voorraad);
                mysqli_stmt_execute($insertStatement);
                mysqli_stmt_close($insertStatement);
            }
            
        }
        header('Location: voorraad.php');
        exit();
    } else {
        echo "Error occurred during file upload.";
    }
} else {
    header('Location: voorraad.php');
    exit();
}
?>
