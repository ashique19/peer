<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class NavRole extends Model
{
    protected $table = 'nav_role';
    
    protected $fillable = ['nav_id','role_id'];
    
    public function scopeAuth($query)
    {
    
        $query->where('nav_role.role_id', Auth::user()->role)->join('navs','navs.id','=','nav_role.nav_id');
        
    }
    
    public function scopePublic($query)
    {
        
        $query->join('navs','navs.id','=','nav_role.nav_id')->where('navs.is_public','1');
        
    }
    
    public function scopeLeftnav($query)
    {
        
        $query->where('location', '1'); // 1= left nav, 2= top nav;
        
    }
    
    public function scopeTopnav($query)
    {
        
        $query->where('location', '2'); // 1= left nav, 2= top nav;
        
    }
    
    public function scopeActive($query)
    {
        
        //$query->join('navs','navs.id','=','nav_role.nav_id');
        $query->where('navs.active','1');
        
    }
    
    public function scopeParent($query)
    {
        
        $query->where('type','0');
        
    }
    
    public function scopeChild($query, $parent = null)
    {
        
        $query->where('type','1');
        
        if($parent != null)
        {
            
            $query->where('parent',$parent);
            
        }
        
    }
    
    
    
}
