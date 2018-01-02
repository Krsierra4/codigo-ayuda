<?php
/***
* Database Manage Class
* @author:Byron Martinez
* @version: 0.0.1
***/
class Database {
 
    //Database Properties Connection
    public $hostDB = 'localhost';
    public $userDB = 'root';
    public $passDB = '-';
    public $nameDB = 'ecommerce';
    protected $connection;
    //Query Properties
    protected $query;
    protected $results = array();
 
    /**
    * Create a New Connection with MySQL
    * @return object 
    **/
    public function newConnection()
    {
        $con = new mysqli($this->hostDB,$this->userDB,$this->passDB,$this->nameDB);
        if($con->connect_errno > 0)
        {
            echo "La Conexion A La Base de datos es incorrecta";
            return false;
        }
        else
        {
            $this->connection = $con;
        }
    }
    /**
    * Close the connection with the MySQL
    * @return bool
    **/
    public function closeConnection()
    {
        if(is_object($this->connection))
        {
            $this->connection->close();
        }
        else
        {
            echo "No hay ninguna conexion activa";
        }
    }
    /**
    * Make A Query 
    * @param query
    * @return bool
    **/
    public function makeQuery($query)
    {
        $this->newConnection();
        $query = $this->connection->query($query);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
        $this->closeConnection();
    }
    /**
    * Make a Query and return results
    * @return array
    **/
    public function resultsQuery($query)
    {
        $this->results = [];
        $this->newConnection();
        if($this->makeQuery($query))
        {
            $query = $this->connection->query($query);
            while($this->results[] = $query->fetch_assoc());
            array_pop($this->results);
            return $this->results;
        }
        else
        {
            return false;
        }
        $this->closeConnection();
    }
    /**
    * Get the num rows
    * @return integer
    **/
    public function numRows($query)
    {
        $this->newConnection();
        if($this->makeQuery($query))
        {
            $sql = $this->connection->query($query);
            return $sql->num_rows;
        }
        else
        {
            return false;
        }
        $this->closeConnection();
    }
 
}
?>
