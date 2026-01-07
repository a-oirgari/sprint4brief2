<?php
require_once 'BaseRepository.php';

class PrescriptionRepository extends BaseRepository {

    
    public function getByDoctor(int $doctorId): array {
        $stmt = $this->db->prepare(
            "SELECT 
                p.*, 
                m.name as medication_name,
                m.instructions as medication_instructions,
                pat.first_name as patient_first_name,
                pat.last_name as patient_last_name
             FROM prescriptions p
             LEFT JOIN medications m ON p.medication_id = m.id
             LEFT JOIN patients pat ON p.patient_id = pat.id
             WHERE p.doctor_id = ?
             ORDER BY p.date DESC"
        );
        $stmt->execute([$doctorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByPatient(int $patientId): array {
        $stmt = $this->db->prepare(
            "SELECT 
                p.*, 
                m.name as medication_name,
                m.instructions as medication_instructions,
                d.first_name as doctor_first_name,
                d.last_name as doctor_last_name,
                d.specialization as doctor_specialization
             FROM prescriptions p
             LEFT JOIN medications m ON p.medication_id = m.id
             LEFT JOIN doctors d ON p.doctor_id = d.id
             WHERE p.patient_id = ?
             ORDER BY p.date DESC"
        );
        $stmt->execute([$patientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(): array {
        $sql = "SELECT 
                p.*, 
                m.name as medication_name,
                d.first_name as doctor_first_name,
                d.last_name as doctor_last_name,
                pat.first_name as patient_first_name,
                pat.last_name as patient_last_name
             FROM prescriptions p
             LEFT JOIN medications m ON p.medication_id = m.id
             LEFT JOIN doctors d ON p.doctor_id = d.id
             LEFT JOIN patients pat ON p.patient_id = pat.id
             ORDER BY p.date DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): int {
        $sql = "INSERT INTO prescriptions 
                (date, doctor_id, patient_id, medication_id, dosage_instructions) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['date'],
            $data['doctor_id'],
            $data['patient_id'],
            $data['medication_id'],
            $data['dosage_instructions']
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM prescriptions WHERE id = ?");
        return $stmt->execute([$id]);
    }
}