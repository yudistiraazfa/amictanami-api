<?php
// api/reset_password.php
include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->reset_token) && !empty($data->password) && !empty($data->password_confirmation)) {
    if ($data->password !== $data->password_confirmation) {
        echo json_encode(["success" => false, "message" => "Password confirmation does not match."]);
        exit();
    }

    // Verify reset token
    $query = "SELECT * FROM password_resets WHERE email = :email AND token = :reset_token LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":reset_token", $data->reset_token);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Update password
        $password_hash = password_hash($data->password, PASSWORD_BCRYPT);

        $query_update = "UPDATE users SET password = :password WHERE email = :email";
        $stmt_update = $db->prepare($query_update);
        $stmt_update->bindParam(":password", $password_hash);
        $stmt_update->bindParam(":email", $data->email);

        if ($stmt_update->execute()) {
            // Delete from password_resets
            $query_delete = "DELETE FROM password_resets WHERE email = :email";
            $stmt_delete = $db->prepare($query_delete);
            $stmt_delete->bindParam(":email", $data->email);
            $stmt_delete->execute();

            echo json_encode(["success" => true, "message" => "Password has been reset."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update password."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid reset token."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Incomplete data."]);
}
