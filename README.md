## To do task list
- create users/admins
- Admins can create tasks for the users
- Users can change tasks status(In progress/Done)
- Users can sort tasks by status/due date
- Automatic e-mail notifications through rabbitmq to users/admins if tasks hasn't been done and due date has expired

## USER API Endpoints

- GET: api/users - getlist of users
- POST:api/user - store user
- PUT: api/user/id - update user
- DELETE: api/user/id - delete user

#### User authentication API

- POST: api/register - registers new user
- POST: api/login - user login
- POST: api/refresh - refreshes user token
- POST: api/logout - logs out user

Since it's using JWT authentication, password is needed for the JWT. Execute this command:

`php artisan jwt:secret`

This will create JWT_SECRET key in .env file.
