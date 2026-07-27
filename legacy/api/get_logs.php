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

if (!empty($data->user_id)) {
    try {
        $query = "SELECT * FROM activity_logs WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $data->user_id);
        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {
            $logs_arr = array();
            $logs_arr["success"] = true;
            $logs_arr["data"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $log_item = array(
                    "id" => $id,
                    "judul" => $judul,
                    "jam" => $jam,
                    "tanggal" => $tanggal,
                    "tipe" => $tipe
                );
                array_push($logs_arr["data"], $log_item);
            }
            echo json_encode($logs_arr);
        } else {
            echo json_encode(["success" => true, "data" => []]);
        }
    } catch(PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
}
?>
