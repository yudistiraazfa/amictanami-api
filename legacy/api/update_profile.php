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

if (!empty($data->id) && !empty($data->nama) && !empty($data->email)) {
    try {
        // Cek apakah email sudah digunakan user lain
        $queryCheck = "SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1";
        $stmtCheck = $db->prepare($queryCheck);
        $stmtCheck->bindParam(':email', $data->email);
        $stmtCheck->bindParam(':id', $data->id);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            echo json_encode(["success" => false, "message" => "Email sudah digunakan oleh akun lain"]);
            exit;
        }

        // Cek apakah ada update password
        if (!empty($data->password)) {
            $query = "UPDATE users SET nama = :nama, email = :email, password = :password, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
            $stmt = $db->prepare($query);
            
            $password_hash = password_hash($data->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);
        } else {
            // Update nama dan email saja
            $query = "UPDATE users SET nama = :nama, email = :email, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
            $stmt = $db->prepare($query);
        }

        $stmt->bindParam(':nama', $data->nama);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':id', $data->id);

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Profil berhasil diperbarui"
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui profil"]);
        }
    } catch(PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
}
?>
