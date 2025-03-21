<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];


    protected $guarded = [];




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function company()
    {
        return $this->belongsTo(ict_lib_companies::class, 'comp_id', 'id');
    }
    public function get_systems()
    {
        return $this->hasMany(ict_lib_system::class, 'user_id', 'id');
    }
    public function get_department()
    {
        return $this->belongsTo(ict_lib_department::class, 'dept_id', 'id');
    }

    public function get_position()
    {
        return $this->belongsTo(ict_lib_position::class, 'pos_id', 'id');
    }
}
