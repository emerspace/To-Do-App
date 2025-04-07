### Wymagania

+ Do szybkiego uruchomienia kodu:
    - Zainstalowana i działająca aplikacja docker wraz z pluginem compose
    - Testowano na docker 28.0.4 oraz pluginie compose 2.34.0

### Konfiguracja i uruchomienie

+ Przygotuj plik .env (np. przez skopiowanie zawartości .env.example) 
    - w przypadku testowania połaczenia z Google Calendar API, usupełnij sekcję z tym związaną
    - pozostałe usatwienia można pozostawić bez zmian jeśli użyty będzie dostarczony z kodem docker-compose.yml

+ Uruchom polecenie: 
    ```docker compose -d --build```

    Spowoduje to uruchomienie i zbudowanie lokalnego środowiska testowego (aplikacja wraz z kolejka oraz schedulerem, baza danych mysql, mailhog do testowania wysyłki emaili)

+ Aplikacje będą dostepne przez przeglądarke internetową:
    ```http://localhost:8000``` - główna aplikacja
    ```http://localhost:8025``` - mailhog do podgladu wysłanych wiadomości email

### Zakończenie testów

+ Po wykonaniu testów i przy chęci wyczyszczenia środowiska wykorzystaj polecenie: 
    ```docker compose down -v```

    Wykona to usunięcie kontenerów oraz stworzonych na ich potrzeby magazynów.
