<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    
    protected $table= 'navs';
    
    protected $fillable = ['name','type','parent','active','route','icon','location','is_public'];
    
    
    
    
    
    public function scopeParents($query)
    {
        
        $query->where('type', '0');
        
    }
    
    
    
    
    
    public function scopeChildren($query, $parent = null)
    {
        
        $query->where('type', '1');
        
        if($parent != null)
        {
            
            $query->where('parent', $parent);
            
        } 
        
    }
    
    
    
    
    
    
    public function roles()
    {
        
        return $this->belongsToMany('\App\Role');
        
    }
    
    
    
    
}
