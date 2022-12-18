Here I create User send new message using Laravel framework with MySQL. And I tested it with postman

1. Then create a database with the name db_rakamin.
2. After creating the database, run the "php artisan migrate" command in the terminal.
3. Then run the command "php artisan db:seed --class=DatabaseSeeder" in the terminal.
4. Then run the command "php artisan serve" in the terminal.
5. this is the endpoint used:

-   http://localhost:8000/api/login
    This endpoint is used for login authentication.
    Input example:
    email : admin1@gmail.com
    password : 123456789

-   http://localhost:8000/api/message
    This endpoint is used for user send new message.
    Input example:
    id : 2
    message : hallo

-   http://localhost:8000/api/message/{room}
    This endpoint is used for user user reply to existing conversation using the parameter room that was created before.
    Input example:
    id : 1
    message : hai

#The room parameter is created after running the previous endpoint and is created randomly and using a different user.
#New user -> email : admin2@gmail.com, password : 123456789

-   http://localhost:8000/api/room-chat/{room}
    This endpoint is used for user listing all messages in specific conversation using the parameter room that was created before.

#The room parameter is created after running the previous endpoint and is created randomly.

-   http://localhost:8000/api/room-chat
    This endpoint is used for user listing all conversation they involved.

Thank You.
