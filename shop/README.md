# SLICO3D — pusty sklep lokalny

WordPress + WooCommerce + darmowy Germanized, z motywem SLICO3D opartym na Storefront. To rzeczywisty silnik sklepu, bez produktów, cen i kart produktu. Dotychczasowa statyczna strona pozostaje w katalogu głównym repozytorium.

## Czego potrzebujemy teraz

1. **Docker Desktop** na Windows 11, z uruchomionym silnikiem Linux/WSL 2: https://docs.docker.com/desktop/setup/install/windows-install/
2. **Plików tej gałęzi GitHuba** na komputerze. Można pobrać ZIP albo sklonować przez GitHub Desktop. GitHub Desktop jest opcjonalny.
3. Połączenia z internetem przy pierwszej instalacji: pobranie obrazów, WordPressa, wtyczek i tłumaczeń. Po instalacji zwykła praca nad lokalnym sklepem nie wymaga publicznego hostingu.

Nie kupujemy teraz nowej domeny, pakietu Shop ani płatnych wtyczek. Nie zmieniamy DNS. Docker na komputerze służy do przygotowania; przyszły hosting może być zwykłym hostingiem PHP + MariaDB i nie musi obsługiwać Dockera.

## Pierwsze uruchomienie na Windows

Uruchom Docker Desktop. W rozpakowanym projekcie otwórz folder `shop`, kliknij prawym przyciskiem w pustym miejscu i wybierz **Otwórz w terminalu**. Uruchom:

```powershell
powershell -ExecutionPolicy Bypass -File .\start.ps1
```

`Bypass` dotyczy tylko uruchomionego procesu; nie zmienia globalnych ustawień Windows. Skrypt tworzy lokalny `.env` z losowymi hasłami, uruchamia bazę i WordPressa, instaluje wtyczki, tłumaczenia oraz motyw. Pierwsze uruchomienie może trwać kilka minut.

- Sklep: http://localhost:8080/
- Panel administratora: http://localhost:8080/wp-admin/
- Skrzynka wiadomości testowych: http://localhost:8025/

Login jest zapisany w `shop/.env` jako `LOCAL_ADMIN_USER`, hasło jako `LOCAL_ADMIN_PASSWORD`. Otwórz plik w Notatniku. Nie wysyłaj go do GitHuba ani w wiadomościach.

Ponowne uruchomienie `start.ps1` zachowuje istniejącą bazę i ustawienia. Nie wykonuje automatycznej aktualizacji zainstalowanych wtyczek. Zmiany motywu w folderze `theme` są od razu widoczne lokalnie.

Jeśli port 8080 lub 8025 jest zajęty, przed pierwszym uruchomieniem zmień odpowiednio `SHOP_PORT` lub `MAIL_PORT` w `.env`. Portów nie zmieniamy podczas pracy nad już zbudowanym sklepem bez aktualizacji zapisanych adresów WordPressa.

## Co jest przygotowane

- Niemiecki język, strefa Europe/Berlin, euro i format cen DE.
- WordPress, WooCommerce, Germanized, Storefront i motyw potomny SLICO3D.
- Strona główna, pusty sklep, koszyk, kasa, konto, blog, o marce i kontakt.
- Zakup bez obowiązkowego konta; bez rejestracji kont przy kasie.
- Ograniczenie przyszłej sprzedaży i dostawy do Niemiec.
- Proste stany magazynowe, bez integracji z eBay.
- Puste szkice informacji prawnych w panelu. Nie są opublikowanymi tekstami prawnymi.
- Skrzynka testowa Mailpit: WordPress wysyła wiadomości do niej zamiast do odbiorców.
- Dostęp tylko na komputerze lokalnym, bez wystawionej bazy danych i bez indeksowania.

Płatności, ceny wysyłki, dane podatkowe i firmowe oraz funkcja odstąpienia wymagają finalnej konfiguracji później. Samo zainstalowanie Germanized nie oznacza gotowości prawnej do sprzedaży. Kasa bez produktów i płatności jest na tym etapie tylko przygotowaną częścią platformy.

## Zatrzymywanie i kopie

```powershell
powershell -ExecutionPolicy Bypass -File .\stop.ps1
powershell -ExecutionPolicy Bypass -File .\backup.ps1
```

Kopię wykonujemy przy uruchomionym Dockerze i bazie. Powstaje w `shop/backups/`: baza SQL, media (jeśli istnieją) oraz lista wtyczek i wersja WordPressa. Zachowaj osobno `.env`. Kopie, hasła i dane sklepu są wykluczone z GitHuba.

`stop.ps1` zachowuje bazę. Nie używaj `docker compose down -v` do zwykłego zatrzymywania — usuwa lokalne wolumeny z bazą i plikami.

## GitHub i pliki

```text
shop/
  compose.yaml          środowisko lokalne
  start.ps1             instalacja i uruchamianie
  stop.ps1              zatrzymanie bez usuwania danych
  backup.ps1            kopia bazy i mediów
  scripts/              konfiguracja i testy pustej instalacji
  mu-plugins/           ustawienia lokalnego środowiska
  theme/                własny wygląd SLICO3D
```

GitHub przechowuje kod motywu, konfigurację uruchamiania i instrukcje. Baza, produkty dodawane później w panelu, media i hasła nie są przechowywane w repozytorium. Aktualizacje WordPressa i wtyczek sprawdzamy najpierw lokalnie, po kopii danych.

WordPress i WP-CLI mają wskazane wersje obrazów. MariaDB używa linii 11.4, Mailpit wersji 1.31.3. Wtyczki i Storefront są pobierane w aktualnej stabilnej wersji przy pierwszym uruchomieniu; faktyczne wersje wypisuje instalator i zapisuje kopia. Przed publikacją utrwalimy sprawdzony zestaw wersji i sposób aktualizacji.

## Sprawdzanie

Workflow `.github/workflows/shop-local.yml` uruchamia platformę na tymczasowym komputerze GitHuba. Sprawdza składnię PHP, język, walutę, aktywne wtyczki, puste produkty, strony, brak aktywnych płatności, szkice prawne, ponowne uruchomienie bez utraty ustawień, wiadomość w skrzynce testowej, widok telefonu i komputera oraz kopię danych. Zrzuty ekranu są dostępne jako artefakt `shop-preview`.

Test serwera GitHuba nie zastępuje pierwszego uruchomienia na Windows Tomasza. Żaden element tej konfiguracji nie publikuje sklepu ani nie podłącza slico3d.de.

## Kolejność dalszej pracy

1. Uruchomienie pustego sklepu i potwierdzenie działania na komputerze Tomasza.
2. Dopracowanie wyglądu, nawigacji i podstawowych ustawień.
3. Dopiero potem karty produktów, warianty, ceny i magazyn.
4. Formalności, płatności, hosting, poczta i publikacja.

## Dokumentacja źródłowa

- Oficjalne obrazy WordPressa: https://hub.docker.com/_/wordpress
- Docker Desktop na Windows: https://docs.docker.com/desktop/setup/install/windows-install/
- Storefront: https://wordpress.org/themes/storefront/
- Germanized: https://wordpress.org/plugins/woocommerce-germanized/
- Mailpit: https://mailpit.axllent.org/docs/install/docker/

Przygotowano 2 października 2026 r.
