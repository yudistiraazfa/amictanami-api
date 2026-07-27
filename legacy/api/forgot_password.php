<?php
// api/forgot_password.php
include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email)) {
    // Check if email exists
    $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $code = rand(100000, 999999); // 6-digit code
        $expires_at = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Check if there is already a request, delete old ones
        $query = "DELETE FROM password_resets WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $data->email);
        $stmt->execute();

        // Insert new code
        $query = "INSERT INTO password_resets SET email=:email, token=:code, expires_at=:expires_at";
        $stmt = $db->prepare($query);

        $stmt->bindParam(":email", $data->email);
        $stmt->bindParam(":code", $code);
        $stmt->bindParam(":expires_at", $expires_at);

        if ($stmt->execute()) {
            // For development/testing purposes, return the code in the response
            // In production, send this code via email
            echo json_encode([
                "success" => true,
                "message" => "Verification code generated.",
                "data" => ["code" => $code] // Testing only
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Unable to generate code."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email not found."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Incomplete data."]);
}
