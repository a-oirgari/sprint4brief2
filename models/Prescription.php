<?php

class Prescription {
    private int $id;
    private string $date;
    private int $doctorId;
    private int $patientId;
    private int $medicationId;
    private string $dosageInstructions;

    public function getId(): int {
        return $this->id;
    }
    
    public function getDate(): string {
        return $this->date;
    }
    
    public function getDoctorId(): int {
        return $this->doctorId;
    }
    
    public function getPatientId(): int {
        return $this->patientId;
    }
    
    public function getMedicationId(): int {
        return $this->medicationId;
    }
    
    public function getDosageInstructions(): string {
        return $this->dosageInstructions;
    }
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function setDate(string $date): void {
        $this->date = $date;
    }
    
    public function setDoctorId(int $doctorId): void {
        $this->doctorId = $doctorId;
    }
    
    public function setPatientId(int $patientId): void {
        $this->patientId = $patientId;
    }
    
    public function setMedicationId(int $medicationId): void {
        $this->medicationId = $medicationId;
    }
    
    public function setDosageInstructions(string $dosageInstructions): void {
        $this->dosageInstructions = $dosageInstructions;
    }
}
