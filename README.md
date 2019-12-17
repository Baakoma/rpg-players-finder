# Kreator postaci do Warhammer 4ed

Kreator postaci pozwala tworzyć i rozwijać bohaterów graczy. Mistrz gry tworzy pokoje, do których zaprasza swoich graczy. 
Każdy gracz może stworzyć jednego bohatera (postać) w pokoju. Mistrz gry może edytować bohaterów graczy, przyznawać im punkty doświadczenia.
Kreator nowych postaci pozwala w prosty i przyjemny sposób stworzyć nowego bohatera. Pilnuje on również wszystkich zasad i limitów. Rzuty
losowane są przy pomocy osobnego modułu do rzutu kośćmi - wszystko to dzieje się na serwerze, aby uniknąć oszustw.

## Stack technologiczny:
- PHP 7.3
- Laravel 6
- MySQL 5
- Vue 2
- Bootstsrap 4

## Organizacja pracy:
- uproszczony Kanban
- uproszczony GitFlow

---

### Strona testowa dostępna na: http://warhammer.usermd.net/

---

## Uruchomienie aplikacji w środowisku deweloperskim
**1. Pobranie projektu z repozytorium**

```
git clone -b develop https://github.com/Baakoma/warhammer-character-creator.git
```
```
cd warhammer-character-creator
```

**2. Pobranie zależności**

```
composer install
```

**3. Konfiguracja pliku .env**

```
cp .env.example .env
```

**4. Wygenerowanie klucza**

```
php artisan key:generate
```

**5. Migracja tabel w bazie danych i seed początkowych danych**

```
php artisan migrate --seed

php artisan jwt:secret
```

**6. Uruchomienie serwera deweloperskiego**

```
php artisan serve
```

**Aplikacja powinna być dostępna na:**

```
http://localhost:8000
```

**Laravel Telescope powinien być dostępny na:**

```
http://localhost:8000/telescope
```

