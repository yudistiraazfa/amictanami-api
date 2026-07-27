<?php
include_once 'db_config.php';
$db = (new Database())->getConnection();
try {
    $db->exec("ALTER TABLE tanamcare_history ADD COLUMN image_path VARCHAR(255) NULL");
    echo "Success adding image_path";
} catch (Exception $e) {
    echo "Error or already exists: " . $e->getMessage();
}
