<?php

/**
 * Description of DataBase
 *
 * @author Sneider Rocha
 */
abstract class DataBase
{

    const ORACLE = 1;
    const SQL_SERVER = 2;
    const MYSQL = 3;

    public static function getDatabaseObject($_type)
    {
        switch ($_type) {            
            case DataBase::MYSQL:
                require_once('MYSQLServerDatabase.class.php');
                return new MYSQLServerDatabase();
                break;
            default:
                require_once('MYSQLServerDatabase.class.php');
                return new MYSQLServerDatabase();
                break;
        }
    }
}
