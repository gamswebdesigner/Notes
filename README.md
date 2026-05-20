# Notes — Laravel 12 + Blade

A simple note-taking application built to practice and demonstrate CRUD operations with Laravel and Blade.

---

## Stack

| Layer    | Technology                       |
| -------- | -------------------------------- |
| Backend  | Laravel 12, SQLite, Eloquent ORM |
| Frontend | Blade, Bootstrap 5               |
| Auth     | Laravel Auth (session-based)     |

---

## Features

- User authentication (login / logout)
- Create, read, update and delete notes
- Notes scoped to authenticated user
- ID obfuscation via base64 encoding
- Session-based flash messages (success / error)
- Server-side validation

---

## Route Structure

| Method | URL                 | Name         | Description           |
| ------ | ------------------- | ------------ | --------------------- |
| GET    | `/`                 | `home`       | List all user notes   |
| GET    | `/note/new`         | `newNote`    | New note form         |
| GET    | `/note/edit/{id}`   | `editNote`   | Edit note form        |
| POST   | `/save/{id?}`       | `save`       | Create or update note |
| GET    | `/note/delete/{id}` | `deleteNote` | Delete note           |
| GET    | `/login`            | `login`      | Login form            |
| POST   | `/login`            | —            | Authenticate user     |
| POST   | `/logout`           | `logout`     | Logout                |

---

## Database Schema

```
users ──> notes
```

- `users` — default Laravel users table
- `notes` — `id`, `user_id`, `title`, `text`, `timestamps`
- Foreign key `user_id` scopes notes to their owner

---

## Concepts Covered

| Concept        | Application                                              |
| -------------- | -------------------------------------------------------- |
| CRUD           | Full create, read, update, delete flow                   |
| Authentication | Session-based login with Laravel Auth                    |
| Authorization  | Users can only edit and delete their own notes           |
| Blade          | Layouts, sections, includes, conditionals                |
| Validation     | Server-side with error display                           |
| Eloquent       | Relationships, `findOrFail`, `where`, `update`, `create` |
| Flash messages | Success and error feedback via session                   |
| ID obfuscation | Base64 encoding to avoid exposing raw IDs in URLs        |

---

## How to Run

```bash
git clone https://github.com/SEU_USER/notes-laravel.git
cd notes-laravel
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```

Access at `http://localhost:8000`

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php
│   └── NoteController.php
├── Models/
│   ├── Note.php
│   └── User.php
└── Services/
    └── Operations.php     # ID encryption/decryption
resources/views/
├── layouts/
│   └── main_layout.blade.php
├── auth/
│   └── login.blade.php
├── home.blade.php
├── note.blade.php
└── header.blade.php
```
