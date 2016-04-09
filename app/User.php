<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {
    
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dob', 'is_operator', 'sex', 'passcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * make sure the name is stored in lower case
     * 
     * @param type $name
     */
    public function setNameAttribute($name) {
        $this->attributes['name'] = strtolower(str_slug($name, "_"));
                
    }

    /**
     * make sure the email is stored in lower case
     * 
     * @param type $name
     */
    public function setEmailAttribute($email) {
        $this->attributes['email'] = strtolower($email);
    }

    /**
     * Always convert the password to a hash value before savings
     * 
     * @param string $password
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Convert the dob into a carbon instance
     * 
     * @var array
     */
    protected $dates = ['dob'];
    
    public function setDobAttribute($dob){
        $this->attributes['dob'] = Carbon::createFromFormat('d-m-Y', $dob);
    }

    /**
     * For each patient (tracked in the users table), there could be multiple reports
     * 
     * @return type
     */
    public function reports() {
        return $this->hasMany('App\Report');
    }

    /**
     * A local scope to return all the patients
     * 
     * @param type $query
     * @return type
     */
    public function scopePatients($query){
        return $query->where('is_operator', '0');
    }
    
}
