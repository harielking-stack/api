<?php

declare(strict_types=1);
date_default_timezone_set('Asia/Kolkata');
require_once './services/mail_service.php';
require_once './services/essentials.php';
require_once 'vendor/autoload.php'; // Include autoloader
require_once './controller/auth.php';
require_once './controller/user.php';
require_once './controller/post.php';
require_once './controller/follower.php';
require_once './controller/notifications.php';
require_once './controller/groups.php';

// use Firebase\JWT\JWT;
use Dotenv\Dotenv;

class Config
{
    public $db;
    public $dateTime;
    public function __construct()
    {
        $this->dateTime=date('Y-m-d H:i:s');
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        // Add your database connection parameters
        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_DATABASE'];
        $dbUser = $_ENV['DB_USERNAME'];
        $dbPass = $_ENV['DB_PASSWORD'];
        // Attempt to establish a connection
        $this->db = pg_connect("host=$dbHost dbname=$dbName user=$dbUser password=$dbPass");
        // Check if the connection was successful
        if (!$this->db) {
            // Connection failed, handle the error (you can customize error handling as needed)
            die("Connection failed: " . pg_last_error());
        }
    }

}
