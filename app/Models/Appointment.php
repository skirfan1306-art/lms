<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = "appointments";
    protected $guarded = [];
    // public $timestamps = false;

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
