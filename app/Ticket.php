<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //Table name
    protected $table = 'tickets';

    //Primary Key
    public $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
