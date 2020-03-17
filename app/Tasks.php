<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Tasks extends Model
{
    use Sortable;
    protected $table = 'tasks';

    protected $fillable = [
        'task_name', 'status','due_date', 'user_id'
    ];

    public $sortable = ['due_date', 'status'];
}
