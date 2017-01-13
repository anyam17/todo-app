<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assigntask extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function task() {
    	return $this->belongsTo(Task::class);	
    }
}
