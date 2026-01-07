<?php

require_once 'BaseRepository.php';

class PatientRepository extends BaseRepository {
    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM patients WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("SELECT * FROM patients WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function ensureFromUser(array $user): int {
        $existing = $this->findByEmail($user['email']);
        if ($existing) {
            return (int) $existing['id'];
        }

        $firstName = $user['first_name'] ?? 'Inconnu';
        $lastName = $user['last_name'] ?? 'Inconnu';

        $stmt = $this->db->prepare(
            "INSERT INTO patients (first_name, last_name, email, gender, date_of_birth, phone, address)
             VALUES (?, ?, ?, NULL, NULL, NULL, NULL)"
        );
        $stmt->execute([$firstName ?: 'Inconnu', $lastName ?: 'Inconnu', $user['email']]);

        return (int) $this->db->lastInsertId();
    }

    public function getAll(): array {
        $sql = "SELECT * FROM patients ORDER BY last_name, first_name";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
