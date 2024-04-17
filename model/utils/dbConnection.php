<?php class DbConnection {
    private static $connection;

    private function __construct() {
        // Initialize the database connection here

    }

    public static function getConnection() {
        if (!self::$connection) {
            try{
                self::$connection = new PDO('mysql:dbname=tournois;host=127.0.0.1', "mariadb", "mariadb");
            } catch(PDOException $e){
                die ("DB Error".$e);
            }
        }

        return self::$connection;
    }

    public static function isUserAdmin(){
        if (! isset($_SESSION["user"])){
            return false;
        }

        $db = DbConnection::getConnection();
        $query = $db->prepare("SELECT count(*) FROM `admin` WHERE `user` =  ?");
        $query->bindParam(1,$_SESSION["user"]);
        $query->execute();
        $result =  $query->fetch();
        return $result["count(*)"] == 1;
    }

}