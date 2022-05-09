<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $hidden = ['updated_at'];

    protected $casts = [
        'active' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:ia'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'city_id', 'id');
    }

    //function get____Attribute() {}
    public function getActiveStatusAttribute()
    {
        return $this->active ? 'Active' : 'Disabled';
    }
}
