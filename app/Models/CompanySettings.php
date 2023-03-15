<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    use HasFactory;
    protected $fillable = ['company_name','company_logo','phone_number','company_email','company_address','country','footer','fav_icon','time_zone','date_format','login_image','colour'];
}
