<?php class Place{

    private int $id;
    public readonly string $name;
    public readonly string $description;

    public function __construct(string $name, string $description){
        $this->name = $name;
        $this->description = $description;
    }   
}