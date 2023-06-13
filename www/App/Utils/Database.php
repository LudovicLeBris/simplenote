<?php

namespace App\Utils;

use \PDO;

class Database
{
    /**
     * PDO object for database connection
     *
     * @var PDO
     */
    private $dbh;

    /**
     * Static property to store unique instance object
     *
     * @var Database
     */
    private static $instance;

    /**
     * Constructor
     */
    private function __construct()
    {
        $configData = parse_ini_file(__DIR__ . '/../config.ini');

        try {
            $this->dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                    $configData['DB_USERNAME'],
                    $configData['DB_PASSWORD'],
                    array(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING)
            );
        } catch (\Exception $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage() . '<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }

    /**
     * Return in any case the $dbh property of the unique instance of Database
     *
     * @return PDO
     */
    public static function getPDO()
    {
        if (empty(self::$instance)) {
            self::$instance = new Database();
        }

        return self::$instance->dbh;
    }
}