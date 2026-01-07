<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include "../db_conn.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['name']) && isset($data['phone']) && isset($data['email'])) {
    
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $name = validate($data['name']);
    $phone = validate($data['phone']);
    $email = validate($data['email']);

    if (empty($name) || empty($phone) || empty($email)) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit();
    }

    $sql = "INSERT INTO clients(name, phone, email) VALUES('$name', '$phone', '$email')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Client saved successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to save client: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request data"]);
}
?>
