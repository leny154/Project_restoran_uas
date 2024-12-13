<?php
// Aktifkan laporan error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Header untuk CORS dan JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Menangani permintaan GET
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ping'])) {
    echo json_encode(["message" => "Server is running!"]);
    exit;
}

// Menangani permintaan POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if ($data) {
        echo json_encode([
            "message" => "Data received!",
            "data" => $data
        ]);
    } else {
        echo json_encode(["message" => "No data received"]);
    }
    exit;
}

// Respons untuk permintaan tidak dikenal
http_response_code(404);
echo json_encode(["message" => "Invalid request"]);
?>