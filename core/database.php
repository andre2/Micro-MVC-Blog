<?php

/* --- USAGE ----------------------------------
// Establish a connection.
$db = new DB('user', 'password', 'database');

// Create query, bind values and return a single row.
$row = $db->query('SELECT col1, col2, col3 FROM mytable WHERE id > ? LIMIT ?')
   ->bind(1, 2)
   ->bind(2, 1)
   ->single();

// Update the LIMIT and get a resultset.
$db->bind(2,2);
$rs = $db->resultset();

// Create a new query, bind values and return a resultset.
$rs = $db->query('SELECT col1, col2, col3 FROM mytable WHERE col2 = ?')
   ->bind(1, 'abc')
   ->resultset();

// Update WHERE clause and return a resultset.
$db->bind(1, 'def');
$rs = $db->resultset();
----------------------------------------------- */

class Database
{

    private $dbh; // connection handle
    private $stmt; // current statement

    public function __construct($user, $pass, $dbname) 
	{
        $this->dbh = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($query) 
	{
        $this->stmt = $this->dbh->prepare($query);
        return $this;
    }

    public function bind($pos, $value, $type = null) 
	{
        if( is_null($type) ) 
		{
            switch( true ) 
			{
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($pos, $value, $type);
        return $this;
    }

    public function execute() 
	{
        try {
            $result = $this->stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function resultset() 
	{
        $this->execute();
        try {
            $result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function single() 
	{
        $this->execute();
        try {
            $result = $this->stmt->fetch(PDO::FETCH_OBJ);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function quote($value)
    {
        return $this->dbh->quote($value);
    }
	
	public function disconnect()
	{
		$this->dbh = null;
	}
	
	public function __destruct()
	{
		$this->disconnect();
	}
	
}