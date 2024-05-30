<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/"; // Diretório onde os arquivos serão armazenados
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Caminho completo do arquivo
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Se o arquivo foi movido com sucesso, retorna o link de download
        $download_link = "http://seusite.com/" . $target_file; // Substitua "http://seusite.com/" pelo seu URL real
        echo json_encode(array("downloadLink" => $download_link));
    } else {
        // Se houve algum erro ao mover o arquivo, retorna uma mensagem de erro
        http_response_code(500);
        echo json_encode(array("error" => "Desculpe, houve um erro ao enviar seu arquivo."));
    }
} else {
    // Se o método de requisição não for POST, retorna um erro de método não permitido
    http_response_code(405);
    echo json_encode(array("error" => "Método não permitido."));
}
?>
