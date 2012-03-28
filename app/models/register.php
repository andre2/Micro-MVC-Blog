<?php

class Register_Model
{
	
	private $conn;
	
	public function __construct()
	{
		$this->conn = new Database(DBUSER, DBPASS, DBNAME);
	}

    public function add_user($userdata)
    {
        $sql = 'INSERT INTO users (';
        $size = count($userdata);
        $count = 0;
        foreach($userdata as $field=>$value)
        {
            $sql .= "$field";

            if($count < ($size-1))
                $sql .= ',';
            $count++;
        }
        $sql .= ') VALUES (';
        $count = 0;
        foreach($userdata as $field=>$value)
        {
            $sql .= ":$field";

            if($count < ($size-1))
                $sql .= ',';
            $count++;
        }
        $sql .= ')';

        $this->conn->query($sql);

        foreach($userdata as $field=>$value)
            $this->conn->bind(":$field", $value);

        $this->conn->execute();
    }

}