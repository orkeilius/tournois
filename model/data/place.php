<?php class Place{

    private int $id;
    protected string $name;
    protected string $description;

    public function __get($elem){
        return $this->$elem;
    }

    public function __construct(string $name, string $description, int $id= -1){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }   
    // -- repository
    public static function getAllPlace(): array
    {
        $db = DbConnection::getConnection();
        $statement = $db->query(
            "SELECT * FROM `place`"
        );
        $places = [];
        while (($row = $statement->fetch())) {
            $place = new Place(
                $row["name"],
                $row["description"],
                $row["place_id"]
            );

            $places[] = $place;
        }

        return $places;
    }

    public static function getPlaceById(int $id): Place
    {
        $db = DbConnection::getConnection();
        $query = $db->prepare("SELECT * FROM `place` WHERE `place_id` = ?");
        $query->execute([$id]);
        $row = $query->fetch();
        return new Place(
            $row["name"],
            $row["description"],
            $row["place_id"]
        );
    }

    public function save()
    {
        $db = DbConnection::getConnection();
        if ($this->id == -1) {
            $query = $db->prepare(
            "INSERT INTO `place` (`name`, `description`) VALUES (?, ?)" 
            );
            $query->execute(
            [
                $this->name,
                $this->description
            ]
            );
            DbConnection::getLastInseredId();
        } else {
            $query = $db->prepare(
            "UPDATE `place` SET `name` = ?, `description` = ? WHERE `place_id` = ?"
            );
            $query->execute(
            [
                $this->name,
                $this->description,
                $this->id
            ]
            );
        }
    }
    
    public static function deletePlaceById(int $id)
    {
        $db = DbConnection::getConnection();
        $query = $db->prepare("DELETE FROM `place` WHERE `place_id` = ?");
        $query->execute([$id]);
    }
}