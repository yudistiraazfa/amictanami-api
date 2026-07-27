<?php
// api/get_tanamcare_history.php
include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id)) {
    $query = "SELECT id, title, date, explanation, solution, image_path FROM tanamcare_history WHERE user_id = :user_id ORDER BY id DESC";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user_id", $data->user_id);
    $stmt->execute();

    $history_arr = array();
    $server_url = "http://" . $_SERVER['SERVER_NAME'] . "/tanami-api/api/";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (!empty($row['image_path'])) {
            $row['image_url'] = $server_url . $row['image_path'];
        } else {
            $row['image_url'] = null;
        }
        array_push($history_arr, $row);
    }
    
    echo json_encode(["success" => true, "data" => $history_arr]);
} else {
    echo json_encode(["success" => false, "message" => "User ID required."]);
}
