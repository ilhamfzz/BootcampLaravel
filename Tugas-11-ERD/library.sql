-- Description:
-- Sebuah Website Dimana user dapat  dimana setiap user melakukan penminjaman buku berdasarkan tanggal
 -- Ketentuan Website Perpustakaan:
-- Setiap user hanya dapat memliki satu profil
-- Setiap kategori memiliki banyak buku
-- Setiap user dapat memberikan melakukan peminjaman(borrows) dalam setiap buku, dan setiap buku dapat dipinjam(borrows) oleh user lain (table pivot)
 -- Requirement
-- Data di table user: id, name, email, password
-- Data di table profile : id, name, address, bio
-- Data di table categories : id, name
-- Data di table books : id, title, summary, release_year, stock
-- Data di table borrows: id, tanngal_peminjaman, tanggal_kembali

CREATE TABLE user (id INT PRIMARY KEY,
                                  name VARCHAR(255),
                                       email VARCHAR(255),
                                             password VARCHAR(255));


CREATE TABLE profile (id INT PRIMARY KEY,
                                     id_user INT, name VARCHAR(255),
                                                       address VARCHAR(255),
                                                               bio TEXT,
                      FOREIGN KEY (id_user) REFERENCES user(id),);


CREATE TABLE categories (id INT PRIMARY KEY,
                                        name VARCHAR(255));


CREATE TABLE books (id INT PRIMARY KEY,
                                   id_category INT, title VARCHAR(255),
                                                          summary TEXT, release_year INT, stock INT,
                    FOREIGN KEY (id_category) REFERENCES categories(id));


CREATE TABLE borrows (id INT PRIMARY KEY,
                                     id_user INT, id_book INT, tanggal_peminjaman DATE, tanggal_kembali DATE,
                      FOREIGN KEY (id_user) REFERENCES user(id),
                      FOREIGN KEY (id_book) REFERENCES books(id));