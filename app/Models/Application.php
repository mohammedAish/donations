<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';

    protected $fillable = [
        'owner_name','gender','nationality','phone','email','code','id_number','city','neighborhood',
        'relativeـname','phoneـrelative','relative','salary','current_job',
        'owner_condition','id_photo','medical_report','housing_contract',
        'definition_salary','visa_photo','other','status','file_researcher',
    ];
}
