setup: env-prepare sqlite-prepare install key db-prepare # можно ссылаться на цели, описанные ниже

env-prepare: # создать .env-файл для секретов
	cp -n .env.example .env

sqlite-prepare: # подготовить локальную БД
	touch database/database.sqlite

install: # установить зависимости
	composer install
	npm install

validate: # проверьте валидность composer.json
	composer validate

key: # сгенерировать ключи
	php artisan key:generate

db-prepare: # загрузить данные в БД
	php artisan migrate --seed

start: # запустить приложение
	heroku local -f Procfile.dev