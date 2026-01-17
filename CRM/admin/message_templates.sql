CREATE TABLE IF NOT EXISTS message_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    type ENUM('email', 'sms') NOT NULL,
    subject VARCHAR(255),
    body TEXT NOT NULL,
    description VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_template (name, type)
);

-- Seed Default Templates
INSERT IGNORE INTO message_templates (name, type, subject, body, description) VALUES 
('appointment_confirmation', 'email', 'Booking Confirmed - Rani Beauty Clinic', 'Hi {{client_name}},<br><br>Your appointment for <strong>{{service_name}}</strong> has been confirmed for <strong>{{appointment_date}}</strong> at <strong>{{appointment_time}}</strong>.<br><br>We look forward to seeing you!<br><br>Best,<br>Rani Beauty Clinic', 'Sent to client providing appointment details.'),
('appointment_confirmation', 'sms', '', 'Hi {{client_name}}, your appt for {{service_name}} is confirmed for {{appointment_date}} @ {{appointment_time}}. See you soon! - Rani Beauty Clinic', 'SMS sent to client providing appointment details.'),
('appointment_reminder', 'email', 'Appointment Reminder - Rani Beauty Clinic', 'Hi {{client_name}},<br><br>This is a friendly reminder for your appointment tomorrow, <strong>{{appointment_date}}</strong> at <strong>{{appointment_time}}</strong>.<br><br>Please let us know if you need to reschedule.<br><br>Best,<br>Rani Beauty Clinic', 'Sent 24 hours before the appointment.'),
('appointment_reminder', 'sms', '', 'Reminder: You have an appt with us tomorrow {{appointment_date}} @ {{appointment_time}}. Reply C to confirm. - Rani Beauty Clinic', 'SMS reminder sent 24 hours before.');
