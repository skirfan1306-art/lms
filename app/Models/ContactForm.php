<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $table = "contact_form";
    protected $guarded = [];
    public $timestamps = false;
}