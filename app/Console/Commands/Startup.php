<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class Startup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:startup {--skippackages=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build structures from Start to start.';
    
    
    /**
     * Writes files and directories. Overwrites if already exists
     *
     * @var string
     */
    function file_write($dir, $contents)
    {
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part)
            if(!is_dir($dir .= "/$part")) mkdir($dir);
        file_put_contents("$dir/$file", $contents);
    }
    
    
    /**
     * Copies files and folders from source to destination
     *
     * @var string
     */
    public function copy_files($src,$dst)
    { 
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    $this->copy_files($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
    } 


    /**
    *
    * Startup Will setup the entire application for the initial use
    * 
    */
    public function startup()
    {
        
        $source = app_path().'/Console/Sources/Startup/';
        
        
        $this->copy_files($source.'Root', base_path());
        $this->copy_files($source.'Controllers', app_path().'/Http/Controllers');
        
        if(! $this->option('skippackages'))
        {
            
            exec('composer dump-autoload && composer update');
            
            exec('npm install --global gulp-cli && npm install && gulp');
            
        }
        
        
        $this->copy_files($source.'Migrations', database_path().'/migrations');
        $this->copy_files($source.'Seeds', database_path().'/seeds');
        $this->copy_files($source.'Requests', app_path().'/Http/Requests');
        $this->copy_files($source.'Middlewares', app_path().'/Http/Middleware');
        $this->copy_files($source.'Https', app_path().'/Http');
        $this->copy_files($source.'Routes', app_path().'/Http');
        $this->copy_files($source.'Models', app_path());
        $this->copy_files($source.'Publics', public_path());
        $this->copy_files($source.'Views', base_path().'/resources/views');
        $this->copy_files($source.'Configs', base_path().'/config');
        $this->copy_files($source.'Assets', base_path().'/resources/assets');
        
        exec('composer dump-autoload');
        $this->call('cache:table');
        $this->call('migrate:refresh');
        $this->call('db:seed');
        
    }



    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $this->startup();
        
    }
}
