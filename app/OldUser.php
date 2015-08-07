<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class OldUser extends Eloquent
{

    protected $table    = 'imb_oss_users';
    protected $fillable = ['Fname','Sname','Cell1','Password'];

}
