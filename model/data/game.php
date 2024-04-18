<?php 
require_once "model/data/user.php";
require_once "model/data/place.php";    

class Game
{
    private int $id;
    private array $player;
    private User $judge;
    private Place $place;
    private DateTime $date;
    private array $score;

    public function __get($elem)
    {
        return $this->$elem;
    }

    public function __construct(array $player, User $judge, Place $place, DateTime $date, int $id = -1, array $score = array(null, null))
    {
        if ($player[0]->role != Role::player or $player[1]->role != Role::player) {
            throw new Exception("player invalid role");
        }
        if ($judge->role != Role::judge) {
            throw new Exception("judge invalid role");
        }
        if ($player[0] == $player[1] and $player[0]->id != -1) {
            throw new Exception("duplicate player");
        }

        $this->id = $id;
        $this->player = $player;
        $this->judge = $judge;
        $this->place = $place;
        $this->date = $date;
        $this->score = $score;
    }

    public function setScore(array $score)
    {
        $this->score = $score;
    }

    // -- repository
    public static function getAllGame(): array
    {
        $db = DbConnection::getConnection();
        $statement = $db->query(
            "SELECT * FROM `game`"
        );
        $games = [];
        while (($row = $statement->fetch())) {
            $game = new Game(
                array(
                    User::getUserById($row["player1"]),
                    User::getUserById($row["player2"])
                ),
                User::getUserById($row["judge"]),
                Place::getPlaceById($row["place"]),
                new DateTime($row["date"]),
                $row["game_id"],
                array(
                    $row["score1"],
                    $row["score2"]
                )
            );

            $games[] = $game;
        }

        return $games;
    }
    public static function getGameById(int $id): Game
    {
        $db = DbConnection::getConnection();
        $query = $db->prepare("SELECT * FROM `game` WHERE `game_id` = ?");
        $query->execute([$id]);
        $row = $query->fetch();
        return new Game(
            array(
                User::getUserById($row["player1"]),
                User::getUserById($row["player2"])
            ),
            User::getUserById($row["judge"]),
            Place::getPlaceById($row["place"]),
            new DateTime($row["date"]),
            $row["game_id"],
            array(
                $row["score1"],
                $row["score2"]
            )
        );
    }

    public function save()
    {
        $db = DbConnection::getConnection();
        if ($this->id == -1) {
            $query = $db->prepare(
                "INSERT INTO `game` (`player1`, `player2`, `judge`, `place`, `date`, `score1`, `score2`) VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $query->execute(
                [
                    $this->player[0]->id,
                    $this->player[1]->id,
                    $this->judge->id,
                    $this->place->id,
                    $this->date->format('Y-m-d H:i:s'),
                    $this->score[0],
                    $this->score[1]
                ]
            );
            DbConnection::getLastInseredId();
        } else {
            $query = $db->prepare(
                "UPDATE `game` SET `player1` = ?, `player2` = ?, `judge` = ?, `place` = ?, `date` = ?, `score1` = ?, `score2` = ? WHERE `game_id` = ?"
            );
            $query->execute(
                [
                    $this->player[0]->id,
                    $this->player[1]->id,
                    $this->judge->id,
                    $this->place->id,
                    $this->date->format('Y-m-d H:i:s'),
                    $this->score[0],
                    $this->score[1],
                    $this->id
                ]
            );
        }
    }

    public static function deleteGameById(int $id)
    {
        $db = DbConnection::getConnection();
        $query = $db->prepare("DELETE FROM `game` WHERE `game_id` = ?");
        $query->execute([$id]);
    }

}