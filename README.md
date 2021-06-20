# Transshipment
Transshipment

Uruchomienie aplikacji;

1. git clone https://github.com/lukaszozim/Transshipment.git
2. cd Transshipment
3. composer install
4. lokalnie: php -S localhost:8000 -t public/ lub php bin/console server:run

Uruchomienie aplikacji w przeglądarce:
1. http://localhost:8000/truck-loading

Uruchomienie aplikacji z poziomu lini komend
1. Komenda tworząca załadunek ciężarówki z paczkami:
   Poniższa komenda wyświetla instrukcję wywołania pierwszej komendy
    php bin console app:first-truck-loading-help
  
  Uruchomienie załadunku:
   Poniższa komenda przyjmuje od 5 do 40 argumentów typu int lub float
    php bin/console app:first-truck-loading arg1 arg2 ... arg40
 
2. Komenda tworząca załadunek ciężarówki ze sprzętem rolniczym:
   Poniższa komenda wyświetla instrukcję wywołania drugiej komendy
    app:agricultural-machinery-trucks-loading-help
    
    Uruchomienie załadunku:
     Poniższa komenda przyjmuje dwa parametry. Są to kody poszczególnych maszyn (M1.5 i M2);
      php bin/console app:agricultural-machinery-trucks-loading-help arg1 arg2
      
3. Uruchomienie organizacji przeładunku:
    php bin/console app:organize-reloading


