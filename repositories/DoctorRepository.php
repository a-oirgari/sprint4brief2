<?php

require_once 'BaseRepository.php';

class DoctorRepository extends BaseRepository {
    
    
    public function getAll(): array {
        $sql = "SELECT d.*, dep.name as department_name 
                FROM doctors d 
                LEFT JOIN departments dep ON d.department_id = dep.id 
                ORDER BY d.last_name, d.first_name";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("SELECT * FROM doctors WHERE email = ? LIMIT 1");
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
            "INSERT INTO doctors (first_name, last_name, email, specialization, phone, department_id)
             VALUES (?, ?, ?, NULL, NULL, NULL)"
        );
        $stmt->execute([$firstName ?: 'Inconnu', $lastName ?: 'Inconnu', $user['email']]);

        return (int) $this->db->lastInsertId();
    }
    

    public function getById(int $id): ?array {
        $stmt = $this->db->prepare(
            "SELECT d.*, dep.name as department_name 
             FROM doctors d 
             LEFT JOIN departments dep ON d.department_id = dep.id 
             WHERE d.id = ?"
        );
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    
    public function getByDepartment(int $departmentId): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM doctors WHERE department_id = ? 
             ORDER BY last_name, first_name"
        );
        $stmt->execute([$departmentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create(array $data): int {
        $sql = "INSERT INTO doctors 
                (first_name, last_name, specialization, phone, email, department_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['specialization'] ?? null,
            $data['phone'] ?? null,
            $data['email'] ?? null,
            $data['department_id'] ?? null
        ]);
        return (int) $this->db->lastInsertId();
    }
    
    public function update(int $id, array $data): bool {
        $sql = "UPDATE doctors SET 
                first_name = ?, 
                last_name = ?, 
                specialization = ?, 
                phone = ?, 
                email = ?, 
                department_id = ? 
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['specialization'] ?? null,
            $data['phone'] ?? null,
            $data['email'] ?? null,
            $data['department_id'] ?? null,
            $id
        ]);
    }
    
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM doctors WHERE id = ?");
        return $stmt->execute([$id]);
    }
}