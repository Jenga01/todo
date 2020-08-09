## To do task list
- create users/admins
- Admins can create tasks for the users
- Users can change tasks status(In progress/Done)
- Users can sort tasks by status/due date
- Automatic e-mail notifications through rabbitmq to users/admins if task(-s) hasn't been done and due date has expired


## Setup
Install missing dependencies:
`composer install`

And generate APP_KEY in .env file: `php artisan key:generate`

API is using JWT for authentication, hence password is needed for the JWT. Execute this command:

`php artisan jwt:secret`

This will create JWT_SECRET key in .env file.

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

## Caching tasks

Tasks are cached for 1 hour:

```PHP
public function show()
    {
        $tasks = Tasks::where('user_id',
            Auth::user()->id)->sortable()->cacheFor(60*60)->paginate(5);


        return view('users.tasks')->with(compact('tasks'));
    }
 ```

## Sending e-mails

Start queue worker:
`php artisan queue:work`

If running project on a hosted server, execute this command instead: `nohup php artisan queue:work --daemon > /dev/null 2>&1 &`


To run scheduler(e.g. on a Forge) use this commmand:

`* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

This will be triggering command registered in App\Console\Kernel.php: 

```PHP
 protected function schedule(Schedule $schedule)
    {
        $schedule->command('task:users')
            ->everyThirtyMinutes();
    }
```
   
Alternatively if you want to trigger this command manually, execute:

`php artisan task:users`
