# UTMN Custom PHP Engine

Учебный самописный PHP-движок с собственным bootstrap-процессом, простым DI-контейнером, роутингом, контроллерами, request-объектами, репозиториями и шаблонами. ⚙️

## Структура проекта

- `www/public` - точка входа веб-приложения;
- `www/app` - прикладной слой: роуты, конфиг, контроллеры, request-классы, репозитории;
- `www/core` - ядро движка: bootstrap, контейнер, роутер, рендеринг view и базовые абстракции;
- `www/resources` - шаблоны страниц и layout-файлы;
- `deploy` - docker-конфигурация и инфраструктурные файлы;
- `docker-compose.yaml` - локальное окружение из `nginx`, `php` и `postgres`.

## Как запускается движок

При запросе происходит следующая цепочка:
1. Подключается Composer autoload.
2. Запускается сессия.
3. Создается `App\\Config`.
4. Через `Core\\Bootstrap::create()` поднимается приложение.
5. Создается `App\\AppRouter`.
6. `Core\\Router::call()` обрабатывает текущий HTTP-запрос.

## Bootstrap и конфигурация

`Core\\Bootstrap` отвечает за начальную инициализацию приложения:

- загружает переменные окружения через `vlucas/phpdotenv`;
- создает singleton-экземпляр `Core\\App`;
- получает контейнер зависимостей от класса-конфига, реализующего `Core\\Contracts\\IContainerLoader`.

## Контейнер и автоподстановка зависимостей

Ключевая особенность движка - класс `Core\\App`. Он выступает как легковесный DI-контейнер и резолвер зависимостей.

Что умеет `Core\\App`:

- создавать классы через reflection;
- разбирать зависимости конструктора;
- разбирать зависимости метода контроллера;
- рекурсивно создавать недостающие зависимости;
- переиспользовать уже созданные экземпляры из `Core\\Base\\Container`.

На практике это означает, что в роутере можно просто указать строку вида `\\App\\Http\\Controllers\\PostController@calculateFree`, а движок сам:
- создаст контроллер;
- подставит в его метод request-объект;
- создаст репозиторий;
- передаст в репозиторий `PDO`.

## Роутинг

За маршрутизацию отвечает `Core\\Router`, а сами маршруты объявляются в `App\\AppRouter`.

В проекте используется пакет `nikic/fast-route`. Сейчас в приложении зарегистрированы два основных маршрута:

- `GET /` -> `App\\Http\\Controllers\\IndexController@renderPage`
- `POST /api/post/calculate-free` -> `App\\Http\\Controllers\\PostController@calculateFree`

`Core\\Router` берет `REQUEST_METHOD` и `REQUEST_URI`, прогоняет их через FastRoute и затем:

- рендерит `404` или `405`, если маршрут не найден;
- вызывает callback;
- либо создает контроллер через `App::make()` и выполняет нужный метод.

## Request, Controller и Repository слои

- `Controller` - принимает запрос и координирует сценарий;
- `Repository` - работает с базой данных;
- `Middleware` - заготовка для промежуточной логики;
- `Request` - объект входных данных.

Базовый `Core\\Base\\Http\\Request` собирает данные из `$_REQUEST` и JSON-body, после чего раскладывает их по свойствам объекта. Благодаря этому в `PostController` можно просто принять `CalculateFreeRequest`, а затем обращаться к полям вроде `$request->material`, `$request->publication_type`, `$request->pages`.

## Как работает текущий сценарий

1. `GET /` вызывает `IndexController`.
2. `IndexController` получает `PostRepository`.
3. Репозиторий читает из базы список названий сборников и типов публикаций.
4. `Core\\View::render()` рендерит `resources/view/index.php` с layout `resources/layouts/default.php`.
5. На странице отображается HTML-форма.
6. JavaScript отслеживает изменения полей и отправляет `POST` на `/api/post/calculate-free`.
7. `PostController` получает `CalculateFreeRequest` и `PostRepository`.
8. Репозиторий ищет цену в таблице `post`.
9. Контроллер возвращает рассчитанную сумму, которая подставляется в поле формы без перезагрузки страницы.

## Представления и шаблоны

За HTML отвечает `Core\\View`. Он:

- ищет шаблоны в `www/resources/view`;
- извлекает переданные данные через `extract($data)`;
- буферизует вывод шаблона;
- при необходимости оборачивает результат в layout из `www/resources/layouts`.

## Инфраструктура

- `nginx` как веб-сервер;
- `php` как runtime приложения;
- `postgres:16.2` как базу данных.
## Технологии

- PHP
- PostgreSQL
- Docker Compose
- `vlucas/phpdotenv`
- `nikic/fast-route`
- Composer PSR-4 autoload
