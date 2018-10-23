<?php

namespace App\Http\Traits;

Trait Images
{
    
    /**
     * Store Single Image
    */
    private function storeImage($request, $image_name, $folder)
    {
        
        $saved_image = "";
        
        if($request->hasFile( $image_name ))
        {
            if($request->file( $image_name )->isValid())
            {
                
                
                /**
                 * SimpleImage can't make dir. It returns error if directory does not exist.
                 * Make directory (if it dows not exists) before putting file in it
                 */
                $location   = public_path().'/img/'.$folder.'/';
                if(!is_dir($location))
                {
                    
                    mkdir($location, 0777, true);
                                    
                }
                
                
                /**
                *
                * Prepare names for file at different sizes
                * 
                */
                $img_name  = date('Ymdhis').'_'.rand(100,999);
                $image_lg  = $img_name.'_lg.'.$request->file( $image_name )->getClientOriginalExtension();
                $image_md  = $img_name.'_md.'.$request->file( $image_name )->getClientOriginalExtension();
                $image_sm  = $img_name.'_sm.'.$request->file( $image_name )->getClientOriginalExtension();
                $image_xs  = $img_name.'_xs.'.$request->file( $image_name )->getClientOriginalExtension();
                
                // Instantiate SimpleImage class
                $image = new \App\Http\Controllers\SimpleImage($request->file( $image_name ));
                
                
                // Size:lg
                $image->best_fit(1200,600);
                $image->save($location.$image_lg);
                
                // Size:md
                $image->best_fit(640,640);
                $image->save($location.$image_md);
                
                // Size:sm
                $image->best_fit(320,320);
                $image->save($location.$image_sm);
                
                // Size:xs
                $image->best_fit(100,75);
                $image->save($location.$image_xs);
                
                $saved_image = '/public/img/'.$folder.'/'.$image_lg;
                
            }
                        
        }
        
        return $saved_image;
        
    }
    
    
    /**
     * Delete Single Image
    */
    private function deleteImage($instance, $column_name)
    {
        
        $image_name = $instance->$column_name ;
        
        
        if($instance->$column_name)
        {
            
            $image_to_delete_lg = $instance->$column_name;
            $image_to_delete_md = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'md'.substr($image_to_delete_lg, -4);
            $image_to_delete_sm = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'sm'.substr($image_to_delete_lg, -4);
            $image_to_delete_xs = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'xs'.substr($image_to_delete_lg, -4);
            
            if(\Storage::has($image_to_delete_lg))
            {
                
                \Storage::delete($image_to_delete_lg);
                
            }
            
            if(\Storage::has($image_to_delete_md))
            {
                
                \Storage::delete($image_to_delete_md);
                
            }
            
            if(\Storage::has($image_to_delete_sm))
            {
                
                \Storage::delete($image_to_delete_sm);
                
            }
            
            if(\Storage::has($image_to_delete_xs))
            {
                
                \Storage::delete($image_to_delete_xs);
                
            }
            
            $image_name = "";
            
        }
        
        
        return $image_name;
        
    }
    
    
    /**
     * Delete Single Image from Request
    */
    private function deleteImageFromRequest($request, $instance, $input_name, $column_name)
    {
        
        $image_name = $instance->$column_name ;
        
        if($request->has($input_name))
        {
            
            $image_name = $this->deleteImage( $instance, $column_name );
            
        }
        
        return $image_name;
        
    }
    
    
    /**
     * Update Single Image
    */
    private function updateImage( $request, $instance, $input_name, $column_name, $folder, $image_to_delete = null )
    {
        
        $saved_image = $instance->$column_name;
        
        if($image_to_delete)
        {
            
            $saved_image = $this->deleteImageFromRequest( $request, $instance, $image_to_delete, $column_name );
            
        }
        
        
        
        if($request->hasFile($input_name))
        {
            if($request->file($input_name)->isValid())
            {
                
                /**
                *
                * At first, remove previous items, if they exist
                * 
                */
                if($instance->$column_name)
                {
                    
                    $image_to_delete_lg = $instance->$column_name;
                    $image_to_delete_md = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'md'.substr($image_to_delete_lg, -4);
                    $image_to_delete_sm = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'sm'.substr($image_to_delete_lg, -4);
                    $image_to_delete_xs = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'xs'.substr($image_to_delete_lg, -4);
                    
                    if(\Storage::has($image_to_delete_lg))
                    {
                        
                        \Storage::delete($image_to_delete_lg);
                        
                    }
                    
                    if(\Storage::has($image_to_delete_md))
                    {
                        
                        \Storage::delete($image_to_delete_md);
                        
                    }
                    
                    if(\Storage::has($image_to_delete_sm))
                    {
                        
                        \Storage::delete($image_to_delete_sm);
                        
                    }
                    
                    if(\Storage::has($image_to_delete_xs))
                    {
                        
                        \Storage::delete($image_to_delete_xs);
                        
                    }
                    
                }
                
                /**
                 * SimpleImage can't make dir. It returns error if directory does not exist.
                 * Make directory (if it dows not exists) before putting file in it
                 */
                $location   = public_path().'/img/'.$folder.'/';
                if(!is_dir($location))
                {
                    
                    mkdir($location, 0777, true);
                                    
                }
                
                
                /**
                *
                * Prepare names for file at different sizes
                * 
                */
                $img_name  = date('Ymdhis').'_'.rand(100,999);
                $image_lg  = $img_name.'_lg.'.$request->file( $input_name )->getClientOriginalExtension();
                $image_md  = $img_name.'_md.'.$request->file( $input_name )->getClientOriginalExtension();
                $image_sm  = $img_name.'_sm.'.$request->file( $input_name )->getClientOriginalExtension();
                $image_xs  = $img_name.'_xs.'.$request->file( $input_name )->getClientOriginalExtension();
                
                // Instantiate SimpleImage class
                $image = new \App\Http\Controllers\SimpleImage($request->file($input_name));
                
                
                // Size:lg
                $image->best_fit(1200,600);
                $image->save($location.$image_lg);
                
                // Size:md
                $image->best_fit(640,640);
                $image->save($location.$image_md);
                
                // Size:sm
                $image->best_fit(320,320);
                $image->save($location.$image_sm);
                
                // Size:xs
                $image->best_fit(100,75);
                $image->save($location.$image_xs);
                
                $saved_image = '/public/img/'.$folder.'/'.$image_lg;
                
            }
                        
        }
        
        return $saved_image;
        
    }
    
    
    /**
     * Store Multiple Images
    */
    private function storeImages( $request, $input_name, $folder )
    {
        
        $imagelist = [];
        
        if($request->hasFile( $input_name ))
        {
            
            for($i = 0; $i < count($request->file( $input_name )); $i++)
            {
            
                if($request->file( $input_name )[$i]->isValid())
                {
                    
                    
                    /**
                     * SimpleImage can't make dir. It returns error if directory does not exist.
                     * Make directory (if it dows not exists) before putting file in it
                     */
                    $location   = public_path().'/img/'.$folder.'/';
                    if(!is_dir($location))
                    {
                        
                        mkdir($location, 0777, true);
                                        
                    }
                    
                    
                    /**
                    *
                    * Prepare names for file at different sizes
                    * 
                    */
                    $img_name  = date('Ymdhis').'_'.rand(100,999);
                    $image_lg  = $img_name.$i.'_lg.'.$request->file( $input_name )[$i]->getClientOriginalExtension();
                    $image_md  = $img_name.$i.'_md.'.$request->file( $input_name )[$i]->getClientOriginalExtension();
                    $image_sm  = $img_name.$i.'_sm.'.$request->file( $input_name )[$i]->getClientOriginalExtension();
                    $image_xs  = $img_name.$i.'_xs.'.$request->file( $input_name )[$i]->getClientOriginalExtension();
                    
                    // Instantiate SimpleImage class
                    $image = new \App\Http\Controllers\SimpleImage($request->file( $input_name )[$i]);
                    
                    
                    // Size:lg
                    $image->best_fit(1200,600);
                    $image->save($location.$image_lg);
                    
                    // Size:md
                    $image->best_fit(640,400);
                    $image->save($location.$image_md);
                    
                    // Size:sm
                    $image->best_fit(320,225);
                    $image->save($location.$image_sm);
                    
                    // Size:xs
                    $image->best_fit(100,75);
                    $image->save($location.$image_xs);
                    
                    $imagelist[] = '/public/img/'.$folder.'/'.$image_lg;
                    
                }
            
            }
                        
        }
        
        return $imagelist;
        
    }
    
}