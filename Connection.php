<?php

/**
 * Creates a connection to the database using PDO
 *
 * This class can be called staticly.
 *
 * Ex: Connection::make();
 */
class Connection
{
    /**
     * Uses vendor/vlucas/phpdotenv to laod .env variables
     */
    public static function make()
    {
        define("DIR_VENDOR", __DIR__.'/vendor/autoload.php');
        if (file_exists(DIR_VENDOR)) {
            require_once(DIR_VENDOR);
        }

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        // Load .env file from the root
        $dotenv->load();
        $host     = $_ENV['HOST'];
        $dbname   = $_ENV['DBNAME'];
        $user     = $_ENV['DBUSER'];
        $password = $_ENV['DBPASSWORD'];
        $dsn      = "mysql:host=$host;dbname=$dbname;charset=UTF8";
        try {
            return $pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die('Could not connect to the database \n Message:\n\n'.$e->getMessage());
        }
    }
}