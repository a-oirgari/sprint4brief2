INSERT INTO departments (name, location) VALUES
('Cardiology', 'Building A - Floor 2'),
('Neurology', 'Building B - Floor 3'),
('Pediatrics', 'Building C - Floor 1'),
('Orthopedics', 'Building A - Floor 4'),
('Emergency', 'Main Building - Ground Floor');

INSERT INTO doctors (first_name, last_name, specialization, phone, email, department_id) VALUES
('Jean', 'Martin', 'Cardiologist', '0612345678', 'jean.martin@hospital.com', 1),
('Sophie', 'Durand', 'Neurologist', '0623456789', 'sophie.durand@hospital.com', 2),
('Lucas', 'Petit', 'Pediatrician', '0634567890', 'lucas.petit@hospital.com', 3),
('Emma', 'Leroy', 'Orthopedic Surgeon', '0645678901', 'emma.leroy@hospital.com', 4),
('Nicolas', 'Bernard', 'Emergency Physician', '0656789012', 'nicolas.bernard@hospital.com', 5);

INSERT INTO patients (first_name, last_name, gender, date_of_birth, phone, email, address) VALUES
('Paul', 'Dupont', 'M', '1985-04-12', '0701020304', 'paul.dupont@mail.com', '12 rue de Paris, Lyon'),
('Marie', 'Lefevre', 'F', '1992-09-23', '0702030405', 'marie.lefevre@mail.com', '45 avenue Victor Hugo, Paris'),
('Thomas', 'Moreau', 'M', '1978-01-30', '0703040506', 'thomas.moreau@mail.com', '8 boulevard Carnot, Lille'),
('Camille', 'Roux', 'F', '2000-06-15', '0704050607', 'camille.roux@mail.com', '22 rue Nationale, Bordeaux'),
('Alex', 'Renard', 'Other', '1995-11-05', '0705060708', 'alex.renard@mail.com', '3 place Bellecour, Lyon');

INSERT INTO medications (name, instructions) VALUES
('Paracetamol', 'Take one tablet every 6 hours after meals'),
('Ibuprofen', 'Take with food, maximum 3 tablets per day'),
('Amoxicillin', 'Complete the full course as prescribed'),
('Metformin', 'Take twice daily with meals'),
('Ventolin', 'Use inhaler when experiencing breathing difficulties');

INSERT INTO appointments (date, time, doctor_id, patient_id, reason, status) VALUES
('2025-01-10', '09:30:00', 1, 1, 'Chest pain consultation', 'done'),
('2025-01-12', '11:00:00', 2, 2, 'Recurring headaches', 'scheduled'),
('2025-01-15', '14:00:00', 3, 3, 'Child fever follow-up', 'done'),
('2025-01-18', '10:15:00', 4, 4, 'Knee pain', 'scheduled'),
('2025-01-20', '16:45:00', 5, 5, 'Emergency check after accident', 'cancelled');

INSERT INTO prescriptions (date, doctor_id, patient_id, medication_id, dosage_instructions) VALUES
('2025-01-10', 1, 1, 1, '500mg every 6 hours for 3 days'),
('2025-01-12', 2, 2, 2, '400mg twice a day for 5 days'),
('2025-01-15', 3, 3, 3, '250mg three times a day for 7 days'),
('2025-01-18', 4, 4, 1, '500mg if pain persists'),
('2025-01-20', 5, 5, 5, '2 puffs when needed');

