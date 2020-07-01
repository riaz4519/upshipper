<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    //

    protected $fillable  = ['item_number','platform_id','link','short_link'];
}
