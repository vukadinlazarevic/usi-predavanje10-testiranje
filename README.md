# Uputstvo za pokretanje projekta

1. Klonirajte repozitorijum:
   ```bash
   git clone https://github.com/vukadinlazarevic/usi-predavanje10-testiranje.git
   ```
2. Udjite u folder sa projektom
   ```bash
   cd usi-predavanje10-testiranje
   ```
3. Odradite instalaciju neophodnih paketa
   ```bash
   composer install
   ```
   a zatim
   ```bash
   npm install
   ```
4. Kopirajte .env.example fajl u .env
   ```bash
    cp .env.example .env
   ```
5. Migracija i seedovanje baze
   ```bash
   php artisan migrate:fresh --seed
   ```
6. Postavljanje kljuca za app
   ```bash
    php artisan key:generate
   ```
7. Pokrenite lokalni server:
   ```bash
    composer run dev
   ```
8. Ispratite zadatak i upustvo za kreiranje testova. 
