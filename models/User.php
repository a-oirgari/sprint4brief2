<?php
abstract class User {
    protected int $id;
    protected string $email;
    protected string $password;
    protected string $role;

    
    public function getId(): int {
        return $this->id;
    }
    
    public function getEmail(): string {
        return $this->email;
    }
    
    public function getRole(): string {
        return $this->role;
    }
    
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    
    public function setRole(string $role): void {
        $this->role = $role;
    }
}