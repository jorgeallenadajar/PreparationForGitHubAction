<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ict_lib_files extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function get_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function get_category()
    {
        return $this->belongsTo(ict_lib_category::class, 'category_id', 'id');
    }

    public function get_system()
    {
        return $this->belongsTo(ict_lib_system::class, 'system_id', 'id');
    }



}
