<?php
// api/register.php
include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->nama) && !empty($data->email) && !empty($data->password) && !empty($data->password_confirmation)) {
    if ($data->password !== $data->password_confirmation) {
        echo json_encode(["success" => false, "message" => "Password confirmation does not match."]);
        exit();
    }

    // Check if email already exists
    $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => false, "message" => "Email already exists."]);
    } else {
        $query = "INSERT INTO users SET nama=:nama, email=:email, password=:password";
        $stmt = $db->prepare($query);

        $password_hash = password_hash($data->password, PASSWORD_BCRYPT);

        $stmt->bindParam(":nama", $data->nama);
        $stmt->bindParam(":email", $data->email);
        $stmt->bindParam(":password", $password_hash);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "User was created."]);
        } else {
            echo json_encode(["success" => false, "message" => "Unable to create user."]);
        }
    }
} else {
    echo json_encode(["success" => false, "message" => "Incomplete data."]);
}
