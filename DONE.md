## Co zostało zrobione:

- Pełna aplikacja Laravel 11 oparta na wymaganiach zadania
- Frontend w Blade z AJAX dla filtrowania
- Obsługa logiki businessowej w kontrolerach + walidacja
- System tokenów do udostępniania zadań z terminem ważności
- Kolejki e-mail + scheduler
- Historia zmian w osobnej tabeli `task_revisions`
- Google Calendar: dodawanie zadań przez API Spatie (bez synchronizacji statusów)
- Autoryzacja OAuth per użytkownik z zapisem tokenów
- Docker z obsługą MySQL, Mailhog, scheduler, queue worker

## Możliwości dalszego rozwoju:
- Synchronizacja statusów zadań z Google Calendar (obecnie jednostronne – tylko dodawanie)
- Obsługa załączników i komentarzy do zadań
- Wersjonowanie API / RESTful endpoints

## Wnioski:
- Laravel sprawdza się świetnie w szybkiej budowie aplikacji CRUD z wieloma integracjami
- Podejście modularne pozwoliło łatwo rozszerzyć aplikację o Google Calendar i system publicznych tokenów
- Filtrowanie AJAX + Blade = lekkość i czytelność