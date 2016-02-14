######Install:

    composer install

######Usage:

    php -S localhost:8080 -t web/

######Routes:

    - GET /statuses - Retrieve all statuses
    - GET /statuses/12 - Retrieve status #12
    - POST /statuses - Create a new status
    - PUT /statuses - Update a status
    - DELETE /statuses/12 - Delete status #12

######Create data-only container
docker run -d \
    --volume /var/lib/mysql \
    --name data_mysql \
    --entrypoint /bin/echo \
    busybox \
    "mysql data-only container"

######Launch mySql container
    docker run -d -p 3306 \
        --name mysql \
        --volumes-from data_mysql \
        -e MYSQL_USER=uframework \
        -e MYSQL_PASS=p4ssw0rd \
        -e ON_CREATE_DB=uframework \
        tutum/mysql

######Connect to mysql server
mysql uframework -h 127.0.0.1 -P32768 -uuframework -pp4ssw0rd
(port may be different, type "docker ps" to see which port you must use)

######Load database
mysql uframework -h 127.0.0.1 -P32768 -uuframework -pp4ssw0rd < app/config/schema.sql