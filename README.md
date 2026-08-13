# Equip Group Test

Каталог товаров, сгруппированных в многоуровневый справочник групп. Данные
(группы, товары, цены) загружаются из дампа `docker/mysql/test.sql` при миграции.

## Требования

- Git
- Docker Engine 20.10+ с плагином Docker Compose (v2)
- Node.js и PHP на хосте не требуются — всё выполняется внутри контейнеров

## Быстрый старт

Все команды выполняются из корня проекта.

### 1. Конфигурация окружения

```bash
cp .env.example .env
```

Значения по умолчанию уже настроены под Docker Compose. Порт по умолчанию — `40000`
(задаётся переменной `APP_PORT` в `.env`).

### 2. Запуск контейнеров

```bash
docker compose up -d
```

Будут подняты три сервиса:

| Сервис | Описание              | Порт на хосте |
|--------|-----------------------|---------------|
| app    | PHP 8.5 + Nginx (web) | 40000         |
| mysql  | MySQL 8.4             | 40002         |
| redis  | Redis                 | 40003         |

### 3. Установка зависимостей

```bash
docker compose exec app composer install
docker compose exec app npm install
```

### 4. Ключ приложения и миграции

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

Миграция `import_dump` импортирует дамп `docker/mysql/test.sql` (таблицы `groups`, `products`,
`prices`) — данные проекта.

### 5. Сборка фронтенда

```bash
docker compose exec app npm run build
```

Для разработки вместо сборки можно запустить dev-сервер Vite:

```bash
docker compose exec app npm run dev
```

### 6. Проверка

Приложение доступно по адресу: http://localhost:40000

- `http://localhost:40000/groups` — дерево групп
- `http://localhost:40000/product/{id}` — карточка товара

## Запуск тестов

```bash
docker compose exec app php artisan test
```
