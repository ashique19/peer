<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SearchableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table    = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'role', 'firstname', 'lastname', 'name', 'address', 'city', 'state', 'postcode', 'country_id', 'parmanent_address', 'active', 'contact', 'referrer_id', 'referral_balance', 'referral_benefit_expiry_date', 'expiry_date', 'balance', 'user_photo', 'created_by','updated_by'];
    
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden   = ['password', 'remember_token'];
    
    
    /**
    *
    * Attributes which must be sql date and time instance
    * 
    * @var array
    * 
    */
    protected $dates    = ['expiry_date', 'referral_benefit_expiry_date'];
    
    
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'users.name' => 10,
            'users.email' => 10,
            'users.email' => 10,
            'users.address' => 10,
            'users.city' => 10,
            'users.state' => 10,
            'users.postcode' => 10
        ]
    ];
    
    
    /**
    *
    *   Passwords are always stored after being bcrypted
    *
    */
    
    public function setPasswordAttribute($value)
    {
        
        $this->attributes['password'] = bcrypt($value);
        
    }
    
    
    public function roles()
    {
        
        return $this->belongsTo('\App\Role','role');
        
    }
    
    
    public function scopeDevs($query)
    {
        
        return $query->where('role',1);
        
    }
    
    
    public function scopeAdmins($query)
    {
        
        return $query->where('role',2);
        
    }
    
    
    public function scopeClients($query)
    {
        
        return $query->where('role',3);
        
    }
    
    
    public function scopeVendors($query)
    {
        
        return $query->where('role',4);
        
    }
    
    
    public function referrer()
    {
        
        return $this->belongsTo('\App\User','referrer_id','id');
        
    }
    
    
    public function referees()
    {
        
        return $this->hasMany('\App\User','referrer_id','id');
        
    }
    
    
    public static function boot()
    {
        
        parent::boot();
        
        static::creating(function($model)
        {
            if(auth()->user())
            {
                
                $model->created_by = auth()->user()->id;
                
            }
            
            if(session()->has('referrer_id'))
            {
                
                $referrer = new self();

                $model->referrer_id = ($referrer->find(session('referrer_id'))) ? session('referrer_id') : null;
                
            }
            
            $days_till_parent_will_get_benefit = \App\Setting::first()->referral_point_active_days;
            
            $model->referral_benefit_expiry_date = \Carbon::now()->addDays($days_till_parent_will_get_benefit);
            
        });
        
        static::updating(function($model)
        {
            if(auth()->user())
            {
                
                $model->updated_by = auth()->user()->id;
                
            }
            
        });
        
    }
    
    
}
