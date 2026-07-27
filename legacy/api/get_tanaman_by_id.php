<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Get tanaman_id from URL parameter
$id = isset($_GET['id']) ? $_GET['id'] : die(json_encode([
    "success" => false,
    "message" => "ID parameter is required"
]));

$query = "SELECT 
            t.id,
            t.nama_umum,
            t.nama_latin,
            t.deskripsi,
            t.gambar_url,
            t.kategori_id,
            t.created_at,
            t.updated_at,
            k.nama_kategori
          FROM tanaman t
          LEFT JOIN kategori k ON t.kategori_id = k.id
          WHERE t.id = :id";

try {
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $tanaman = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tanaman) {
        http_response_code(200);
        echo json_encode([
            "success" => true,
            "data" => $tanaman
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            "success" => false,
            "message" => "Tanaman not found with ID: " . $id
        ]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
