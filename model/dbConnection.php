<?php class DbConnection {
    private static $instance;
    public $db;

    private function __construct() {
        // Initialize the database connection here
        try{
            $this->db = new PDO('mysql:dbname=tournoi;host=127.0.0.1', "mariadb", "mariadb");
        } catch(PDOException $e){
            die ("DB Error".$e);
        }
    }

    public static function getConnection() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function isUserAdmin(){
        if (! isset($_SESSION["user"])){
            return false;
        }
        $query = $this->db->prepare("SELECT count(*) FROM `admin` WHERE `userName` =  ?");
        $query->bindParam(1,$_SESSION["user"]);
        $query->execute();
        $result =  $query->fetch();
        return $result == 1;
    }

}