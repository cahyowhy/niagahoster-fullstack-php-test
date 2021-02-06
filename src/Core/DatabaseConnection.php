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
                $db_name = ltrim($dbopts["path"], '/');
                $db_host = $dbopts['host'];
                $db_user = $dbopts['user'];
                $db_port = $dbopts['port'];
                $db_password = $dbopts['pass'];

                $db_url = sprintf(
                    "pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s",
                    $db_host,
                    $db_port,
                    $db_name,
                    $db_user,
                    $db_password
                );

                self::$instance->db_conn = new PDO($db_url);
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
