<?php class User
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $country;
    private string $description;
    private Role $role;

    public function __get($elem)
    {
        return $this->$elem;
    }


    public function __construct(string $firstName, string $lastName, string $country, string $description, String $role,int $id= -1)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->country = $country;
        $this->description = $description;
        $this->role = Role::from($role);
    }
    

    // -- repository
    public static function getAllUser(): array
    {
        $db = DbConnection::getConnection();
        $statement = $db->query(
            "SELECT * FROM `user`"
        );
        $users = [];
        while (($row = $statement->fetch())) {
            $user = new User(
                $row["firstName"],
                $row["lastName"],
                $row["country"],
                $row["description"],
                $row["role"],
                $row["user_id"]
            );

            $users[] = $user;
        }

        return $users;
    }

    public static function getUserById(int $id): User
    {
        $db = DbConnection::getConnection();
        $query = $db->prepare("SELECT * FROM `user` WHERE `user_id` = ?");
        $query->execute([$id]);
        $row = $query->fetch();
        return new User(
            $row["firstName"],
            $row["lastName"],
            $row["country"],
            $row["description"],
            $row["role"],
            $row["user_id"]
        );
    }

    public function save()
    {
        $db = DbConnection::getConnection();
        if ($this->id == -1) {
            $query = $db->prepare(
                "INSERT INTO `user` (`firstName`, `lastName`, `country`, `description`, `role`) VALUES (?, ?, ?, ?, ?)" 
            );
            $query->execute(
                [
                    $this->firstName,
                    $this->lastName,
                    $this->country,
                    $this->description,
                    $this->role->value
                ]
            );
            $this->id = DbConnection::getLastInseredId();
        } else {
            $query = $db->prepare(
                "UPDATE `user` SET `firstName` = ?, `lastName` = ?, `country` = ?, `description` = ?, `role` = ? WHERE `user_id` = ?"
            );
            $query->execute(
                [
                    $this->firstName,
                    $this->lastName,
                    $this->country,
                    $this->description,
                    $this->role->value,
                    $this->id
                ]
            );
        }
    }
    
    public static function deleteUserById(int $id)
    {
        $db = DbConnection::getConnection();
        $query = $db->prepare("DELETE FROM `user` WHERE `user_id` = ?");
        $query->execute([$id]);
    }
}

enum Role: string
{
    case player = "player";
    case judge = "judge";

}