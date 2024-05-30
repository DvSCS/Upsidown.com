<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $download_link = "http://seusite.com/" . $target_file;
        echo json_encode(array("downloadLink" => $download_link));
    } else {
        http_response_code(500);
        echo json_encode(array("error" => "Desculpe, houve um erro ao enviar seu arquivo."));
    }
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Método não permitido."));
}
?>