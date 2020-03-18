<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Tasks;
use App\User;
use Mail;
use App\Mail\UserEmail;
use App\Mail\AdminEmail;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTaskEmail  extends Command implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send e-mail to admin and user if task due date has been missed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $admin=User::join('tasks', 'tasks.admin_id', '=', 'users.id')
            ->select('users.email')
            ->where([
                ['due_date', '<', date('Y-m-d H:i')],
                ['status', '!=', '3']])->get();
        $user=User::join('tasks', 'tasks.user_id', '=', 'users.id')
            ->select('users.email')
            ->where([
                ['due_date', '<', date('Y-m-d H:i')],
                ['status', '!=', '3']])->get();


        $emailtoAdmin = new AdminEmail();
        $emailtoUser = new UserEmail();
        Mail::to($admin)->send($emailtoAdmin);
        Mail::to($user)->send($emailtoUser);
    }
}
