<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table='compaines';
    protected $fillable=[
        'company_name',
        'commpany_address',
        'company_phone',
        'company_email',
        'company_fax',
    ];
}
