<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories_model extends Model
{
    protected $table = 'categories';

    public function childs() {

        return $this->hasMany('App\Categories_model','parent_id','id')->orderBy('position','asc'); ;

    }
}
