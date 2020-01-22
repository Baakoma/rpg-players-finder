# Wyszukiwarka graczy i sesji dla "papierowych" RPG

Wyszukiwarka pozwala graczom wyszukiwać innych graczy oraz sesji RPG, w których mogliby wziąć udział. Oczywiście, każdy z graczy może również utworzyć własne, publiczne wydarzenie (sesje) i zapraszać innych do niego lub czekać, aż chętni będą chcieli dołączyć. 

**Funkcjonalności:**
- profil gracza
- "zgłaszanie się" do bycia wyszukiwanym
- tworzenie i zarządzanie wydarzeniem
- zapraszanie innych graczy do wydarzenia
- zatwierdzanie (lub nie) próśb o dołączenie
- wyszukiwanie graczy na podstawie filtrów
- wyszukiwanie wydarzeń na podstawie filtrów
- przeglądanie listy dostępnych systemów RPG

## Stack technologiczny:
- PHP 7.3
- Laravel 6
- MySQL
- Vue 2
- Bulma

## Uruchomienie aplikacji w środowisku deweloperskim
**1. Pobranie projektu z repozytorium**

```
git clone -b develop https://github.com/Baakoma/rpg-players-finder.git
```
```
cd rpg-players-finder
```

**2. Pobranie zależności**

```
composer install
```

**3. Konfiguracja pliku .env**

```
cp .env.example .env
```

**4. Wygenerowanie kluczy**

```
php artisan key:generate
```

```
php artisan jwt:secret
```

**5. Migracja tabel w bazie danych i seed początkowych danych**

```
php artisan migrate --seed
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

