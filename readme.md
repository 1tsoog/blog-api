## Этапы развертывания проекта
    composer install
    
Создать копию файла .env.example с названием .env
Выполнить команду генерации секретного ключа:
    
    php artisan key:generate
    
   
Нужно создать базу данных с названием: api_database и кодировкой utf8mb4_general_ci
И пользователя в ней. Эти данные нужно прописать в файл .env в разделе DB

Связать хранилище файлов с публичной папкой:
        
    php artisan storage:link
    
Выполнить миграции:

    php artisan migrate
Главная страница сайта запускается.


Чтобы отправлять запросы к API нужно передавать токен, который 
доступен в личном кабинете пользователя.
Передавать либо в QUERY либо в теле POST запроса с названием ключа api_key=(ключ здесь).
Либо передавать в заголовках с ключем Authorization: Bearer (ключ здесь).



VirtualHosts for local dev

    <VirtualHost blogapi.dev:80>
    ServerAdmin admin@mail.ru
    DocumentRoot "H:/WEB/Xampp/htdocs/blogapi.dev/public"
    ServerName blogapi.dev
	<Directory blogapi.dev/public >
        Options FollowSymLinks
        AllowOverride FileInfo Options
    </Directory>
    ErrorLog "logs/blogapi.dev-error.log"
    CustomLog "logsblogapi.dev-access.log" common
    </VirtualHost>


