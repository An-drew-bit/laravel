##### RUN

```
1. cp .env.example .env
2. docker-compose build
3. docker-compose up -d
4. docker-compose exec app bash
5. composer install
6. sudo chmod -R 777 storage/
```

##### Использование

После запуска контейнеров api будет доступно по адресу

http://localhost::8080

##### Запуск конейнеров

```
docker-compose up -d - запуск билда контейнеров

docker-compose exec app bash - попасть внутрь контейнера
```

### Для локального запуска
```
{%project_folder%}: php artisan serve
http://127.0.0.1:8000
```
