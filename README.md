# Multi-Currency Expense Management System

This project is a simplified expense management system that allows users to manage expenses in multiple currencies. It calculates and displays a summary of expenses in a selected base currency. The project demonstrates backend development with Laravel and frontend development with Vue.js & Inertia.js.

## Features

### Backend (Laravel)
- **Add Expenses**: Create an expense with a description, amount, and currency.
- **Fetch Expenses**: Retrieve all expenses with details [description, amount, currency, date].
- **Currency Summary**: Calculate total expenses in any base currency and provide a breakdown of amounts in all currencies.
- **Dynamic Currency Conversion**: Supports dynamic conversions for any base currency using predefined exchange rates.
- **Validation**: Ensures proper input for supported currencies and amounts in the backend.

### Frontend (Vue.js, Tailwind CSS)
- **Expense Management UI**
  - Responsive design for both desktop and mobile view.  
  - Form to add new expenses (description, amount, and currency).  
  - List of all added expenses.
- **Currency Summary View**:  
  - Dropdown to select a base currency.  
  - Display the total converted expenses and a breakdown by currency.
- **Real-time Updates**:  
  - Instant feedback for invalid inputs.  
  - Dynamic updates of expense summaries.

---
![image](https://github.com/user-attachments/assets/9f73a41b-9151-41ab-8eda-0adb0d06e765)
![image](https://github.com/user-attachments/assets/48c6a08e-d852-45e2-a130-f720f2851b95)
![image](https://github.com/user-attachments/assets/2ccf02f8-ef6b-4090-8666-cdb7d936a784)


## Installation and Setup

### Prerequisites
- PHP 8.2 or later
- Composer 2.8.1 or later
- Node.js 20 & npm 10.8.2 or higher


1. **Clone the Repository**
   ```bash
   git clone https://github.com/NahidHassanOfficial/ExpenseManagement.git
   cd ExpenseManagement
   ```
2. **Install Backend Dependencies**
   ```bash
   composer install
   ```
3. **Install Frontend Dependencies**
   ```bash
   npm install
   ```
4. **Environment Configuration**
   > Copy the .env.example file and rename it to .env
   ```bash
   cp .env.example .env
   ```
5. **Generate Key**
   ```bash
    php artisan key:generate
   ```
___

### Running Guide

1. **Migrate DB Tables**
   ```bash
   php artisan migrate
   ```
2. **Start the application**
   ```bash
   php artisan serve
   npm run dev
   ```
