<?php

/**
 * ************************************************************************************
 * Permission methods
 * ************************************************************************************
 * 
 */




/**
 * 
 * Does current loggedin user has access to the following areas for this table?
 * 
 */
function canview($table)
{
    
    $action = "App\Http\Controllers\\".ucfirst($table)."@show";
    
    if(\App\Setting::first()->is_controlled_access != 1)
    {
        
        return true;
        
    }
    
    if(auth()->user()->roles()->first()->permissions()->where('permissions.name', $action)->first())
    {
        
        return true;
        
    } else{
        
        return false;
        
    }
        
}

function canedit($table)
{
    
    $action = "App\Http\Controllers\\".ucfirst($table)."@edit";
    
    if(\App\Setting::first()->is_controlled_access != 1)
    {
        
        return true;
        
    }
    
    if(auth()->user()->roles()->first()->permissions()->where('permissions.name', $action)->first())
    {
        
        return true;
        
    } else{
        
        return false;
        
    }
        
}

function candelete($table)
{
    
    $action = "App\Http\Controllers\\".ucfirst($table)."@destroy";
    
    if(\App\Setting::first()->is_controlled_access != 1)
    {
        
        return true;
        
    }
    
    if(auth()->user()->roles()->first()->permissions()->where('permissions.name', $action)->first())
    {
        
        return true;
        
    } else{
        
        return false;
        
    }
        
}

function canaccess($controller, $method)
{
    
    $action = "App\Http\Controllers\\$controller@$method";
    
    if(auth()->user()->roles()->first()->permissions()->where('permissions.name', $action)->first())
    {
        
        return true;
        
    } else{
        
        return false;
        
    }
    
}



/**
 * 
 * Can the current logged in user do the following to specific items of the table?
 * 
 * @return HTML <a> tag
 * 
 * @params
 *      $table      (string)    = subject database table
 *      $id         (integer)   = row id
 *      $text       (string)    = text to display at <a> tag or <button>
 *      $attributes (array)     = any attributes that this <a> tag or <button> or <form> should hold
 * 
 */
function views($table, $id, $text, $attributes = [])
{
    
    if(canview($table))
    {
    
        $link = "<a href=\"".action(ucfirst($table).'@show',$id)."\"";
        
        if($attributes)
        {
            
            foreach($attributes as $k=>$v)
            {
                
                $link .= " $k=\"$v\"";
                
            }
            
        }
        
        $link.=">$text</a>";
        
        return $link;
    
    }

    
}

function edits($table, $id, $text, $attributes = [])
{
    
    if(canedit($table))
    {
    
        $link = "<a href=\"".action(ucfirst($table).'@edit',$id)."\"";
        
        if($attributes)
        {
            
            foreach($attributes as $k=>$v)
            {
                
                $link .= " $k=\"$v\"";
                
            }
            
        }
        
        $link.=">$text</a>";
        
        return $link;
    
    }
    
}

function deletes($table, $id, $text, $attributes = [])
{
    
    if(candelete($table))
    {
        
        $form  = Form::open([ 'url'=> action(ucfirst($table).'@destroy',$id) , 'method' => 'DELETE']);
        
        $form .= "<button type=\"submit\"";
        
        if($attributes)
        {
            
            foreach($attributes as $k=>$v)
            {
                
                $form .= " $k=\"$v\"";
                
            }
            
        }
        
        $form .= ">$text</button>";
        
        $form .= Form::close();
        
        return $form;
    
        $link = "<a href=\"".action(ucfirst($table).'@edit',$id)."\"";
        
        if($attributes)
        {
            
            foreach($attributes as $k=>$v)
            {
                
                $link .= " $k=\"$v\"";
                
            }
            
        }
        
        $link.=">$text</a>";
        
        return $link;
    
    }
    
}




/**
 * ************************************************************************************
 * Simplify image names. Return the expected output
 * ************************************************************************************
 */

function xs_fb($link)
{
    
    return ends_with($link, 'width=1920') ? str_replace('width=1920', 'width=320', $link) : $link;
    
}
 
function xs_link($name="")
{
    
    return url( str_replace('_lg.', '_xs.', $name) );
    
}


