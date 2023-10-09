
# BEM FMIPA UNESA

applikasi berbasis web untuk keperluan BEM FMIPA UNESA



## Run Locally

Clone the project

```bash
  git clone https://github.com/linlaz/bemf_unesa.git
```

Go to the project directory

```bash
  cd bemf_unesa
```

Install dependencies composer and nodejs
```bash
  composer install
```
```bash
  npm install
```
Key generate
```bash
  php artisan key:generate
```
Create database in local and then 
```bash
  php artisan migrate
```
Seed database
```bash
php artisan db:seed
```
Run in locally must php and nodejs
```bash
  php artisan serve
```
```bash
  npm run dev
```
