<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = "comments";
    
    protected $fillable = ['id', 'name', 'user_id', 'blog_id', 'is_published', 'is_reply', 'comment_id', 'commenter_name', 'commenter_email', 'rate', 'created_at', 'updated_at'];
    
    
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
            
    public function blog()
    {
        
        return $this->belongsTo('\App\Blog');
        
    }
            
    public function comment()
    {
        
        return $this->belongsTo('\App\Comment');
        
    }
    
    public function scopePublished($query)
    {
        
        return $query->where('is_published', 1);
        
    }
            
    
    public function scopeReplyOf($query, $comment_id)
    {
        
        return $query->where('is_reply', 1)->where('comment_id', $comment_id);
        
    }
            
    
    public function scopeReply($query)
    {
        
        return $query->where('is_reply', 1);
        
    }
            
    
    public function scopeNotReply($query)
    {
        
        return $query->where('is_reply', 0);
        
    }
    

}

        