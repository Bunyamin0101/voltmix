# VOLTMIX – Energy Drink Konfigurator

Webbasierter Produkt-Konfigurator für individuelle Energy Drinks.  
Projektarbeit Web-Technologien WiSe 2025/2026, THM Campus Friedberg.

## Technologie-Stack

- **Frontend:** Vanilla JavaScript + Bootstrap 5 (keine weiteren Frameworks)
- **Backend:** PHP 8.4 (ohne Frameworks)
- **Datenbank:** MariaDB
- **Server:** Apache2 (via Docker)

## Installation

### Voraussetzung
- Docker und Docker Compose installiert

### Schritte

1. **Repository klonen** und in das Projektverzeichnis wechseln

2. **Docker starten:**
   ```bash
   docker-compose up -d
   ```

3. **Datenbank einrichten:**
   - phpMyAdmin öffnen: [http://localhost:8081](http://localhost:8081)
   - Einloggen mit `root` / `rootpasswort`
   - Datenbank `meine_db` auswählen
   - Unter "Importieren" die Datei `src/database.sql` hochladen und ausführen

4. **Webapp öffnen:** [http://localhost](http://localhost)

### Zugangsdaten (Docker-Vorlage)

| Service     | Benutzer  | Passwort          |
|-------------|-----------|-------------------|
| MariaDB     | root      | rootpasswort      |
| MariaDB     | benutzer  | benutzerpasswort  |
| phpMyAdmin  | root      | rootpasswort      |

### Test-Account

| E-Mail       | Passwort |
|-------------|----------|
| max@test.de | test123  |

### Test-Gutscheincodes

| Code       | Rabatt |
|-----------|--------|
| WELCOME10 | 10%    |
| GAMER20   | 20%    |
| ENERGY15  | 15%    |
| THM2026   | 25%    |

## Funktionsumfang

### Pflichtanforderungen (1-7)
1. **Landing Page** mit Beschreibung, visueller Darstellung und Call-to-Action
2. **Registrierung & Login** mit E-Mail, Name, Adresse und Passwort
3. **5-Schritte-Konfigurator:** Basis → Geschmack → Extras → Süßung & Größe → Design
4. **22 Geschmacksrichtungen** in 6 Kategorien (> 20 Wahlmöglichkeiten)
5. **Visuelle Darstellung** durch dynamisches SVG der Dose (Live-Preview mit Farbe, Name, Details)
6. **Zusammenfassung** mit Preisübersicht und "Jetzt bestellen"-Button
7. **Konfiguration speichern** in der Datenbank (eingeloggte User)

### Zusatzfeatures (8)
1. **Gutscheincodes** – Rabatt-Codes mit %-Angabe, serverseitig validiert
2. **Vorkonfigurierte Drinks (Presets)** – "Gamer Fuel", "Focus Flow", "Berry Blast" auf der Landing Page, laden eine voreingestellte Konfiguration
3. **Suche & Filterung** – Geschmacksrichtungen nach Kategorie filtern und per Textsuche durchsuchen (implementiert in Schritt 2)

## Projektstruktur

```
src/
├── index.php              Landing Page
├── register.php           Registrierung
├── login.php              Login
├── logout.php             Logout
├── configurator.php       Haupt-Konfigurator
├── saved.php              Gespeicherte Konfigurationen
├── api/
│   ├── auth.php           Login/Register API
│   ├── save_config.php    Konfiguration speichern
│   ├── load_configs.php   Konfigurationen laden
│   ├── delete_config.php  Konfiguration löschen
│   └── coupon.php         Gutscheincode prüfen
├── includes/
│   ├── db.php             DB-Verbindung (PDO)
│   ├── auth_check.php     Session-Prüfung
│   ├── header.php         HTML-Header + Navbar
│   └── footer.php         HTML-Footer
├── css/
│   └── style.css          Custom Styles
├── js/
│   ├── configurator.js    Konfigurator-Logik
│   └── auth.js            Login/Register-Logik
└── database.sql           SQL-Dump
```
