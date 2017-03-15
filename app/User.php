<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'last_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customers() // technician who completed test
    {
      return $this->hasMany('App\Test');
    }

    public function sites() // technician who completed test
    {
      return $this->hasMany('App\Test');
    }

    public function systems() // technician who completed test
    {
      return $this->hasMany('App\Test');
    }

    public function tests() // technician who completed test
    {
      return $this->hasMany('App\Test');
    }

    public function deficiencies() // technician who completed test
    {
      return $this->hasMany('App\Deficiency');
    }

    public function manufacturers() // technician who completed test
    {
      return $this->hasMany('App\Manufacturer');
    }

    public function getFullNameAttribute()
    {
      return $this->first_name . ' ' . $this->last_name;
    }

}
