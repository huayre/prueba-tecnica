<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'email',
        'birth_date',
        'charge',
        'area',
        'contract_start_date',
        'contract_end_date',
        'type_contract'
    ];

}
