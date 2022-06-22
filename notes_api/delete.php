<?php
error_reporting(E_ERROR);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, 
    Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS"){
    die();
}

if($_SERVER['REQUEST_METHOD'] !== 'DELETE'):
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Bad Request! HTTP method should be DELETE',
    ]);
    exit;
endif;

require 'db_connections.php';
$database = new Operations();
$conn = $database->dbConnection();

$data = json_decode(file_get_contents("php://input"));
$t_id = $_GET['id'];

if(!isset($t_id)){
    echo json_encode([
        'success' => 0,
        'message' => 'Please provide POST ID'
    ]);
    exit;
}

try{
    $fetch_post = "SELECT * FROM `tasks` WHERE id=:t_id";
    $fetch_stmt = $conn->prepare($fetch_post);
    $fetch_stmt->bindValue(':t_id', $t_id, PDO::PARAM_INT);
    $fetch_stmt->execute();

    if($fetch_stmt->rowCount() > 0):
        $delete_post = "DELETE FROM `tasks` WHERE id = :t_id";
        $delete_post_stmt = $conn->prepare($delete_post);
        $delete_post_stmt->bindValue(':t_id', $t_id, PDO::PARAM_INT);

        if($delete_post_stmt->execute()){
            echo json_encode([
                'success' => 1,
                'message' => 'Deleted successfully!'
            ]);
            exit;
        }
    
        echo json_encode([
            'success' => 0,
            'message' => 'Deletion failed!'
        ]);
        exit;

    else:
        echo json_encode([
            'success' => 0,
            'message' => 'INVALID ID!'
        ]);
        exit;
    endif;
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