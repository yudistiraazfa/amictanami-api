<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->judul) && !empty($data->jam) && !empty($data->tanggal) && !empty($data->tipe)) {
    try {
        $query = "INSERT INTO activity_logs (user_id, judul, jam, tanggal, tipe) VALUES (:user_id, :judul, :jam, :tanggal, :tipe)";
        $stmt = $db->prepare($query);

        $stmt->bindParam(':user_id', $data->user_id);
        $stmt->bindParam(':judul', $data->judul);
        $stmt->bindParam(':jam', $data->jam);
        $stmt->bindParam(':tanggal', $data->tanggal);
        $stmt->bindParam(':tipe', $data->tipe);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Log aktivitas berhasil ditambahkan."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal menambahkan log aktivitas."]);
        }
    } catch(PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
}
?>
