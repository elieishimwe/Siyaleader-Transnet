<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseResponder extends Eloquent
{


    protected $table    = 'responders';
    protected $fillable = ['type','department','category','sub_category','user','active'];



}
