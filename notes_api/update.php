<?php
error_reporting(E_ERROR);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS"){
    die();
}

if($_SERVER['REQUEST_METHOD'] !== 'PUT'):
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Bad Request! Only POST method is allowed',
    ]);
    exit;
endif;

require 'db_connections.php';
$database = new Operations();
$conn = $database->dbConnection();

$data = json_decode(file_get_contents("php://input"));

try{
    $t_id = htmlspecialchars($data->id);
    $t_title = htmlspecialchars(trim($data->title));
    $t_descrp = htmlspecialchars(trim($data->description));

    $sql = "UPDATE `tasks` SET title = :t_title, description = :t_descrp  WHERE id = :t_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':t_id', $t_id, PDO::PARAM_INT);
    $stmt->bindValue(':t_title', $t_title, PDO::PARAM_STR);
    $stmt->bindValue(':t_descrp', $t_descrp, PDO::PARAM_STR);

    if($stmt->execute()){
        http_response_code(201);
        echo json_encode([
            'success' => 1,
            'message' => 'Data Updated successfully!'
        ]);
        exit;
    }
    
    echo json_encode([
        'success' => 0,
        'message' => 'Data Updation failed!'
    ]);
    exit;
}
catch(PDOException $e){
    http_response_code((500));
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage(),
    ]);
    exit;
}

?>