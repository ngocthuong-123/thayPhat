<?php
class Database
{
    private $host='localhost';
    private $user='root';
    private $pass='';
    private $db='nguyenthingocthuong_2122110168_laptrinhweb';
    private $conn=null;
    function __construct()
    {
        $host_name=$this->host;
        $host_user=$this->user;
        $host_pass=$this->pass;
        $db_name=$this->db;
        $this->conn = new PDO("mysql:host=$host_name;dbname=$db_name", $host_user, $host_pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
    //all
    function getAll($sql){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //1
    function getOne($sql){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //Count
    function getCount($sql){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function insertDB($sql){
        $this->conn->exec($sql);
        $last_id = $this->conn->lastInsertId();
        return $last_id;
    }
    function updateDB($sql) {
        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute(); // This returns true on success, false on failure
        } catch (PDOException $e) {
            // Handle the error (log it, display an error message, etc.)
            return false;
        }
    }
    
    function deleteDB($sql){
        $this->conn->exec($sql);
    }
}

