<?php

use Dotenv\Dotenv;


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
     * Uses vendor/vlucas/phpdotenv to load .env variables
     */
    public static function make()
    {
        list($user, $password, $dsn) = self::loadEnv();
        try {
            return $pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die('Could not connect to the database \n Message:\n\n'.$e->getMessage());
        }
    }

    public static function loadEnv(): array
    {
        $dotenv = Dotenv::createImmutable(realpath(__DIR__.'/../'));
        // Load .env file from the root
        $dotenv->load();
        $host     = $_ENV['HOST'];
        $dbname   = $_ENV['DBNAME'];
        $user     = $_ENV['DBUSER'];
        $password = $_ENV['DBPASSWORD'];
        $dsn      = "mysql:host=$host;dbname=$dbname;charset=UTF8";

        return array($user, $password, $dsn);
    }
}