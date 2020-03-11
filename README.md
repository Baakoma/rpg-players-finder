# Wyszukiwarka graczy i sesji dla “papierowych” RPG-ów

Wyszukiwarka pomaga graczom znaleźć innych graczy bądź sesje RPG w których mogą wziąć udział. Jej zadaniem jest znalezienie i umożliwienie nawiązania kontaktu z osobami zainteresowanymi konkretnymi systemami. Graczę mogą tworzyć własne “pokoje” lub wyszukiwać już istniejące.

### Autorzy:
* Adrian Hopek *(PM/Frontend)*
* Damian Grzelak *(Backend)*
* Dawid Rudnik *(Backend)*


### Funkcjonalności:
- Profil gracza;
- Panel administratora;
- Tworzenie/zarządzanie pokojem;
- Wyszukiwanie pokoi i graczy przy pomocy filtrów;
- Możliwość zapraszania graczy do pokoju;
- Możliwość zgłaszania prośby o dołączenie do pokoju;
- System powiadomień;
- Przeglądanie historii rozegranych sesji;
- Komunikacja w pokoju poprzez chat;
- Recenzowanie gracza po rozegranej sesji (opcjonalne)
- Podstawowy system listy znajomych


## Stack technologiczny:
- PHP
- Laravel 7
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

