Nette - test
===========================

## Instalace

1. Spusťte Docker Desktop.
2. Přejděte do adresáře `.docker`
3. Spusťte v příkazové řádce `docker-compose -p example up -d --build --force-recreate`. 
4. Spusťte v příkazové řádce `docker exec example composer install`

Jestliže nenastane chyba je projekt nainstalovám a spuštěn

## Spuštění

1. Projekt se spouští příkazem `docker-compose -p example up`
2. URL adresa je `localhost`
3. URL adresa pro PHPMyAdmin `localhost:8080` (přihlašovací údaje: USER: test, PASSWORD: test, DATABASE: test)

## Vypnutí

1. Projekt se Vypíná příkazem `docker-compose -p example down`


## SQL

- SQL skript pro vytvoření tabbulky najdete ve složce app/db