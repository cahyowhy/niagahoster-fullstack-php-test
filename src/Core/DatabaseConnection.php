<?php

namespace NiagahosterTest\Core;

use \PDO;
use \PDOException;

class DatabaseConnection
{
    private static $instance;
    private $db_conn;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();

            try {
                $dbopts = parse_url(getenv('DATABASE_URL'));

                $db_name = $dbopts['DB_NAME'];
                $db_host = $dbopts['host'];
                $db_user = $dbopts['user'];
                $db_port = $dbopts['port'];
                $db_password = $dbopts['pass'];

                //postgres://YourUserName:YourPassword@YourHostname:5432/YourDatabaseName
                self::$instance->db_conn = new PDO("postgres://" . $db_user . ":" . $db_password . "@" . $db_host . ":" . $db_port . "/" . $db_name);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->db_conn;
    }
}
