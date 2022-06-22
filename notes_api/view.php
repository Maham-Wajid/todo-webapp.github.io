<?php
error_reporting(E_ERROR);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

if($_SERVER['REQUEST_METHOD'] !== 'GET'):
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Bad Request Detected! Only POST method is allowed',
    ]);
    exit;
endif;

require 'db_connections.php';
$database = new Operations();
$conn = $database->dbConnection();

if(isset($_GET['id'])){
    $task_id = filter_var($_GET['id'], FILTER_VALIDATE_INT, [
        'options' => [
            'default' => 'all_tasks',
            'min_range' => 1
        ]
    ]);
}

// echo $_POST['id'];
// die();

$task_id = $_GET['id'];

try{
    $sql = is_numeric($task_id) ? "SELECT * FROM `tasks` WHERE id = '$task_id'" : "SELECT * FROM `tasks`";

    $stmt = $conn->prepare($sql);
    $stmt -> execute();

    if($stmt->rowCount() > 0):
        $data = null;
        if (is_numeric($task_id)) {
            $data = $stmt-> fetch(PDO::FETCH_ASSOC);

        }else{
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        echo json_encode([
            'success' => 1,
            'data' => $data,
        ]);

    else:
        echo json_encode([
            'succes' => 0,
            'message' => 'No Record Found!',
        ]);
    endif;

}
catch(PDOException $e){
    http_response_code(500);
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage()
    ]);
    exit;
}

?>