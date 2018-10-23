<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Carbon;

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
    protected $table    = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'role', 'firstname', 'lastname', 'name', 'address', 'city', 'state', 'postcode', 'country_id', 'parmanent_address', 'active', 'contact', 'expiry_date', 'balance', 'paypal_email', 'paypal_currency', 'payza_email', 'payza_currency', 'bank_name', 'bank_branch', 'bank_swift_code', 'bank_account_number', 'bank_account_name', 'bank_currency', 'user_photo', 'note', 'api_token', 'created_by','updated_by'];
    
    
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
    protected $dates    = ['expiry_date'];
    
    
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
    
    
    public function country()
    {
        
        return $this->belongsTo('\App\Country');
        
    }
    
    
    public function buys()
    {
        
        return $this->hasMany('\App\Buyer');
        
    }
    
    
    public function travels()
    {
        
        return $this->hasMany('\App\Travel');
        
    }
    
    public function reviews()
    {
        
        return $this->hasMany('\App\Review', 'traveller_id');
        
    }
    
    public function scopeBuyerTraveler($query)
    {
        
        return $query->where('role', 3);
        
    }
    
    
    public function scopeAdmins($query)
    {
        
        return $query->where('role', 2);
        
    }
    
    
    public function scopeJoinedToday($query)
    {
        
        return $query->where('role', 3)->whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00' , Carbon::now()->format('Y-m-d').' 23:59:59'] );
        
    }
    
    
    public function scopeJoinedThisWeek($query)
    {
        
        return $query->where('role', 3)->whereBetween('created_at', [ Carbon::now()->addDays(-7)->format('Y-m-d').' 00:00:00' , Carbon::now()->format('Y-m-d').' 23:59:59'] );
        
    }
    
    
    public function scopeJoinedLastMonth($query)
    {
        
        return $query->where('role', 3)->whereBetween('created_at', [ Carbon::now()->addMonths(-1)->format('Y-m-d').' 00:00:00' , Carbon::now()->format('Y-m-d').' 23:59:59'] );
        
    }
    
    
    public function sentMessages()
    {
        
        return $this->hasMany('\App\Message', 'message_from');
        
    }
    
    
    public function receivedMessages()
    {
        
        return $this->hasMany('\App\Message', 'message_to');
        
    }
    
    
    public function sentChats()
    {
        
        return $this->hasMany('\App\Chat', 'message_from');
        
    }
    
    
    public function receivedChats()
    {
        
        return $this->hasMany('\App\Chat', 'message_to');
        
    }
    
    
    public function buyOffers()
    {
        
        return $this->hasMany('\App\Offer', 'buyer_id');
        
    }
    
    
    public function carryOffers()
    {
        
        return $this->hasMany('\App\Offer', 'traveller_id');
        
    }
    
    
    public function buyPosts()
    {
        
        return $this->hasMany('\App\Buyer');
        
    }
    
    
    public function tripPosts()
    {
        
        return $this->hasMany('\App\Travel');
        
    }
    
    
    public function orders()
    {
    
        return $this->hasMany('\App\Order');
    
    }
    
    
    public function receivedNotifications()
    {
        
        return $this->hasMany('\App\Notification', 'notification_to');
        
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
