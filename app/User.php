<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username' , 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    // protected $guarded = [];
    
    public function doctor(){
        return $this->hasOne('App\Doctor');
     }
     public function photo(){
        return $this->hasOne('App\Photo');
     }

     public function district()
    {

        return $this->belongsto('App\District');
    }
    public function division()
    {

        return $this->belongsto('App\Division');
    }
    public function user(){
        return $this->belongsTo('App\User');
     }

     public function serial(){
        return $this->hasMany('App\Serial');
     }
}
