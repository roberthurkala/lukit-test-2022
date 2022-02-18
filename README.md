# Lukit Test Catalog 2022
Zadanie polega na stworzeniu prostego katalogu produktów on-line w języku PHP (i javascript) przy pomocy frameworka Symfony 5 oraz wybranego frameworka UI.
Dane produktów powinny być przechowywane w bazie SQL.

## Opis

Przygotować prosty katalog produktów z podziałem na kategorie i podkategorie. 
Produkty zawierające jedno zdjęie i opis powinny mieć możliwość umieszczania w różnych kategoriach i podkategoriach.

Projekt powinien składać się z dwóch części: **frontend** i **backend**.
Katalog powinien być responsywny zbudowany na wybranym frameworku UI.

### Frontend

Na froncie powiwnny być widoczne 2 bloki - lista kategorii oraz lista produktów - z możliwością kliknięcia w nazwę i wejścia dalej do podglądu. 
Podgląd wybranej kategorii zawęża listę produktów do tych dostępnych w aktualnie wybranej oraz listę kategorii do kategorii podrzędnych.
Domyślnie na stronie głównej wyświetlać listę kategorii głównych oraz listę produktów wszystkich produktów. W przypadku większej ilości produktów pokazać paginację.
Lista produktów powinna być pokazana jako lista kart/bloków gdzie każda karta produktu zawiera nazwę, zdjęcie oraz cenę.
Lista produktów i kategorii posortowana po nazwie ASC.
Każdy produkt ma mieć swoją stronę - poprzez wejsćie z karty produktu. Na stronie produktu pokazać zdjęcie, nazwę, cenę oraz dodatkowo opis. 
W url strony produktu pokazywać nazwę produktu (slug).

Wizualnie frontent powinien być czytelny i responsywny na dużych i małych urządzeniach.

### Backend

W backendzie dwie sekcje - kategorie i produkty gdzie jest możliwść listowania, dodawania, edycji i kasowania danych.
Edycja produktu i kategorii powinna aktualizować datę aktualizacji, która jest widoczona na liście.
Przypisywanie produktu do kategorii może odbywać się na stronie edycji produktu lub w dodatkowej akcji.

Lista produktów i kategorii domyśłnie posortowana po nazwie ASC. Możliwe sortowania list po nazwie i dacie aktualizacji.

### Encje

#### Kategoria

- nazwa (100 znaków)
- kategoria nadrzędna (relacja do Kategoria)
- data aktualizacji (data i godzina)

#### Produkt

- nazwa (100 znaków)
- opis (255 znaków)
- zdjęcie (plik jpg)
- data aktualizacji (data i godzina)
- cena (liczba)

## Stack

- Symfony 5 + Twig (+ javascript)
- Mysql/MariaDb + Doctrine
- Frontend - wybrany Responsive Framework np: Bootstrap, Semantic UI lub inny
- Backend - również responsywny, można posiłkować się dostępnymi w Symfony generatorami CRUD

## Założenia

- W kodzie nazwy metod, encji, dokumentacja, komentarze po angielsku
- Przygotwać zestaw danych startowych - fixtures
- Proste testy funkcjonalne i unity w miarę potrzeby
- Załączyć instrukcję/opis instalacji i odpalenia projektu, fixtures i testów - w osobny pliku np install
- Github - należy wykonać fork niniejszego repozytorium i wszelkie zmiany wrzucamy jako Pull Requesty (można wrzucić całość lub partiami)
- Treść commitów tak jak komentarze piszemy po angielsku
- Pytania i inne kwestie - w sekcji Issues tego repozytorium, możemy też tam wrzucać prośby o poprawki lub objaśnienia, dyskusje itp...
