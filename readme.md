# Egyszerűsített Pontszámító Kalkulátor – Használati Útmutató
## PHP >= 8.2 ez 8.3-mal készült.

 [GIT REPO](https://github.com/Klinet/epk-app-php)

## Telepítés és futtatás
A projekt **Composer alapú**, ezért az alábbi lépéseket kell követni:

## Projekt függőségeinek telepítése
- **composer install
- 
## Alap teszt amely csak a kontrollert futtaja és az eredményból egy tanulónyit ad vissza
vendor/bin/phpunit --testdox tests/Functional/Controllers/PontszamControllerTest.php

## Autoload frissítése (ha új fájlokat adtunk hozzá)
- composer dump-autoload

# A program futtatása
## php index.php

## Mit teszt az alkalmazás?
Az alkalmazás egy **egyszerűsített pontszámító kalkulátor**, amely a hallgatók érettségi eredményei alapján kiszámítja:

- **Alappontokat** (kötelező és választható tárgyak eredményei alapján)
- **Többletpontokat** (nyelvvizsga és emelt szintű érettségi alapján)
- **Végső pontszámot** (alappontok + többletpontok)

## Számítási szabályok:
- Ha a hallgató **nem tett érettségit minden kötelező tantárgyból**, a pontszámítás nem lehetséges.
- Ha **bármelyik tantárgy eredménye 20% alatti**, a pontszámítás nem lehetséges.
- Az **alappontszám**: a legjobb kötelező tárgy és a legjobb választható tárgy pontértékének összege, **duplázva**.
- A **többletpontok** maximuma **100 pont**:

### Nyelvvizsgák:
- **B2 (középfokú komplex)** = 28 pont
- **C1 (felsőfokú komplex)** = 40 pont

### Emelt szintű érettségi:
- **Vizsgánként** 50 pont
- **Ha egyazon nyelvből van B2 és C1**, akkor a **nagyobb pontszámot** kell figyelembe venni.

## Pontszámítási szabályok – Tantárgyak szerint

### **Programtervező informatikus (ELTE IK)**
- **Kötelező tárgyak:**
  - Matematika
- **Kötelezően választható tárgyak** *(egyikből vizsgázni kell)*:
  - Biológia
  - Fizika
  - Informatika
  - Kémia

### **Anglisztika (PPKE BTK)**
- **Kötelező tárgyak:**
  - Angol *(emelt szinten)*
- **Kötelezően választható tárgyak** *(egyikből vizsgázni kell)*:
  - Francia
  - Német
  - Olasz
  - Orosz
  - Spanyol
  - Történelem

## **Hibalehetőségek és figyelmeztetések**

### **Hiányzó kötelező tantárgy**
- Ha a hallgató **nem tett érettségit minden kötelező tárgyból**, akkor a pontszámítás nem lehetséges.
- **Hibaüzenet:**
  ```sh
  HIBA: Nem lehetséges a pontszámítás! Kötelező tárgy (pl. történelem) hiányzik.

