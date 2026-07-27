<?php
// api/login.php
include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    $query = "SELECT id, nama, email, password FROM users WHERE email = :email LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($data->password, $row['password'])) {
            // Generate a simple token (in production use JWT)
            $token = bin2hex(random_bytes(32));

            // For now we don't store token in DB as per simple requirement, unless requested.
            // But we return user data

            $user_data = array(
                "id" => $row['id'],
                "nama" => $row['nama'],
                "email" => $row['email'],
                "token" => $token
            );

            echo json_encode(["success" => true, "message" => "Login successful.", "data" => $user_data]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid password."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email not found."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Incomplete data."]);
}
