<?php
class Appointment {
    private int $id;
    private string $date;
    private string $time;
    private int $doctorId;
    private int $patientId;
    private string $reason;
    private string $status;

    public function getId(): int {
        return $this->id;
    }
    
    public function getDate(): string {
        return $this->date;
    }
    
    public function getTime(): string {
        return $this->time;
    }
    
    public function getDoctorId(): int {
        return $this->doctorId;
    }
    
    public function getPatientId(): int {
        return $this->patientId;
    }
    
    public function getReason(): string {
        return $this->reason;
    }
    
    public function getStatus(): string {
        return $this->status;
    }
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function setDate(string $date): void {
        $this->date = $date;
    }
    
    public function setTime(string $time): void {
        $this->time = $time;
    }
    
    public function setDoctorId(int $doctorId): void {
        $this->doctorId = $doctorId;
    }
    
    public function setPatientId(int $patientId): void {
        $this->patientId = $patientId;
    }
    
    public function setReason(string $reason): void {
        $this->reason = $reason;
    }
    
    public function setStatus(string $status): void {
        $this->status = $status;
    }

}