<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'surname',
        'email',
        'password',
        'salt',
        'usergroup',
        'email_validation',
        'validation_string',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];




}

