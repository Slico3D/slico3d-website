# SLICO3D — propozycja odświeżenia strony

Gałąź: `design/olive-refresh`. Propozycja do oceny przed wdrożeniem.

## Kierunek

Grafit `#141713`, przygaszona oliwka `#a5af79`, piaskowy beż `#d3c5a8`, jasny tekst `#eeede6`. Techniczny charakter i drobne skośne akcenty. Prawdziwe zdjęcia zachowują kolory produktów. Nowy płaski logotyp jest propozycją; stare pliki logo pozostają w repozytorium.

## Strona główna

1. SLICO3D, krótki komunikat i zdjęcie rzeczywistego uchwytu.
2. Prezentacja istniejących uchwytów i tematów marki.
3. Informacja o małej firmie i produkcji w Bawarii.
4. Wejście do istniejącego bloga.
5. Kontakt oraz dodatkowe odnośniki do Instagramu i eBay.

eBay pozostaje dostępny do czasu uruchomienia własnego sklepu. Przycisk katalogu prowadzi do sekcji produktów. Nie ma jeszcze koszyka, płatności ani nowych kart produktów. Organizer z inspiracji nie jest pokazywany jako dostępny produkt. Treść istniejących podstron produktowych i prawnych nie została przebudowana; dostały wspólną kolorystykę i logotyp.

## Podgląd lokalny

W folderze tej wersji repozytorium uruchom `python -m http.server 8765`, a następnie otwórz `http://localhost:8765`. Serwer HTTP jest potrzebny dla istniejących odnośników zaczynających się od `/`.

## Podglądy wyglądu

- [Komputer — 1440 px](desktop.jpg)
- [Telefon — 390 px](mobile.jpg)

Podglądy są zrzutami działającej strony. Przed publikacją sprawdzić także aktualne dane firmowe, opisy produktów i informacje o hostingu w polityce prywatności w ramach migracji. Ten projekt dotyczy wyglądu strony, nie aktualizacji dokumentów prawnych.

## Sprawdzenie

Sprawdzono 9 istniejących stron w 5 szerokościach: 360, 390, 768, 1024 i 1440 px. Brak błędów JavaScript, nieudanych żądań HTTP, uszkodzonych widocznych zdjęć i poziomego przepełnienia. Menu mobilne działa po kliknięciu, klawiszu Escape, przejściu do sekcji i powiększeniu okna. Wykonano też kontrolę składni JavaScript i `git diff --check`.
