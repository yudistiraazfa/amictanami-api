<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$tanaman_id = isset($_GET['id']) ? $_GET['id'] : die();

try {
    // Get tanaman data
    $query_tanaman = "SELECT t.*, k.nama_kategori 
                      FROM tanaman t
                      LEFT JOIN kategori k ON t.kategori_id = k.id
                      WHERE t.id = :id";
    $stmt_tanaman = $db->prepare($query_tanaman);
    $stmt_tanaman->bindParam(":id", $tanaman_id);
    $stmt_tanaman->execute();
    $tanaman = $stmt_tanaman->fetch(PDO::FETCH_ASSOC);

    if (!$tanaman) {
        http_response_code(404);
        echo json_encode([
            "success" => false,
            "message" => "Tanaman not found"
        ]);
        exit();
    }

    // Get bibit media
    $query_bibit = "SELECT * FROM bibit_media WHERE tanaman_id = :id";
    $stmt_bibit = $db->prepare($query_bibit);
    $stmt_bibit->bindParam(":id", $tanaman_id);
    $stmt_bibit->execute();
    $bibit_media = $stmt_bibit->fetch(PDO::FETCH_ASSOC);

    // Get penyiraman
    $query_penyiraman = "SELECT * FROM penyiraman WHERE tanaman_id = :id";
    $stmt_penyiraman = $db->prepare($query_penyiraman);
    $stmt_penyiraman->bindParam(":id", $tanaman_id);
    $stmt_penyiraman->execute();
    $penyiraman = $stmt_penyiraman->fetch(PDO::FETCH_ASSOC);

    // Get pemupukan
    $query_pemupukan = "SELECT * FROM pemupukan WHERE tanaman_id = :id";
    $stmt_pemupukan = $db->prepare($query_pemupukan);
    $stmt_pemupukan->bindParam(":id", $tanaman_id);
    $stmt_pemupukan->execute();
    $pemupukan = $stmt_pemupukan->fetch(PDO::FETCH_ASSOC);

    // Get perawatan
    $query_perawatan = "SELECT * FROM perawatan WHERE tanaman_id = :id";
    $stmt_perawatan = $db->prepare($query_perawatan);
    $stmt_perawatan->bindParam(":id", $tanaman_id);
    $stmt_perawatan->execute();
    $perawatan_arr = array();
    while ($row = $stmt_perawatan->fetch(PDO::FETCH_ASSOC)) {
        array_push($perawatan_arr, $row);
    }

    // Get masa panen
    $query_panen = "SELECT * FROM masa_panen WHERE tanaman_id = :id";
    $stmt_panen = $db->prepare($query_panen);
    $stmt_panen->bindParam(":id", $tanaman_id);
    $stmt_panen->execute();
    $masa_panen = $stmt_panen->fetch(PDO::FETCH_ASSOC);

    // Combine all data
    $detail = array(
        "success" => true,
        "data" => array(
            "tanaman" => $tanaman,
            "bibit_media" => $bibit_media ? $bibit_media : null,
            "penyiraman" => $penyiraman ? $penyiraman : null,
            "pemupukan" => $pemupukan ? $pemupukan : null,
            "perawatan" => $perawatan_arr,
            "masa_panen" => $masa_panen ? $masa_panen : null
        )
    );

    http_response_code(200);
    echo json_encode($detail);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}
