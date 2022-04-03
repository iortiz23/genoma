<?php

require_once('DataBase.interface.php');

/**
 * Description of MYSQLServerDatabase
 *
 * @author Sneider Rocha
 */
class MYSQLServerDatabase implements IDataBase {

    var $host = "localhost";
    var $database = "dupontegenoma";
    var $user = "root";
    var $pass = "";
    //var $host = "localhost";
    //var $database = "u442104993_genoma";
    //var $user = "u442104993_genoma";
    //var $pass = "TJeTNI9p?U";



    var $conn;
    var $numRows;

    function __construct() {
        $this->conectar($this->host, $this->user, $this->pass, $this->database);
    }

    public function conectar($_host, $_user, $_password, $_database) {
        $this->conn = mysqli_connect($_host, $_user, $_password) or die(mysqli_error());
        mysqli_select_db($this->conn, $this->database) or die(mysqli_error());
    }

    function query($sql) {
        $result = mysqli_query($this->conn, $sql) or die(mysqli_error());
        return $result;
    }

    function queryArray($sql) {
        $result = mysqli_query($this->conn, $sql) or die(mysqli_error());
        $resultados = array();
        while ($row = mysqli_fetch_array($result))
            $resultados[] = $row;
        return $resultados;
    }

    function exportQuery($sql) {
        $result = mysqli_query($this->conn, $sql) or die(mysqli_error());
        return $result;
    }

    function nonReturnQuery($sql) {
        mysqli_query($this->conn, $sql) or die(mysqli_error());
    }

}

?>