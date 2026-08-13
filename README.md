# Equip Group Test

Каталог товаров, сгруппированных в многоуровневый справочник групп. Данные
(группы, товары, цены) загружаются из дампа `docker/mysql/test.sql` при миграции.

## Требования

- Git
- Docker Engine 20.10+ с плагином Docker Compose (v2)
- Node.js и PHP на хосте не требуются — всё выполняется внутри контейнеров

## Быстрый старт

### 1. Клонирование

```bash
git clone https://github.com/Oligkondr/equip_group_test.git
```
```bash
cd equip_group_test
```

### 2. Конфигурация окружения

```bash
cp .env.example .env
```

Значения по умолчанию уже настроены под Docker Compose. Порт по умолчанию — `40000`
(задаётся переменной `APP_PORT` в `.env`).

### 3. Установка зависимостей

Выполняется до запуска контейнеров, чтобы сервер стартовал уже с установленными
зависимостями:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Запуск контейнеров

```bash
./vendor/bin/sail up -d
```

Будут подняты три сервиса:

| Сервис | Описание             | Порт на хосте |
|--------|----------------------|---------------|
| app    | PHP 8.5 (artisan serve) | 40000      |
| mysql  | MySQL 8.4            | 40002         |
| redis  | Redis                | 40003         |

### 5. Ключ приложения и миграции

```bash
./vendor/bin/sail artisan key:generate
```
```bash
./vendor/bin/sail artisan migrate
```

Миграция `import_dump` импортирует дамп `docker/mysql/test.sql` (таблицы `groups`, `products`,
`prices`) — данные проекта.

### 6. Сборка фронтенда

```bash
./vendor/bin/sail npm install
```
```bash
./vendor/bin/sail npm run build
```

Для разработки вместо сборки можно запустить dev-сервер Vite:

```bash
./vendor/bin/sail npm run dev
```

### 7. Проверка

Приложение доступно по адресу: http://localhost:40000

- `http://localhost:40000/groups` — дерево групп
- `http://localhost:40000/product/{id}` — карточка товара

## Запуск тестов

```bash
./vendor/bin/sail artisan test
```
