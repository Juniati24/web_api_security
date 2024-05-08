Pertama - tama siapkan servernya seperti XAMPP/Laragon

Menyiapkan database 
Buat table :
CREATE TABLE admin (id_user int(11) NOT NULL PRIMARY 
KEY AUTO_INCREMENT,
nama varchar(255) NOT NULL,
password varchar(255) NOT NULL,
key_token varchar(255) NOT NULL
)

Masukkan user:
INSERT INTO admin (id_user, nama, password, key_token) VALUES 
(NULL, 'Juni', 'juni', MD5('123'));