function xs($name, $class = "", $alt="")
{
    
    return "<img src=\"".xs_link($name)."\" class=\"img-responsive $class\" alt=\"$alt\" />";
    
}

function sm($name, $class = "", $alt="")
{
    
    return "<img src=\"".url(substr($name, 0, -6).'sm'.substr($name, -4))."\" class=\"img-responsive $class\" alt=\"$alt\" />";
    
}

function md($name, $class = "", $alt="")
{
    
    return "<img src=\"".url(substr($name, 0, -6).'md'.substr($name, -4))."\" class=\"img-responsive $class\" alt=\"$alt\" />";
    
}

function lg($name, $class = "", $alt="")
{
    
    return "<img src=\"".url(substr($name, 0, -6).'lg'.substr($name, -4))."\" class=\"img-responsive $class\" alt=\"$alt\" />";
    
}

function thumb($name, $class = "", $alt="")
{
    
    return "<img src=\"".url(substr($name, 0, -6).'sm'.substr($name, -4))."\" class=\"img-thumbnail $class\" alt=\"$alt\" />";
    
}



/**
 * ************************************************************************************
 * Simple Functions
 * ************************************************************************************
 */
 

/**
*
* @parameter 1 or 0
* 
* @return 'Yes' or 'No' 
* 
*/
function yn($parameter)
{
    
    switch($parameter)
    {
        
        case 1: return 'Yes';
            break;
        
        case 0: return 'No';
            break;
            
        default: return $parameter;
            break;
        
    }
    
    
}
 
 
function errors($errors)
{
    
    $error_display = "";
    
    if($errors->any())
    {
        
        $error_display .= '<div class="row">';
            
            foreach($errors->all() as $error)
            {
                
                $error_display .= '<p class="alert alert-info">'.$error.'</p>';
                
            }
            
        $error_display .='</div>';
        
    }
    
    return $error_display;
    
}


/**
 * -----------------------------------------------------------------------------
 * System specific methods
 * -----------------------------------------------------------------------------
 */
 
 
/**
 * Buyer - Count Pending, accepted and rejected offers
*/

function buyer_count_pending_offers()
{
    
    return \App\Offer::where('buyer_id', auth()->user()->id)->notReply()->notAgreed()->notDeleted()->count();
    
}


function buyer_count_accepted_offers()
{
    
    return \App\Offer::where('buyer_id', auth()->user()->id)->agreed()->notReply()->notDeleted()->count();
    
}


function buyer_count_rejected_offers()
{
    
    return \App\Offer::notReply()->notAgreed()->deleted()->where('buyer_id', auth()->user()->id)->count();
    
}

 
/**
 * Traveler - Count Pending, accepted and rejected offers
*/

function traveler_count_pending_offers()
{
    
    return \App\Offer::where('traveller_id', auth()->user()->id)->notReply()->notAgreed()->notDeleted()->count();
    
}


function traveler_count_accepted_offers()
{
    
    return \App\Offer::where('traveller_id', auth()->user()->id)->notReply()->agreed()->notDeleted()->count();
    
}


function traveler_count_rejected_offers()
{
    
    return \App\Offer::where('traveller_id', auth()->user()->id)->notReply()->notAgreed()->deleted()->count();
    
}


/**
 * @return \App\Setting::find(1)
*/
function settings()
{
    
    return \Cache::remember('settings', env('CACHE_DURATION'), function(){
        
        return \App\Setting::first();
        
    });
    
}

