<?php

/**
 * Description of DataBase
 *
 * @author Sneider Rocha
 */
abstract class DataBase {

    const ORACLE = 1;
    const SQL_SERVER = 2;
    const MYSQL = 3;

    public static function getDatabaseObject($_type) {
        switch ($_type) {
            case DataBase::ORACLE:
                require_once('OracleDatabase.class.php');
                return new OracleDatabase();
                break;
            case DataBase::SQL_SERVER:
                require_once('SQLServerDatabase.class.php');
                return new SQLServerDatabase();
                break;
            case DataBase::MYSQL:
                require_once('MYSQLServerDatabase.class.php');
                return new MYSQLServerDatabase();
                break;
            default:
                require_once('SQLServerDatabase.class.php');
                return new SQLServerDatabase();
                break;
        }
    }

}
?>