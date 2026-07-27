<?php
// api/add_tanamcare_history.php
include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->title) && !empty($data->explanation) && !empty($data->solution)) {
    
    $image_path = null;
    
    // Process base64 image if present
    if (!empty($data->image_base64)) {
        $upload_dir = 'uploads/tanamcare/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Ensure image base64 is clean
        $image_parts = explode(";base64,", $data->image_base64);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : 'jpg';
        $image_base64 = base64_decode(isset($image_parts[1]) ? $image_parts[1] : $data->image_base64);
        
        $file_name = uniqid() . '.' . $image_type;
        $file_path = $upload_dir . $file_name;
        
        if (file_put_contents($file_path, $image_base64)) {
            $image_path = $file_path;
        }
    }

    $date = !empty($data->date) ? $data->date : date('Y-m-d H:i:s');
    
    $query = "INSERT INTO tanamcare_history (user_id, title, date, explanation, solution, image_path) VALUES (:user_id, :title, :date, :explanation, :solution, :image_path)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(":user_id", $data->user_id);
    $stmt->bindParam(":title", $data->title);
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":explanation", $data->explanation);
    $stmt->bindParam(":solution", $data->solution);
    $stmt->bindParam(":image_path", $image_path);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "History saved successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save history."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Incomplete data."]);
}