/**
* Returns an string clean of UTF8 characters. It will convert them to a similar ASCII character
* www.unexpectedit.com 
*/
function cleanString($text) 
{
    // 1) convert á ô => a o
    $text = preg_replace("/[áàâãªä]/u","a",$text);
    $text = preg_replace("/[ÁÀÂÃÄ]/u","A",$text);
    $text = preg_replace("/[ÍÌÎÏ]/u","I",$text);
    $text = preg_replace("/[íìîï]/u","i",$text);
    $text = preg_replace("/[éèêë]/u","e",$text);
    $text = preg_replace("/[ÉÈÊË]/u","E",$text);
    $text = preg_replace("/[óòôõºö]/u","o",$text);
    $text = preg_replace("/[ÓÒÔÕÖ]/u","O",$text);
    $text = preg_replace("/[úùûü]/u","u",$text);
    $text = preg_replace("/[ÚÙÛÜ]/u","U",$text);
    $text = preg_replace("/[’‘‹›‚]/u","'",$text);
    $text = preg_replace("/[“”«»„]/u",'"',$text);
    $text = str_replace("–","-",$text);
    $text = str_replace(" "," ",$text);
    $text = str_replace("ç","c",$text);
    $text = str_replace("Ç","C",$text);
    $text = str_replace("ñ","n",$text);
    $text = str_replace("Ñ","N",$text);
 
    //2) Translation CP1252. &ndash; => -
    $trans = get_html_translation_table(HTML_ENTITIES); 
    $trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark 
    $trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook 
    $trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark 
    $trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis 
    $trans[chr(134)] = '&dagger;';    // Dagger 
    $trans[chr(135)] = '&Dagger;';    // Double Dagger 
    $trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent 
    $trans[chr(137)] = '&permil;';    // Per Mille Sign 
    $trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron 
    $trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark 
    $trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE 
    $trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark 
    $trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark 
    $trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark 
    $trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark 
    $trans[chr(149)] = '&bull;';    // Bullet 
    $trans[chr(150)] = '&ndash;';    // En Dash 
    $trans[chr(151)] = '&mdash;';    // Em Dash 
    $trans[chr(152)] = '&tilde;';    // Small Tilde 
    $trans[chr(153)] = '&trade;';    // Trade Mark Sign 
    $trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron 
    $trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark 
    $trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE 
    $trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis 
    $trans['euro'] = '&euro;';    // euro currency symbol 
    ksort($trans); 
     
    foreach ($trans as $k => $v) {
        $text = str_replace($v, $k, $text);
    }
 
    // 3) remove <p>, <br/> ...
    $text = strip_tags($text); 
     
    // 4) &amp; => & &quot; => '
    $text = html_entity_decode($text);
     
    // 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
    $text = preg_replace('/[^(\x20-\x7F)]*/','', $text); 
     
    $targets=array('\r\n','\n','\r','\t');
    $results=array(" "," "," ","");
    $text = str_replace($targets,$results,$text);
 
    //XML compatible
    /*
    $text = str_replace("&", "and", $text);
    $text = str_replace("<", ".", $text);
    $text = str_replace(">", ".", $text);
    $text = str_replace("\\", "-", $text);
    $text = str_replace("/", "-", $text);
    */
     
    return ($text);
}



/**
 * Example input: save_base64_image($base64_string, 'output_file_without_extentnion', 'public/img/users/')
 *
 * @return String /public/img/users/12345.jpg
 * 
 * Note: Input without beginning slash "/"
 */
function save_base64_image($base64_image_string, $output_file_without_extentnion, $path_with_end_slash="" )
{
    $splited = explode(',', substr( $base64_image_string , 5 ) , 2);
    $mime=$splited[0];
    $data=$splited[1];

    $mime_split_without_base64=explode(';', $mime,2);
    $mime_split=explode('/', $mime_split_without_base64[0],2);
    if(count($mime_split)==2)
    {
        $extension=$mime_split[1];
        if($extension=='jpeg')$extension='jpg';
        //if($extension=='javascript')$extension='js';
        //if($extension=='text')$extension='txt';
        $output_file_with_extentnion = $output_file_without_extentnion.'.'.$extension;
    }
    file_put_contents( $path_with_end_slash . $output_file_with_extentnion, base64_decode($data) );
    return '/'.$path_with_end_slash . $output_file_with_extentnion;
}



