-- Example hashed password (replace with the actual hashed password you generated)
SET @hashedPassword = '$2a$10$UZpb0QZAFtptkWpEP8IzdOk6397k/NLWwOE5tG8JRdefv0/ERCrJm';

-- Insert an admin user
INSERT INTO users (username, password, role) VALUES ('admin', @hashedPassword, 'ROLE_ADMIN');

-- Insert a regular user
INSERT INTO users (username, password, role) VALUES ('user', @hashedPassword, 'ROLE_USER');
