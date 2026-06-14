# SLICO3D eBay Listing Template Rules v1.0

## Cel
Twórz profesjonalne, spójne i responsywne opisy HTML dla aukcji eBay marki SLICO3D.

Opis ma wyglądać nowocześnie, technicznie i sprzedażowo. Ma budować zaufanie do marki SLICO3D oraz jasno prezentować produkt.

## Zasady eBay
- Używaj wyłącznie HTML + inline CSS.
- Bez JavaScript.
- Bez iframe.
- Bez formularzy.
- Bez zewnętrznych fontów.
- Bez animacji.
- Bez aktywnego contentu.
- Kod musi być mobilny i prosty.
- Maksymalna szerokość kontenera: 1150 px.

eBay dopuszcza HTML w opisie, ale aktywny content typu JavaScript, Flash, pluginy lub form actions nie jest dozwolony. Dlatego szablon musi być czysty i statyczny.

## Kolory SLICO3D
- Tło główne: #f7f7f7
- Biały: #ffffff
- Grafit: #222222
- Ciemny szary: #333333
- Jasny szary: #eeeeee
- Akcent SLICO orange: #f28c28
- Akcent żółty: #ffcc33

## Stałe grafiki
Logo SLICO3D:
https://raw.githubusercontent.com/Slico3D/slico3d-website/main/assets/branding/Logo%20z%20nazwa2.png

Bayern Logo:
https://raw.githubusercontent.com/Slico3D/slico3d-website/main/assets/branding/BayernLogo.png

Grafika Qualität aus Deutschland:
https://raw.githubusercontent.com/Slico3D/slico3d-website/main/assets/branding/grafika%20ebay.png

## Układ opisu

1. Header marki
- Logo SLICO3D na górze.
- Duży tekst dla produktów 3D:
  "3D-GEDRUCKT IN BAYERN"
- Podpis:
  "Entwickelt, gefertigt und versendet von SLICO3D."

Dla używanej elektroniki zamiast tego:
"GEPRÜFTE GEBRAUCHTWARE"
"Nachhaltig wiederverwendet, geprüft und sicher verpackt."

2. Hero produktu
- Mocny tytuł produktu.
- Krótki podtytuł sprzedażowy.
- 3 kafelki korzyści.

3. Beschreibung
- Krótki opis produktu.
- Bez lania wody.
- Maksymalnie 3 krótkie akapity.

4. Vorteile
- 5–7 punktów.
- Krótkie, konkretne, techniczne.

5. Kompatibilität / Varianten
- Jasna tabela.
- Kolory, warianty, zestaw, kompatybilność.

6. Anwendung
- Gdzie i do czego produkt się nadaje.

7. Qualität & Versand
- Keine Massenware.
- Entwickelt & hergestellt in Bayern.
- Schneller Versand.
- Jeder Artikel wird geprüft und sicher verpackt.

8. Hinweis
- Krótka informacja techniczna lub lekko humorystyczna.
- Jeżeli produkt pasuje do marki trzeciej, dodaj:
  "Hinweis: Es handelt sich nicht um Originalzubehör des Herstellers. Genannte Markennamen dienen ausschließlich der Beschreibung der Kompatibilität."

9. Grafika Qualität aus Deutschland
- Wstaw grafikę:
  https://raw.githubusercontent.com/Slico3D/slico3d-website/main/assets/branding/grafika%20ebay.png

10. Footer
- Bayern Logo.
- Tekst:
  "SLICO3D – praktische Lösungen aus dem 3D-Druck."
  "Entwickelt und gefertigt in Bayern."

## Styl HTML
- Używaj div, h1, h2, h3, p, ul, li, table, img.
- Wszystkie style inline.
- Nie używaj class wymagających zewnętrznego CSS.
- Nie używaj script, iframe, form, input, button.
- Obrazki z max-width:100%; height:auto.
- Sekcje jako białe karty na jasnym tle.
- Kafelki benefitów w układzie flex z zawijaniem.
- Na mobile wszystko ma przejść w jedną kolumnę.

## Styl tekstu
- Język: niemiecki.
- Ton: profesjonalny, konkretny, sprzedażowy.
- Bez przesady marketingowej.
- SEO naturalne, bez spamowania słowami kluczowymi.
- Tytuły krótkie i mocne.
- Opisy czytelne dla kupującego na telefonie.

## Output Codexa
Codex ma wygenerować:
1. eBay SEO Titel, max. 80 Zeichen.
2. Kurzbeschreibung.
3. Item Specifics.
4. Fertigen HTML-Code für eBay.
5. Reihenfolge der Galeriebilder.
6. Optional: kurzer Instagram-Text.
