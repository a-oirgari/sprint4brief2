<?php
require_once 'BaseRepository.php';

class UserRepository extends BaseRepository {
    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare(
            "SELECT id, email, password, role, first_name, last_name 
             FROM users WHERE email = ?"
        );
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}