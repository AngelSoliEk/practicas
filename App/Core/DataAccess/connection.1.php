<?php
namespace PRACTICA\Core\DataAccess;
abstract class Database
{
    protected   $conn;
    public      $db_config;
    private     $show_query;
    var         $statement;

    /*
    * create database connection
    */
    public function __construct()
    {
        if (empty($this->db_config)) {
            $this->db_config = parse_ini_file('configConnection.ini');
        }

        $this->conn = new \PDO("mysql:host={$this->db_config['db_host']};" .
                                "dbname={$this->db_config['db_name']}",
                                $this->db_config['db_user'],
                                $this->db_config['db_password']
                            );
        if($this->db_config['db_show_query']){
            $this->show_query=true;
        }

        $this->conn->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    function excuteQuery($query,$data=null)
    {
        if($this->show_query){
            $this->printQuery($query,$data);
        }

        try
        {
            $this->statement=$this->conn->prepare($query);

            $this->statement->execute($data);

            return $this->statement;
        }

        catch (PDOException $e){

        echo 'error:' .$e->getmessage().'<br/>';

        }
    }


    function printQuery ($query,$data)
    {
        $result=$query;
        foreach ($data as $field=>$value)
        {
            $result= str_replace($field,"'".$value."'",$result);
        }
        echo $result;
    }
}
?>