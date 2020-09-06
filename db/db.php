<?php
require_once 'config/db.php';
class Db
{
    const HOST = MYSQL_HOST;

    const USERNAME = MYSQL_USER;

    const PASSWORD = MYSQL_PASSWORD;

    const DATABASENAME = MYSQL_DATABASE;

    private $conn;

    function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function getConnection()
    {
        $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);
        
        if (mysqli_connect_errno()) {
            trigger_error("Problem with connecting to database.");
        }
        
        $conn->set_charset("utf8");
        return $conn;
    }

    public function select($query, $paramType="", $paramArray=array())
    {
        $stmt = $this->conn->prepare($query);
        
        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        if (! empty($resultset)) {
            return $resultset;
        }
    }
    
    public function insert($query, $paramType, $paramArray)
    {
        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);
        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }
    
    public function execute($query, $paramType="", $paramArray=array())
    {
        $stmt = $this->conn->prepare($query);
        
        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $rs = $stmt->execute();
        if ($rs == false){
            echo "error:".$stmt->error;
        } else {
            echo $result->num_rows;
        }
    }
    
    public function bindQueryParams($stmt, $paramType, $paramArray=array())
    {
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }
    
    public function numRows($query, $paramType="", $paramArray=array())
    {
        $stmt = $this->conn->prepare($query);
        
        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;
        return $recordCount;
    }
}
