<?php

namespace App\Jobs;
use App\Tasks;
use App\User;
use Mail;
use App\Mail\UserEmail;
use App\Mail\AdminEmail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTaskEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $signature = 'task:users';

    protected $description = 'Send an email for missed tasks';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
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
