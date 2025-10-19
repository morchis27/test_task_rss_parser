# Test Task

## Prerequisites

- Docker Desktop
- Git
- A terminal (WSL2 for Windows)

---

## Project Structure

```
docker/
  php/
    Dockerfile
    init_script.sh
  nginx/
    nginx.conf
docker-compose.yml

```

Laravel’s application files are located directly in the project root.  
The containers mount this folder to `/var/www/html`.

---

## Stack Used

- PHP 8.3-FPM w/ Laravel
- Nginx 
- PostgreSQL 16 

---

## First Run

```bash
docker compose up -d --build
```

If this is a new project, Laravel will be automatically installed inside the container.  
The application is being mapped to host's 8080(unless changed) [http://localhost:8080](http://localhost:8080).

To stop everything:


---

## Environment Configuration

We have default `.env.example` set up in the repository, you should copy it and input the values that would be used for development.

To change values of where the container maps on host's PC use this two values:
```env
APP_HOST_PORT=8080
DB_HOST_PORT=5432
```

---

## Permissions

If you see errors like:

> Failed to open stream: Permission denied

Run inside the container(don't do this in production):

```bash
docker compose exec php sh -lc '
  chmod -R 777 storage bootstrap/cache
'
```

On Windows, consider moving the project to WSL  

---

## Database

You can connect to Postgres from your host using:

```
Host: localhost
Port: 5432
User: postgres
Password: password
Database: db
```

---

## Rebuilding

If you make changes to Dockerfiles or configs:

```bash
docker compose down -v
docker compose build --no-cache
docker compose up -d
```

---

## Auth

This application includes a basic Auth using Sanctum as it's engine. We issue a token to a user and the backend uses it to check whether or not user is authenticated to make this API call.

## Summary

You now have a working Laravel development stack powered by Docker:

- Nginx listens to outside requests and forwards to `php:9000`
- PHP-FPM runs Laravel
- PostgreSQL stores your data
- All containers defined in one Composer file

