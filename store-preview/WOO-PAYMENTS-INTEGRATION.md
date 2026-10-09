# SLICO3D – własna kasa i WooPayments (2026-10-09)

## Potwierdzony stan
- WooCommerce 11.2.0; WooPayments 11.2.0; WooPayments Test Mode ON.
- WooCommerce REST Store API działa przy koszyku produktu, aktualizacji klienta/adresu.
- Aktualny interfejs: /store-preview/kasse/ (Geoapify, obowiązkowy numer domu).
- Obecny przycisk finalizacji przekierowuje do /shop/kasse/, co jest tylko etapem przejściowym.
- Test zamówienia nr 68 przeszedł przez natywny Checkout Block, nie przez własny moduł płatności.

## Ograniczenie integracji
Store API POST /wc/store/v1/checkout obsługuje payment_method i payment_data, ale WooPayments wymaga dodatkowego client-side tworzenia/potwierdzania metody Stripe Elements i danych bramki. Nie przesyłać PAN/CVC własnym formularzem ani na backend WordPress.
WooPayments nie daje gwarantowanego, gotowego headless SDK kompatybilnego z dowolnym statycznym frontendem. Potrzebny autorski most plugin WP, który korzysta z oficjalnej implementacji i aktualnego API WooPayments.

## Plan weryfikacji przed kodem produkcyjnym
1. Zapewnić kontrolowany dostęp do plików pluginu WooPayments 11.2.0 (lub publicznego kodu źródłowego pasującego do wersji) i zidentyfikować blok checkout, inicjalizację Stripe, create/confirm payment_method, 3DS, success/error handling.
2. Opracować mały plugin SLICO3D Payment Bridge (bez umieszczania sekretów Stripe w JS); przechwytywanie/payment_data zgodne z WooPayments, aktualizacje kompatybilności, odporność na błędy.
3. Integracja checkout HTML z bezpiecznym Stripe Elements i Store API w test mode.
4. Testy: 4242 success; declined card; 3DS; nonce/cart expiration; missing shipping; po 25 EUR darmowa dostawa; VAT/Kleinunternehmer legal check; guest checkout; email confirmation.
5. Dopiero po zaliczeniu testów usunąć przekierowanie do /shop/kasse i udostępnić płatności na /store-preview/kasse/; w produkcji przenieść ze ścieżki preview/noindex na docelowe URL.

## Alternatywa awaryjna
Zachować natywny Checkout Block WooCommerce przy wystylizowanej pod SLICO3D dedykowanej stronie WordPress; nie udawać, że to headless.

## Bezpieczeństwo
Klucz Geoapify ograniczony domeną; nie commitować do repo. Żadnych kluczy sekretów Woo/Stripe w JavaScript. Nie zmieniać WooPayments z test mode na live bez świadomej akceptacji.
