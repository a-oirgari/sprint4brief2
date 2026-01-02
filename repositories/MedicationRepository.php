<?php

require_once 'BaseRepository.php';

class MedicationRepository extends BaseRepository {

    public function getAll(): array {
        return $this->db
            ->query("SELECT * FROM medications")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name, string $instructions): void {
        $stmt = $this->db->prepare(
            "INSERT INTO medications (name, instructions)
             VALUES (?, ?)"
        );
        $stmt->execute([$name, $instructions]);
    }
}
