<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Tasks extends Model
{
    use Sortable;
    use QueryCacheable;

    protected $fillable = [
        'task_name', 'status','due_date', 'user_id', 'admin_id'
    ];

    public $sortable = ['due_date', 'status'];



}
