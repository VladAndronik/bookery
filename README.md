# Bookery

Проект по створенню онлайн-магазину для продажу книг

Цей репозиторій для командного проекту на літній практиці



# Що завантажити?
 Оскільки проект розробляється під локальний сервер - необхідно завантажити [OpenServer](https://ospanel.io/download/). Системні вимоги:
  - Підтримувані версії ОС: 64-біт Windows 7 SP1 або новіше (32-бітові системи не підтримуються);
  - Мінімальні апаратні вимоги: 500 МБ вільної RAM і 4 ГБ вільного місця на HDD;
  - Наявність Microsoft Visual C ++ 2005-2008-2010-2012-2013-2015-2019 Redistributable Package;
  

Для коректної роботи збірку у вигляді архіву RAR бажано розмістити на жорсткому диску.


> OpenServer широкофункціональна платформа для розробки веб-продуктів
> При завантажені, окрім .exe файлів для старту роботи, також наявні папки *modules* та *userdata*
> В них зберігаються необхідні для роботи з системою та MySQL модулі, програми, службові файли
> Проект, що потрібно запустити зберігаємо в папці *domains*
## Запуск проекту

Перед безпосереднім запуском проекту необхідно здійснити підключення до MySQL в файлі *db_params*: 
```sh
return array(
     'host' => 'localhost',
     'dbname' => 'myshop',
     'user' => 'root',
     'password' => '', )
```
Після того, як база даних підключена, можемо розпочинати роботу:
 1. Для запуску Open Server використовуйте файл Open Server x64.exe для запуску на 64-розрядній системі чи Open Server x86.exe, відповідно, на 86-розрядній системі.
 2. Після старту програми ви побачите червоний прапорець в області повідомлень Windows (область біля системного годинника).
 3. Щоб включити безпосередньо сам веб-сервер і супутні модулі -  натисніть на прапорець, далі виконайте [Меню → Запустити].
 4. Підля цього прапорець стане зеленим та з'явиться посилання *"Мої сайти"* з переліком доступних веб-продуктів ( ті, що наявні в папці *domains*)
 5. Після обрання необхідного програма запустить веб-продукт на домен *localhost*, який присутній в OpenServer за замовчуванням.
