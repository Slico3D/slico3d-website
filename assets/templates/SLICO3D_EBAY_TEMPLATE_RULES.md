# SLICO3D eBay Listing Master v3.0

To jest jedyny obowiązujący master opisów eBay SLICO3D.

## Zasady
- Jedna główna aukcja na jeden produkt bazowy.
- Warianty zamiast mnożenia zestawów.
- Kolor jako osobny wariant.
- "Mit WAGO / Ohne WAGO" jako wariant, jeśli dotyczy.
- Ilość przez Stückzahl i Multi-Rabatt.
- Krótki, techniczny opis.
- Bez JavaScript, iframe, formularzy, zewnętrznych fontów i aktywnego contentu.
- Wyłącznie HTML + inline CSS.
- Maksymalna szerokość: 1150 px.
- Język niemiecki.
- Nie wymyślać parametrów, certyfikatów ani kompatybilności.
- Dla akcesoriów innych marek zawsze dodać informację:
  "Es handelt sich nicht um Originalzubehör des Herstellers. Genannte Markennamen dienen ausschließlich der Beschreibung der Kompatibilität."

## Styl
- Tło strony: #eef0e6
- Oliwkowy hero: gradient #8b8f6a → #73785a
- Ciemna oliwka: #656a4e
- Tekst główny: #171a13
- Tekst sekcji: #2e3325
- Jasny krem: #F3E7C3
- Pomarańczowy akcent: #f28c28
- Żółty akcent: #ffcc33
- Karty: #ffffff / #f3f4ed

## Stałe grafiki
Logo SLICO3D:
https://raw.githubusercontent.com/Slico3D/slico3d-website/main/assets/branding/Logo%20z%20nazwa2.png

Bayern Logo:
https://raw.githubusercontent.com/Slico3D/slico3d-website/main/assets/branding/BayernLogo.png

## Kolejność sekcji
1. HERO
2. Kurzbeschreibung
3. Vorteile
4. Varianten
5. Lieferumfang
6. Technische Daten
7. Hinweis
8. Brand Strip
9. Footer

## Master HTML

