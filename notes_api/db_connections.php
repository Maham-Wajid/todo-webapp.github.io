<?php

class Operations{
    private $db_host = 'localhost';
    private $db_name = 'noteApp';
    private $db_username = 'root';
    private $password = '';

    public function dbConnection()
    {
        try{
            $conn = new PDO('mysql: host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_username, $this->password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e)
        {
            echo "Connection Error" . $e->getMessage();
            exit;
        }
    }
}


?>