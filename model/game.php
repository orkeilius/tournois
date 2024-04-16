<?php class Game{
    private int $id;
    public readonly Player $player1;
    public readonly Player $player2;
    public readonly Player $judge;
    public readonly Place $place;
    public readonly string $date;
    public readonly Array $score;
    
    public function __construct(Player $player1, Player $player2, Player $judge, Place $place, string $date, Array $score = null){
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->judge = $judge;
        $this->place = $place;
        $this->date = $date;
        $this->score = $score;
    }

    public function setScore(Array $score){
        if ($this->score == null){
            $this->score = $score;
        }else{
            throw new Exception("Score already set");
        }
    }
}