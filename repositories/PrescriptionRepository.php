<?php

require_once 'BaseRepository.php';

class PrescriptionRepository extends BaseRepository {

    public function getByDoctor(int $doctorId): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM prescriptions WHERE doctor_id = ?"
        );
        $stmt->execute([$doctorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByPatient(int $patientId): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM prescriptions WHERE patient_id = ?"
        );
        $stmt->execute([$patientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
