<?php
// repositories/AppointmentRepository.php
require_once 'BaseRepository.php';

class AppointmentRepository extends BaseRepository {

    /**
     * Créer un nouveau rendez-vous
     */
    public function create(array $data): int {
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
        return (int) $this->db->lastInsertId();
    }

    /**
     * Récupérer tous les rendez-vous avec détails (pour admin)
     */
    public function getAll(): array {
        $sql = "SELECT 
                a.*,
                d.first_name as doctor_first_name,
                d.last_name as doctor_last_name,
                d.specialization as doctor_specialization,
                p.first_name as patient_first_name,
                p.last_name as patient_last_name
             FROM appointments a
             LEFT JOIN doctors d ON a.doctor_id = d.id
             LEFT JOIN patients p ON a.patient_id = p.id
             ORDER BY a.date DESC, a.time DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupérer les rendez-vous d'un utilisateur (patient ou médecin)
     */
    public function getByUser(int $userId): array {
        $stmt = $this->db->prepare(
            "SELECT 
                a.*,
                d.first_name as doctor_first_name,
                d.last_name as doctor_last_name,
                d.specialization as doctor_specialization,
                p.first_name as patient_first_name,
                p.last_name as patient_last_name
             FROM appointments a
             LEFT JOIN doctors d ON a.doctor_id = d.id
             LEFT JOIN patients p ON a.patient_id = p.id
             WHERE a.patient_id = ? OR a.doctor_id = ?
             ORDER BY a.date DESC, a.time DESC"
        );
        $stmt->execute([$userId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupérer un rendez-vous par ID
     */
    public function getById(int $id): ?array {
        $stmt = $this->db->prepare(
            "SELECT 
                a.*,
                d.first_name as doctor_first_name,
                d.last_name as doctor_last_name,
                p.first_name as patient_first_name,
                p.last_name as patient_last_name
             FROM appointments a
             LEFT JOIN doctors d ON a.doctor_id = d.id
             LEFT JOIN patients p ON a.patient_id = p.id
             WHERE a.id = ?"
        );
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Mettre à jour le statut d'un rendez-vous
     */
    public function updateStatus(int $id, string $status): bool {
        $stmt = $this->db->prepare(
            "UPDATE appointments SET status = ? WHERE id = ?"
        );
        return $stmt->execute([$status, $id]);
    }

    /**
     * Supprimer un rendez-vous
     */
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM appointments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}