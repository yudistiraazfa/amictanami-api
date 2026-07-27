<?php
// api/verify_code.php
include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->code)) {
    $query = "SELECT * FROM password_resets WHERE email = :email AND token = :code LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":code", $data->code);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $now = date('Y-m-d H:i:s');

        if ($now <= $row['expires_at']) {
            // Generate reset token
            $reset_token = bin2hex(random_bytes(32));

            // Update record with reset_token
            // Note: we might want to store reset_token in a different way or update the same record
            // For simplicity, let's update the token field to the reset_token and extend expiration? 
            // Or better, keep using the same table but maybe mark it as verified? 
            // Plan says: "Update record with token"

            $query_update = "UPDATE password_resets SET token = :reset_token WHERE email = :email AND token = :code";
            $stmt_update = $db->prepare($query_update);
            $stmt_update->bindParam(":reset_token", $reset_token);
            $stmt_update->bindParam(":email", $data->email);
            $stmt_update->bindParam(":code", $data->code);

            if ($stmt_update->execute()) {
                echo json_encode([
                    "success" => true,
                    "message" => "Code verified.",
                    "reset_token" => $reset_token
                ]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to generate reset token."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Code expired."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid code."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Incomplete data."]);
}
