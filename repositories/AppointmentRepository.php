<?php

require_once 'BaseRepository.php';

class AppointmentRepository extends BaseRepository {

    public function create(array $data): void {
        $sql = "INSERT INTO appointments
                (date, time, doctor_id, patient_id, reason, status)
                VALUES (?, ?, ?, ?, ?, 'scheduled')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['date'],
            $data['time'],
            $data['doctor_id'],
            $data['patient_id'],
            $data['reason']
        ]);
    }

    public function getAll(): array {
        return $this->db
            ->query("SELECT * FROM appointments")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser(int $userId): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM appointments
             WHERE patient_id = ? OR doctor_id = ?"
        );
        $stmt->execute([$userId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
