# 🏨 Hotelingo - Hotel Booking Website

Hotelingo is a web-based reservation platform designed to simplify the booking process for hotel guests. Built using **PHP** and **MySQL**, it provides a seamless interface for users to register, browse room types (Regular, Suite, Elite), and manage their reservations in real-time.

## 📖 Project Overview
This project demonstrates a full-stack implementation of a booking system with **CRUD** (Create, Read, Update, Delete) capabilities. It allows users to:
* **Create** accounts and bookings.
* **Read** available room options and view their booking history.
* **Update** reservation dates or room preferences.
* **Delete** (Cancel) bookings if necessary.

**Developed by:** Group 4 (CCIT-FTUI)
* **Gafrilatif Aviandi Putra Adnanta**
* **Muhamad Farhan Budiana**

## 🛠️ Tech Stack
* **Frontend:** HTML5, CSS3
* **Backend:** Native PHP
* **Database:** MySQL
* **Tools:** XAMPP (Apache Server)

## ✨ Key Features
* **Authentication:** Secure Login and Registration pages.
* **Room Selection:** dedicated pages for browsing "Regular", "Suite", and "Elite" room classes.
* **User Dashboard:**
    * **Booked Rooms:** View active reservations with details like Check-in/Check-out dates.
    * **Edit Booking:** Modify stay duration or room type.
* []**Contact Page:** A dedicated section for customer support info.

## 🗄️ Database Structure
The system uses a database named `room_db` containing tables to store user and reservation data.

**Key Tables:**
* `users` (User credentials)
* `room_booking` (Reservation details: Guest Name, Room Type, Date In, Date Out)

## 🚀 Setup & Installation
1.  **Environment:** Install **XAMPP** or any PHP local server environment.
2.  **Clone:** Clone this repository to your `htdocs` folder.
3.  **Database Import:**
    * Open `localhost/phpmyadmin`.
    * Create a database named `room_db`.
    * Import the `.sql` file provided in the `database/` folder.
4.  **Run:** Open your browser and navigate to `http://localhost/Hotelingo`.

## 📸 Screenshots
*(Optional: Add screenshots of the Login Page, Room Selection, and Dashboard here)*

## 📄 License
This project was submitted as a Quarter 4 Project for the **CCIT-FTUI** program (August 2023).