/**
 * Order Status list
 * 
 * @arg $status = array key of statuses
 * @arg $return_result = if true, return result of given status key. If false, return the status array
*/
function order_status($status, $return_result = true)
{
    
    $statuses = [
        1=> "New Order",
        2=> "Processing",
        3=> "Waiting for Product Payment",
        4=> "Paid for Product",
        5=> "Product purchased, on the way to Airposted",
        6=> "Waiting for delivery charge",
        9=> "Waiting for payment (Product and Shipping)",
        7=> "Delivery in progress",
        8=> "Delivered",
    ];
    
    if($return_result)
    {
        
        return (array_key_exists($status, $statuses)) ? $statuses[$status] : "Unknown Result";
        
    } else{
        
        return $statuses;
        
    }
    
    
}



/**
 * Order Status list
 * 
 * @arg $status = array key of statuses
 * @arg $return_result = if true, return result of given status key. If false, return the status array
*/
function payment_status($status, $return_result = true)
{
    
    $statuses = [
        1=> "Unpaid",
        2=> "Paid (Payment Unverified)",
        3=> "Paid (Payment Verified)",
        4=> "Money given to traveller",
    ];
    
    if($return_result)
    {
        
        return (array_key_exists($status, $statuses)) ? $statuses[$status] : "Unknown Result";
        
    } else{
        
        return $statuses;
        
    }
    
    
}


function lb_to_gm($lb)
{
    
    return $lb * env('LB_TO_GM');
    
}


function gm_to_oz($gm)
{
    
    return round( $gm * env('GM_TO_OZ'), 2);
    
}



function oz_to_gm($oz)
{
    
    return round($oz / env('GM_TO_OZ'), 2);
    
}


function shippingServiceCodes($reference, $return_array = false)
{
    
    $codes = [
        'FCM'       =>	'First Class Mail',
        'PM'        =>	'Priority Mail',
        'EM'        =>	'Priority Mail Express',
        'STDPOST'   =>	'Standard Post',
        'PRCLSEL'   =>	'Parcel Select',
        'MEDIA'     =>	'Media Mail',
        'LIB'       =>	'Library Mail',
        'FCMI'      =>	'First Class International',
        'FCPIS'     =>	'First Class Package International Service',
        'EMI'       =>	'Priority Mail Express International',
        'PMI'       =>	'Priority Mail International',
    ];

    
    if( $return_array ) return $codes;
    
    if( array_key_exists($reference, $codes) ) return $codes[$reference];
    
}


function gateway_charge($base_value)
{
    
    return ( ($base_value * 3.9 / 100) + 0.5) ;
    
}



/**
 * Optimized algorithm from http://www.codexworld.com
 *
 * @param float $latitudeFrom
 * @param float $longitudeFrom
 * @param float $latitudeTo
 * @param float $longitudeTo
 *
 * @return float [km]
 */
function distance( $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo )
{
    
    
    if( !$latitudeFrom || !$longitudeFrom || !$latitudeTo || !$longitudeTo ) return 0;
    
    
    $rad    = M_PI / 180;
    
    $theta  = $longitudeFrom - $longitudeTo;
    
    $dist   = sin($latitudeFrom * $rad) * sin($latitudeTo * $rad) +  cos($latitudeFrom * $rad) * cos($latitudeTo * $rad) * cos($theta * $rad);

    $km     = acos($dist) / $rad * 60 *  1.852;
    
    $mile   = $km * 0.621371;
    
    return  $mile;
    
}


function traveler_fee( $buy , $traveler )
{
    
    if( !$buy->country || !$traveler->country ) return 0;
    
    $l = $buy->p_length;
    
    $d = $buy->p_width;
    
    $h = $buy->p_height;
    
    $w = $buy->p_weight;
    
    $miles = distance( $buy->country->lat, $buy->country->lon, $traveler->country->lat, $traveler->country->lon );
    

    if( !$l || !$d || !$h || !$w || !$miles ) return 0;
    
    
    $density        = ( ( $l * $d * $h / 4.2 ) + ( $w * 45 ) ) / 6;
    
    $distance       = ( $miles / 900 ) * ( $miles / 900 );
    
    $traveler_fee   = round( ( $density + $distance ) / 2.5 );
    
    $traveler_fee   = $traveler_fee > env('MIN_TRAVELER_COMMISSION') ? $traveler_fee : env('MIN_TRAVELER_COMMISSION');
    
    return $traveler_fee;
    
}


