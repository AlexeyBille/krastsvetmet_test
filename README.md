# Тестовое задание Красцветмет

### Запуск проекта (php 7.4 + sqlite):
```
composer install -vvv && \
  touch database/database.sqlite && \
  cp .env.example .env && \
  php artisan key:generate && \
  php artisan storage:link && \
  php artisan db:seed --class=CommercialImagesSeeder && \
  php artisan migrate:fresh --seed && \
  php artisan test && \
  php artisan serve
```


#### Статистика

Посчет статистики уникальных посетителей сделал через accessor, 
но на большом количестве ссылок на каждую ссылку будет идти отдельный запрос, 
можно решить эту проблему если подсчет вынести в отдельный запрос, либо сделать пагинацию

