### Чистый запуск
```
{%project_folder%}: cp ./env.example ./.env
{%project_folder%}: php composer.phar install
{%project_folder%}: artisan optimize
{%project_folder%}: artisan migrate
```

### Для локального запуска
```
{%project_folder%}: php artisan serve
http://127.0.0.1:8000
```