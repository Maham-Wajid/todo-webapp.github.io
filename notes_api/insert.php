<?php
error_reporting(E_ERROR);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS"){
    die();
}

if($_SERVER['REQUEST_METHOD'] !== 'POST'):
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

if(!isset($data->title)):
    echo json_encode([
        'success' => 0,
        'message' => 'Title field is compulsory!',
    ]);
    exit;
elseif (empty(trim($data->title))):
    echo json_encode([
        'success' => 0,
        'message' => 'Field connot be empty!',
    ]);
    exit;
endif;

try{
    $title = htmlspecialchars(trim($data->title));
    $descrp = htmlspecialchars(trim($data->description));

    $query = "INSERT INTO `tasks`(title,description) VALUES(:title,:descrp)";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':descrp', $descrp, PDO::PARAM_STR);

    if($stmt->execute()){
        http_response_code(201);
        echo json_encode([
            'success' => 1,
            'message' => 'Data inserted successfully!'
        ]);
        exit;
    }
    
    echo json_encode([
        'success' => 0,
        'message' => 'Data inserted failed!'
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