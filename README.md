<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Тестовое задание для PHP-разработчика.

 - Используя фреймворк Laravel реализовать RESTful api.
 - Реализовать сущности
- Товары
- Категории
- Товар-Категория
- Реализовать выдачу данных в формате json по RESTful
- Создание Товаров (у каждого товара может быть от 2х до 10 категорий)
- Редактирование Товаров
- Удаление товаров (товар помечается как удаленный)
- Создание категорий
- Удаление категорий (вернуть ошибку если категория прикреплена к товару)
- Получение списка товаров
- Имя / по совпадению с  именем
- id категории
- Название категории  / по совпадению с  категорией
- Цена от - до
- Опубликованные да / нет
- Не удаленные

Результат представить ссылкой на репозиторий.
* Важно, в репозиторий залить пустой каркас приложения, а затем с внесенными изменениями, чтобы можно было проследить diff.

## Реализация

Эндпоинты:<br>
GET /api/products/  <br>
 - Параметры для филтрации:<br>
 - -  search - Название продукта<br>
 - -  price_min - Минимальная цена  (включительно)<br>
 - -  price_max - Максимальная цена (включительно)<br>
 - -  category_name - Название категории<br>
 - -  published - Опубликованные true|false<br>
 - -  deleted - Удаленные  true| false <br>


### Запускать миграцию и сидер
php artisan migrate && php artisan db:seed


