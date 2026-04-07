<h1 align="center">✨ Trendify — Modern E-Commerce Simulation</h1>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-Native-blue?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql">
  <img src="https://img.shields.io/badge/MVC-Architecture-purple?style=for-the-badge">
  <img src="https://img.shields.io/badge/PDT-Team%20Project-green?style=for-the-badge">
</p>

<p align="center">
  <b>Trendify</b> adalah aplikasi web e-commerce sederhana yang dikembangkan oleh tim untuk 
  mensimulasikan konsep <b>Pemrosesan Data Terdistribusi (PDT)</b> dengan fokus utama pada implementasi database.
</p>

---

## 🚀 Overview

Trendify merupakan project berbasis web yang dirancang untuk mengimplementasikan konsep-konsep penting dalam database secara nyata, seperti:

- View  
- Stored Procedure  
- Function  
- Transaction  
- Deadlock  

💡 Project ini lebih menekankan **logika dan pengolahan data** dibandingkan tampilan UI.

---

## 🎯 Key Features

### 🔐 Multi-Role Authentication
- Login sebagai **Admin** dan **User**
- Redirect otomatis sesuai role

### 🛍️ Product Management (Admin)
- Tambah, edit, hapus produk
- Menggunakan **Stored Procedure**

### 🛒 Shopping Cart (User)
- Tambah & hapus item
- Perhitungan total menggunakan **Function SQL**

### 💳 Checkout & Transaction
- Menggunakan:
  - BEGIN
  - COMMIT
  - ROLLBACK
- Validasi stok otomatis

### 📜 Transaction History
- Data diambil dari **Database View**
- Ditampilkan berdasarkan transaksi terbaru

### ⚠️ Deadlock Simulation (🔥 Highlight)
- Tombol ON/OFF simulasi deadlock
- Menampilkan skenario:
  - User 1 berhasil transaksi
  - User 2 gagal transaksi

---

## 🧠 Database Concepts

| Concept | Implementation |
|--------|--------|
| View | view_produk, view_transaksi |
| Stored Procedure | CRUD Produk |
| Function | hitung_total() |
| Transaction | Commit & Rollback |
| Deadlock | Simulasi Checkout |

---

## 🗂️ Project Structure

Trendify/
│
├── config/  
├── controller/  
├── model/  
├── view/  
├── database/  
├── assets/  
└── index.php  

📌 Menggunakan arsitektur **MVC (Native PHP)**

---

## ⚙️ Tech Stack

- PHP Native  
- MySQL / MariaDB  
- PDO  
- HTML, CSS, Bootstrap  

---

## 🛠️ Installation

1. Clone repository  
git clone https://github.com/kiisann/Trendify.git  

2. Pindahkan ke web server  
- htdocs (XAMPP)  
- www (Laragon)  

3. Import database  
Gunakan file: database/trendify0.sql  

4. Konfigurasi database  
Edit: config/koneksi.php  

5. Jalankan project  
http://localhost/Trendify/  

---

## 👤 Demo Accounts

Admin  
Email: Surya@gmail.com  
Password: 123  

Email: Fiki@gmail.com  
Password: 234  

User  
Email: Naura@gmail.com  
Password: 456  

Email: Iqlima@gmail.com  
Password: 345  

---

## 🔄 User Flow

Admin  
Login → Dashboard → Kelola Produk → Monitoring  

User  
Login → Lihat Produk → Keranjang → Checkout → Riwayat  

---

## 👥 Team Members

| Name | Role |
|------|------|
| Fiki Sulistiawan | Backend / Database |
| M. Surya Gymnastyar | Frontend |
| Iqlima | Frontend |
| Naura Azura | Frontend |

---

## 🎓 Project Purpose

Project ini dibuat untuk:

✔ Mengimplementasikan konsep Pemrosesan Data Terdistribusi  
✔ Memahami penggunaan transaction & concurrency  
✔ Menerapkan database dalam aplikasi nyata  
✔ Simulasi deadlock dalam sistem transaksi  

---

## ⚠️ Notes

- Fokus utama: **Database Implementation**
- UI dibuat sederhana
- Password masih plain text (hanya untuk pembelajaran)

---

## 🌟 Highlight

🔥 Simulasi Deadlock pada proses checkout  
Fitur ini menjadi nilai utama karena jarang diimplementasikan dalam project mahasiswa.

---

## 👨‍💻 Repository

https://github.com/kiisann/Trendify  

---

## 💡 Final Words

"Great systems are built on strong data, not just beautiful interfaces."

---

⭐ Support project ini dengan memberikan star!
