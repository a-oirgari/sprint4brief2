<?php

class Medication {
    private int $id;
    private string $name;
    private string $instructions;

    public function getId(): int {
        return $this->id;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getInstructions(): string {
        return $this->instructions;
    }
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function setName(string $name): void {
        $this->name = $name;
    }
    
    public function setInstructions(string $instructions): void {
        $this->instructions = $instructions;
    }

}
