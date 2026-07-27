<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Get kategori_id from URL parameter
$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : die();

$query = "SELECT 
            t.id,
            t.nama_umum,
            t.nama_latin,
            t.deskripsi,
            t.gambar_url,
            t.kategori_id,
            k.nama_kategori
          FROM tanaman t
          LEFT JOIN kategori k ON t.kategori_id = k.id
          WHERE t.kategori_id = :kategori_id
          ORDER BY t.nama_umum ASC";

try {
    $stmt = $db->prepare($query);
    $stmt->bindParam(":kategori_id", $kategori_id);
    $stmt->execute();

    $tanaman_arr = array();
    $tanaman_arr["success"] = true;
    $tanaman_arr["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $tanaman_item = array(
            "id" => $id,
            "nama_umum" => $nama_umum,
            "nama_latin" => $nama_latin,
            "deskripsi" => $deskripsi,
            "gambar_url" => $gambar_url,
            "kategori_id" => $kategori_id,
            "nama_kategori" => $nama_kategori
        );

        array_push($tanaman_arr["data"], $tanaman_item);
    }

    http_response_code(200);
    echo json_encode($tanaman_arr);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}
