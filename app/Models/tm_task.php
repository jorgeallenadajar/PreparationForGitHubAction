<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tm_task extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function get_difficult()
    {
        return $this->belongsTo(ict_lib_system::class, 'task_difficult', 'id');
    }

}
