# Quick start

```sh
cd /config
cp config.example.php config.php
```

```sh
cd /public
php -S localhost:8000
```

# ТЗ
1) Распаковать архив и залить дамп в БД.
Написать код, который реализует взаимодействие клиент-сервер.
Получить из GET параметра ID клиентов и сделать выборку из базы в которой будет ФИО клиента и его заказы с товарами отсортированные по полю title в алфавитном порядке и по цене по убыванию.
Сформировать из этих данных JSON и сделать вывод на HTML странице. Соединение между клиентом и сервером реализовывать необязательно. В ответ прислать PHP, JS, HTML, который получился. Код нужно написать без использования PHP фреймворков и сторонних библиотек. При обработке параметров и данных использовать все необходимые меры безопасности, как в реальных условиях. 

2) Написать код PHP, в котором нужно от клиента принять данные по товарам и записывають их в таблицу products в виде нескольких записей.

4. Сделайте реализацию паттерна Singelton. Посмотрите, можно ли его применить в первом задании.
