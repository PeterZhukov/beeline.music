# Установка

0. composer install
0. Копируем .env.example в .env, меняем параметры подключения к БД и параметры лимита API
0. php artisan storage:link
0. php artisan migrate
0. php artisan db:seed

## Тестирование

0. http://beeline.programmist-zhukov.ru/api/v1/images/1
0. http://beeline.programmist-zhukov.ru/api/v1/stats/1
