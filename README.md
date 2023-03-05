# Project : "FRUIT TEST"

Чтоб сбилдить весь проект:

    ./buildup.sh

Подтянуть зависимости composer и npm соответственно :

    ./composer.sh update
    ./npm.sh install

Залить миграций и создание новой миграции :

    ./migrate.sh
    ./make_migration.sh

Просто поднять или опустить проект :
    
    ./up.sh
    ./down.sh

Проверить состояние контейнеров : 

    ./ps_docker_compose.sh

Выполнить какую либо команду в контейнере php :

    ./console.sh

Получить фрукты по API и отправить майл как результат :
    
    ./get_fruits.sh



Профайлер по аддресу : `http://localhost/_profiler/`

Майлер по аддресу : `http://localhost:1080/`