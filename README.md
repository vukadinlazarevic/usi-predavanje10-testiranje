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

# 📘 Uputstvo za GitHub Actions workflow – **Testovi**

Ovaj fajl predstavlja **GitHub Actions workflow** koji automatski pokreće testove za PHP (Laravel) aplikaciju svaki put kada se desi `push` ili `pull request` na bilo koju granu repozitorijuma.

---

## 📄 Naziv workflow-a

```yaml
name: Testovi
```

* Naziv workflow-a je **Testovi**
* Ovaj naziv će biti vidljiv u **GitHub → Actions** tabu

---

## 🚀 Okidači (Triggers)

```yaml
on:
  push:
    branches:
      - '*'
  pull_request:
    branches:
      - '*'
```

Workflow se pokreće u sledećim situacijama:

### ✅ `push`

* Svaki put kada se izvrši **push** na bilo koju granu (`*`)

### ✅ `pull_request`

* Svaki put kada se otvori ili ažurira **pull request** ka bilo kojoj grani

📌 Ovo osigurava da se testovi izvršavaju **uvek**, bez obzira na granu.

---

## 🧱 Poslovi (Jobs)

```yaml
jobs:
  test:
    runs-on: ubuntu-latest
```

* Definiše se jedan posao pod imenom **test**
* Posao se izvršava na **Ubuntu Linux** virtuelnoj mašini (najnovija verzija)

---

## 🪜 Koraci (Steps)

Svaki posao se sastoji iz više koraka koji se izvršavaju redom.

---

### 1️⃣ Preuzimanje koda (Checkout)

```yaml
- name: Proveru koda
  uses: actions/checkout@v4
```

📌 Ovaj korak:

* Klonira repozitorijum u GitHub runner
* Omogućava da sledeći koraci imaju pristup fajlovima projekta

---

### 2️⃣ Podešavanje PHP okruženja

```yaml
- name: Podesavanje PHP-a
  uses: shivammathur/setup-php@v2
  with:
    php-version: '8.4'
    extensions: json, curl, sqlite3
    coverage: none
```

📌 Ovaj korak:

* Instalira **PHP 8.4**
* Omogućava PHP ekstenzije:

    * `json`
    * `curl`
    * `sqlite3`
* Isključuje code coverage (ubrzava izvršavanje)

💡 SQLite se često koristi za testiranje u Laravel aplikacijama.

---

### 3️⃣ Keširanje Composer zavisnosti

```yaml
- name: Kes composer zavisnosti
  uses: actions/cache@v4
  with:
    path: vendor
    key: ${{ runner.os }}-composer-${{ hashFiles('**/composer.lock') }}
    restore-keys: |
      ${{ runner.os }}-composer-
```

📌 Ovaj korak:

* Kešira `vendor/` direktorijum
* Značajno ubrzava naredna pokretanja workflow-a

🔑 Ključ keša zavisi od:

* Operativnog sistema
* `composer.lock` fajla

Ako se `composer.lock` ne promeni → koristi se keš.

---

### 4️⃣ Instalacija Composer paketa

```yaml
- name: Instalacija composer paketa
  run: composer install --prefer-dist --no-progress --no-interaction
```

📌 Ovaj korak:

* Instalira sve PHP zavisnosti
* Koristi:

    * `--prefer-dist` → brža instalacija
    * `--no-progress` → čist log
    * `--no-interaction` → bez pitanja

---

### 5️⃣ Kreiranje `.env` fajla

```yaml
- name: Kopiranje .env.example u .env fajl
  run: cp .env.example .env
```

📌 Ovaj korak:

* Kreira `.env` fajl
* Neophodno za pokretanje Laravel aplikacije

---

### 6️⃣ Generisanje aplikacijskog ključa

```yaml
- name: Generisanje aplikacijskog kljuca
  run: php artisan key:generate
```

📌 Ovaj korak:

* Generiše `APP_KEY`
* Ključ je potreban za:

    * Enkripciju
    * Sesije
    * Validan rad aplikacije

---

### 7️⃣ Pokretanje testova

```yaml
- name: Pokretanje testova
  run: php artisan test
```

📌 Ovaj korak:

* Pokreće sve **Laravel testove** (Unit + Feature)
* Ako test padne → workflow se zaustavlja i označava kao ❌ failed

---

### 8️⃣ Provera da li server radi

```yaml
- name: Provera da li server radi
  run: |
    php artisan serve &
    sleep 3
    curl -s http://127.0.0.1:8000/advertisements | head -20
    echo "✅Server uspesno pokrenut!"
```

📌 Ovaj korak:

* Pokreće Laravel development server u pozadini
* Čeka 3 sekunde da se server podigne
* Šalje HTTP zahtev ka ruti `/advertisements`
* Ispisuje prvih 20 linija odgovora

🎯 Služi kao dodatna provera da aplikacija:

* Može da se pokrene
* Vraća validan HTTP odgovor

---

## ✅ Rezultat workflow-a

Ako su svi koraci uspešni:

* Workflow će biti označen kao **Passed** ✅

Ako bilo koji korak padne:

* Workflow se prekida
* GitHub prikazuje grešku ❌

---

## 🧠 Zaključak

Ovaj workflow omogućava:

* Automatsko testiranje koda
* Proveru Laravel aplikacije
* Sigurnije spajanje pull request-ova
* Stabilniji projekat

📌 Idealno za CI (Continuous Integration) u Laravel projektima.