```html
<div style="margin:0;padding:18px 10px;background:#eef0e6;font-family:Arial,Helvetica,sans-serif;color:#222;line-height:1.5;">

  <div style="max-width:1150px;margin:0 auto;">

    <!-- HERO -->
    <div style="background:linear-gradient(135deg,#8b8f6a 0%,#73785a 100%);color:#171a13;padding:28px 24px;border-radius:12px;margin-bottom:16px;">

      <div style="display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:18px;margin-bottom:26px;">

        <img
          src="https://raw.githubusercontent.com/Slico3D/slico3d-website/main/assets/branding/Logo%20z%20nazwa2.png"
          alt="SLICO3D"
          style="max-width:230px;width:55%;height:auto;display:block;"
        >

        <div style="background:#555a42;border:1px solid rgba(255,204,51,0.55);padding:11px 16px;border-radius:9px;font-size:13px;font-weight:700;letter-spacing:1px;color:#ffcc33;text-transform:uppercase;">
          3D-GEDRUCKT IN BAYERN
        </div>

      </div>

      <div style="font-size:13px;color:#F3E7C3;font-weight:700;text-transform:uppercase;letter-spacing:.8px;margin-bottom:8px;">
        {{PRODUCT_TYPE}}
      </div>

      <h1 style="margin:0;font-size:32px;line-height:1.2;color:#171a13;">
        {{PRODUCT_TITLE}}
      </h1>

      <p style="margin:14px 0 0 0;font-size:18px;color:#292d22;max-width:780px;">
        {{PRODUCT_SUBTITLE}}
      </p>

      <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:26px;">

        <div style="flex:1 1 180px;background:#656a4e;padding:16px 18px;border-radius:10px;border-top:3px solid #f28c28;">
          <div style="font-size:28px;font-weight:700;color:#f28c28;line-height:1;">
            {{BENEFIT_1_VALUE}}
          </div>
          <div style="margin-top:8px;font-size:15px;font-weight:700;color:#ffffff;">
            {{BENEFIT_1_LABEL}}
          </div>
        </div>

        <div style="flex:1 1 180px;background:#656a4e;padding:16px 18px;border-radius:10px;border-top:3px solid #f28c28;">
          <div style="font-size:28px;font-weight:700;color:#f28c28;line-height:1;">
            {{BENEFIT_2_VALUE}}
          </div>
          <div style="margin-top:8px;font-size:15px;font-weight:700;color:#ffffff;">
            {{BENEFIT_2_LABEL}}
          </div>
        </div>

        <div style="flex:1 1 180px;background:#656a4e;padding:16px 18px;border-radius:10px;border-top:3px solid #f28c28;">
          <div style="font-size:28px;font-weight:700;color:#f28c28;line-height:1;">
            {{BENEFIT_3_VALUE}}
          </div>
          <div style="margin-top:8px;font-size:15px;font-weight:700;color:#ffffff;">
            {{BENEFIT_3_LABEL}}
          </div>
        </div>

      </div>

    </div>

    <!-- KURZBESCHREIBUNG -->
    <div style="background:#ffffff;padding:22px;border-radius:10px;margin-bottom:16px;border-top:3px solid #8b8f6a;">

      <h2 style="font-size:22px;margin:0 0 12px 0;color:#2e3325;">
        Einfach ordentlich
      </h2>

      <p style="margin:0 0 10px 0;color:#333;">
        {{DESCRIPTION_1}}
      </p>

      <p style="margin:0;color:#333;">
        {{DESCRIPTION_2}}
      </p>

    </div>

    <!-- VORTEILE -->
    <div style="background:#ffffff;padding:22px;border-radius:10px;margin-bottom:16px;border-top:3px solid #8b8f6a;">

      <h2 style="font-size:22px;margin:0 0 14px 0;color:#2e3325;">
        Vorteile auf einen Blick
      </h2>

      <div style="display:flex;flex-wrap:wrap;gap:10px;">

        <div style="flex:1 1 210px;background:#f3f4ed;padding:14px;border-radius:8px;">
          <strong style="color:#2e3325;">{{ADVANTAGE_1_TITLE}}</strong><br>
          <span style="font-size:14px;color:#666;">{{ADVANTAGE_1_TEXT}}</span>
        </div>

        <div style="flex:1 1 210px;background:#f3f4ed;padding:14px;border-radius:8px;">
          <strong style="color:#2e3325;">{{ADVANTAGE_2_TITLE}}</strong><br>
          <span style="font-size:14px;color:#666;">{{ADVANTAGE_2_TEXT}}</span>
        </div>

        <div style="flex:1 1 210px;background:#f3f4ed;padding:14px;border-radius:8px;">
          <strong style="color:#2e3325;">{{ADVANTAGE_3_TITLE}}</strong><br>
          <span style="font-size:14px;color:#666;">{{ADVANTAGE_3_TEXT}}</span>
        </div>

        <div style="flex:1 1 210px;background:#f3f4ed;padding:14px;border-radius:8px;">
          <strong style="color:#2e3325;">Made in Bayern</strong><br>
          <span style="font-size:14px;color:#666;">Entwickelt und gefertigt von SLICO3D</span>
        </div>

      </div>

    </div>

    <!-- VARIANTEN -->
    <div style="background:#ffffff;padding:22px;border-radius:10px;margin-bottom:16px;border-top:3px solid #8b8f6a;">

      <h2 style="font-size:22px;margin:0 0 16px 0;color:#2e3325;">
        Varianten
      </h2>

      <div style="display:flex;flex-wrap:wrap;gap:12px;">

        <div style="flex:1 1 260px;background:#f3f4ed;padding:16px;border-radius:8px;border-left:4px solid #f28c28;">
          <strong style="color:#2e3325;">Ausführung</strong>
          <p style="margin:8px 0 0 0;color:#333;">
            {{VARIANT_EXECUTION}}
          </p>
        </div>

        <div style="flex:1 1 260px;background:#f3f4ed;padding:16px;border-radius:8px;border-left:4px solid #f28c28;">
          <strong style="color:#2e3325;">Farbe</strong>
          <p style="margin:8px 0 0 0;color:#333;">
            {{VARIANT_COLORS}}
          </p>
        </div>

      </div>

      <p style="margin:14px 0 0 0;font-size:14px;color:#666;">
        Gewünschte Variante und Stückzahl einfach oben im eBay-Angebot auswählen.
      </p>

    </div>

    <!-- LIEFERUMFANG -->
    <div style="background:#ffffff;padding:22px;border-radius:10px;margin-bottom:16px;border-top:3px solid #8b8f6a;">

      <h2 style="font-size:22px;margin:0 0 14px 0;color:#2e3325;">
        Lieferumfang
      </h2>

      <div style="display:flex;flex-wrap:wrap;gap:12px;">
        {{DELIVERY_CONTENT}}
      </div>

    </div>

    <!-- TECHNISCHE DATEN -->
    <div style="background:#ffffff;padding:22px;border-radius:10px;margin-bottom:16px;border-top:3px solid #8b8f6a;">

      <h2 style="font-size:22px;margin:0 0 14px 0;color:#2e3325;">
        Technische Daten
      </h2>

      <table style="width:100%;border-collapse:collapse;font-size:15px;color:#333;">
        {{TECHNICAL_ROWS}}
      </table>

    </div>

    <!-- HINWEIS -->
    <div style="background:#fff8e5;border:1px solid #e6cf83;padding:18px 20px;border-radius:10px;margin-bottom:16px;">

      <strong style="color:#5e5122;">Hinweis</strong>

      <p style="margin:8px 0;color:#444;">
        {{TECHNICAL_NOTE}}
      </p>

      <p style="margin:0;color:#444;">
        Es handelt sich nicht um Originalzubehör des Herstellers.
        Genannte Markennamen dienen ausschließlich der Beschreibung der Kompatibilität.
      </p>

    </div>

    <!-- BRAND STRIP -->
    <div style="background:#61674a;color:#ffffff;padding:18px 16px;border-radius:10px;margin-bottom:16px;">

      <div style="display:flex;flex-wrap:wrap;gap:12px;text-align:center;">

        <div style="flex:1 1 180px;">
          <strong style="color:#ffcc33;">●</strong>
          Keine Massenware
        </div>

        <div style="flex:1 1 180px;">
          <strong style="color:#ffcc33;">●</strong>
          Geprüfte Qualität
        </div>

        <div style="flex:1 1 180px;">
          <strong style="color:#ffcc33;">●</strong>
          Schneller Versand
        </div>

        <div style="flex:1 1 180px;">
          <strong style="color:#ffcc33;">●</strong>
          Made in Bayern
        </div>

      </div>

    </div>

    <!-- FOOTER -->
    <div style="background:#ffffff;padding:24px 20px;border-radius:10px;text-align:center;border-top:3px solid #8b8f6a;">

      <img
        src="https://raw.githubusercontent.com/Slico3D/slico3d-website/main/assets/branding/BayernLogo.png"
        alt="SLICO3D Bayern"
        style="max-width:120px;width:30%;height:auto;margin-bottom:10px;"
      >

      <div style="font-size:18px;font-weight:700;color:#2e3325;">
        SLICO3D – praktische Lösungen aus dem 3D-Druck.
      </div>

      <div style="font-size:14px;color:#666;margin-top:5px;">
        Entwickelt und gefertigt in Bayern.
      </div>

    </div>

  </div>

</div>
```

## Standard dla ofert z wariantami WAGO
- Kolor jako wariant.
- "Mit WAGO" / "Ohne WAGO" jako wariant Ausführung.
- Ilość przez Stückzahl.
- Multi-Rabatt zamiast sztucznych zestawów.
- Nie tworzyć osobnych ofert L1/L2/L3, 3er Set, 5er Set, Mix Set, jeśli ten sam efekt daje wybór koloru i ilości.

## Output dla każdej nowej aukcji
1. SEO Titel max. 80 znaków.
2. Kurzbeschreibung.
3. Item Specifics.
4. Kompletny HTML według tego mastera.
5. Warianty.
6. Kolejność galerii.
7. Cena i Multi-Rabatt.
8. Kontrola ryzyka: kompatybilność, znaki towarowe, parametry i marża.
