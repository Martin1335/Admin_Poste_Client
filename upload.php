<?php
// Traitement du téléchargement de fichiers
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';
    $uploadedFile = $uploadDir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
        echo "Le fichier a bien été téléchargé.";
    } else {
        echo "Le fichier n'a pas pu être téléchargé.";
    }
}

// Traitement de la suppression de fichiers
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteFile'])) {
    $fileToDelete = $_POST['deleteFile'];

    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo "Le fichier a bien été supprimé..";
    } else {
        echo "Le fichier n'est plus.";
    }
}
$fileList = glob("uploads/*");

foreach ($fileList as $file) {
    echo "<p><a href='$file' download>" . basename($file) . "</a> ";
    echo "<form method='post' style='display:inline;'>
            <input type='hidden' name='deleteFile' value='$file'>
            <button type='submit'>Supprimer ce fichier</button>
          </form></p>";
}

// Gestion de la suppression de fichiers
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteFile'])) {
    $fileToDelete = $_POST['deleteFile'];

    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo "Le fichier a bien été supprimé.";
    } else {
        echo "Le fichier n'est plus de notre monde..";
    }
}

?>
