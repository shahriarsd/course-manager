# Course Manager

A simple *Laravel 11* application to manage courses, modules, and contents using a clean *Bootstrap 5* UI.  
This project is perfect for building or managing educational platforms or content management systems.

🔗 *Repository:* [https://github.com/shahriarsd/course-manager](https://github.com/shahriarsd/course-manager)

---

## 🚀 Features

- Course creation  
- Nested modules and contents under each course  
- Blade templating  
- Server-side validation  
- Paginated course listing  
- View individual course details  

---

## 🛠️ Tech Stack

- *Laravel 11*  
- *PHP 8.2+*  
- *Bootstrap 5*  
- *MySQL*  
- *Blade templates*  

---

## 📦 Installation & Setup

Follow these steps to run the project locally:

### 1. Clone the repository and navigate into it

```bash
git clone https://github.com/shahriarsd/course-manager.git
cd course-manager
composer install
cp .env.example .env
open .env and set your database details
php artisan key:generate
php artisan migrate
php artisan serve