<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\MakeBackup;
use Dropbox;
use Storage;
use Log;

class Backup extends Controller
{
    
    /**
     * $file = File to upload
     * 
     * $dropboxFolder = dropbox folder where file should be uploaded
     * 
     * $directoryToDelete = Local Directory to delete after upload is complete
    */
    public function upload($file, $dropboxFolder = '/backup/', $directoryToDelete = null)
    {
        
        $fp = fopen($file, "rb");
                
        $filename = explode( '/', $file );
        
        $filename = array_pop( $filename );
        
        $upload_status = Dropbox::uploadFile( $dropboxFolder.$filename, Dropbox\WriteMode::add(), $fp);
        
        Log::info($upload_status);
        
        if( $directoryToDelete != null )
        {
            
            Storage::deleteDirectory( $directoryToDelete );
        
            Log::info('Dropbox: Deleted Directory: '.$directoryToDelete);
            
        }
        
        return $upload_status;
        
    }
    
    
    
    public function compress()
    {
        
        \Artisan::call('backup:run');
        
    }
    
    
    public function make()
    {
        
        $this->compress();
        
        
        $folders = Storage::directories( 'storage/backups' );
        
        sort( $folders );
        
        if($folders){
            
            $folder = array_pop( $folders );
            
            $files  = Storage::files( $folder );
            
            sort( $files );
            
            if( $files )
            {
                
                $file = array_pop( $files );
                
                return $this->upload($file, '/backup/', $folder);
                
            }
            
            
        }
        
    }
    
    
    /**
     * backup database
    */
    public function database()
    {
        
        // $job = ( new MakeBackup( new self ) )->delay(10);
        
        // $queue = $this->dispatch( $job );
        
        $this->make();
        
        return back()->withErrors('Backup completed successfully');
        
    }
    
    
    
    /**
     * @return Illuminate\Http\response
    */
    public function getStatus()
    {
        
        return view('admin.backup.status');
        
    }
    
    
    
    
}
