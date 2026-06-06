# Home & Hostel Rental Management System

## Overview
This project is a simple rental management system with:

- User registration and login
- Search houses and hostels
- Property details and booking
- Property owner management
- Admin-style booking review

## Front-End
Includes static pages:

- `index.html`
- `login.html`
- `register.html`
- `houses.html`
- `hostels.html`
- `details.html`
- `contact.html`

Shared assets:

- `css/style.css`
- `js/script.js`

## Back-End (PHP)
Files:

- `index.php`
- `login.php`
- `register.php`
- `add_property.php`
- `view_property.php`
- `view_bookings.php`
- `booking.php`
- `contact.php`
- `logout.php`
- `db_connect.php`

## Database
The database schema is in `database.sql`.

### Create the database
1. Open phpMyAdmin or MySQL CLI.
2. Import `database.sql`.
3. Update `db_connect.php` if your MySQL credentials differ.

## Usage
- Open `index.html` or `index.php` in your browser.
- Register a new user or owner.
- Add properties via `add_property.php`.
- View all properties in `view_property.php`.
- Review bookings in `view_bookings.php`.

## Notes
- `contact.php` logs messages to `contact_messages.txt`.
- Property images are uploaded to the `images/` folder.
