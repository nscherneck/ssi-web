<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use CausesActivity;
    
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'last_login',
        ];    
    protected $hidden = [
        'password', 
        'remember_token',
        ];
    
    public function customers()
    {
        return $this->hasMany('App\Test');
    }
    
    public function sites()
    {
        return $this->hasMany('App\Test');
    }
    
    public function systems()
    {
        return $this->hasMany('App\Test');
    }
    
    public function tests()
    {
        return $this->hasMany('App\Test');
    }
    
    public function deficiencies()
    {
        return $this->hasMany('App\Deficiency');
    }
    
    public function manufacturers()
    {
        return $this->hasMany('App\Manufacturer');
    }
    
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
