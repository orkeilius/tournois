<?php class Player{
    private int $id;
    public readonly string $firstName; 
    public readonly string $lastName;
    public readonly string $contry;
    public function __construct(string $firstName, string $lastName, string $contry){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->contry = $contry;
    }
}