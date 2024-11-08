# Upravené a aktualizované prostředí

Toto prostředí je upravené a aktualizované z [repozitáře](https://github.com/marek-sterzik/spsostrov-php-runtime). Jedná se o aplikaci, která využívá **Symfony**, **MySQL** a **Node.js** pro kompilaci JavaScriptu. Celá aplikace běží v **Docker kontejnerech**.

## Ovládání aplikace

Pro běh aplikace je možné nastavit port. Toto nastavení je nutné měnit pouze v případě potřeby změny portu, jelikož se ukládá.
```shell
bin/docker configure
```

### Spuštění, zastavení a restartování aplikace/kontejnerů
- Spuštění: `bin/docker up`
- Zastavení: `bin/docker down`
- Restartování: `bin/docker restart`

### Inicializace prostředí
```shell
bin/docker init
```
Tento příkaz stáhne balíčky **yarn** a **composer**, zkompiluje JavaScript, provede migrace databáze a připraví prostředí. Tento krok je nutné provést při prvotní instalaci a následně jen při úpravách aplikace, jako je změna balíčků composeru nebo yarnu.

### Kompilace JavaScriptu
- Do složky `js/` lze přidat JavaScript, který se má zkompilovat (například skripty platné pro všechny stránky).
- Kompilace JS:
  ```shell
  bin/jscompile
  ```
- Kompilace JS s automatickým hlídáním změn:
  ```shell
  bin/jscompile --watch
  ```

---

## Práce s databází

### Vytvoření a úprava entit
- Pro vytvoření entity:
  ```shell
  bin/console make:entity
  ```
  Po vytvoření entity můžete přidat pole a upravit entity soubor.

### Migrace databáze
- Vytvoření migrace na základě změn:
  ```shell
  bin/console make:migration
  ```
- Aplikace migrací:
  ```shell
  bin/console doctrine:migrations:migrate
  ```

### Úvodní data a reset databáze
- Skript pro nahrání úvodních dat se nachází v souboru `src/Command/LoadInitialDataCommand.php`. Lze zde přidat například základního uživatele nebo placeholder data.
  ```shell
  bin/console LoadInitialData
  ```
  Tento příkaz nahraje úvodní data.

- Reset databáze:
  ```shell
  bin/docker db-reset
  ```
  Tento příkaz vymaže celou databázi, znovu ji vytvoří, provede migrace a nahraje úvodní data.

---

## Základní obsah prostředí

### AbstractController
- **Custom AbstractController** obsahuje několik sdílených funkcí a podporuje dependency injection.

### Popups
- Implementace jednoduchých popupů.

### Exception Listenery
- Exception listenery pro zpracování response výjimek.

### Email Service
- Stačí nastavit e-mail v souboru `.env` a nastavit adresu, odkud má e-mail přicházet, v `src/Service/EmailService.php`. Poté lze snadno odesílat e-maily pomocí `$emailService->sendEmail()`.
