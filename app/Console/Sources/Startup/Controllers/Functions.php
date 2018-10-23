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


function xs_link($name)
{
    
    return ($name) ? str_replace('_lg.', '_xs.', $name) : "";
    
}

function sm_link($name)
{
    
    return ($name) ? str_replace('_lg.', '_sm.', $name) : "";
    
}

function md_link($name)
{
    
    return ($name) ? str_replace('_lg.', '_md.', $name) : "";
    
}

function lg_link($name)
{
    
    return ($name) ? str_replace('_lg.', '_lg.', $name) : "";
    
}


function xs($name, $class = "", $alt="Image")
{
    
    return "<img src=\"".str_replace('_lg.', '_xs.', $name)."\" class=\"img-responsive $class\" alt=\"$alt\" />";
    
}

function sm($name, $class = "", $alt="Image")
{
    
    return "<img src=\"".str_replace('_lg.', '_sm.', $name)."\" class=\"img-responsive $class\" alt=\"$alt\" />";
    
}

function md($name, $class = "", $alt="Image")
{
    
    return "<img src=\"".str_replace('_lg.', '_md.', $name)."\" class=\"img-responsive $class\" alt=\"$alt\" />";
    
}

function lg($name, $class = "", $alt="Image")
{
    
    return "<img src=\"".str_replace('_lg.', '_lg.', $name)."\" class=\"img-responsive $class\" alt=\"$alt\" />";
    
}

function thumb($name, $class = "", $alt="Image")
{
    
    return "<img src=\"".str_replace('_lg.', '_sm.', $name)."\" class=\"img-thumbnail $class\" alt=\"$alt\" />";
    
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
 
/**
 * 
 * @param instant of error
 * 
 * @return HTML with errors
 * 
*/
function errors($errors)
{
    
    $error_display = "";
    
    if($errors->any())
    {
        
        $error_display .= '<section class="col-sm-10 col-sm-offset-1">
            <h4>Please check:</h4>
            
            <ul>';
                foreach($errors->all() as $error)
                {
                    
                    $error_display .= '<li class="alert alert-warning">'.$error.'</li>';
                    
                }
                
            $error_display .='
            </ul>
            <hr>
        </section>';
        
    }
    
    return $error_display;
    
}


/**
*
*   @argument $number = 123
*   @returns "One Hundred and Twenty Three"
*
*/
function convertToString($number, $blankIfZero=true)
{
    $strRep = "";
    $n = intval($number);       
    $one2twenty = array("One", "Two", "Three", "Four", 
            "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven",
            "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen",
            "Seventeen", "Eighteen", "Nineteen");
    $twenty2ninty = array("Twenty", "Thirty",
            "Fourty", "Fifty", "Sixty", "Seventy", "Eighty",
            "Ninety");
    $hundred = "Hundred";
    $thousand = "Thousand";
    $million = "Million";
    $billion = "Billion";

    switch($n){
        case 0: 
            if($blankIfZero == true){
                $strRep= $strRep."";
                break;
            }else{
                $strRep = $strRep."Zero";
                break;
            }
        case $n >0 && $n <20:
            $strRep = $strRep." ".$one2twenty[($n-1)];              
            break;
        case $n >=20 && $n < 100:               
            $strRep = $strRep . " ". $twenty2ninty[(($n/10) - 2)];
            $strRep .= $this->convertToString($n%10);
            break;
        case $n >= 100 && $n <= 999:
            $strRep = $strRep.$one2twenty[(($n/100)-1)]." ".$hundred. " ";
            $strRep .= $this->convertToString($n%100);
            break;
        case $n >= 1000 && $n < 100000:
            if($n < 20000){
                $strRep = $strRep.$one2twenty[(($n/1000)-1)]." ".$thousand. " ";
                $strRep .= $this->convertToString($n%1000);
                break;
            }else{
                $strRep = $strRep . $twenty2ninty[(($n/10000) - 2)];
                $strRep .= $this->convertToString($n%10000);
                break;
            }
        case $n >= 100000 && $n < 1000000:
            $strRep .= $this->convertToString($n/1000). " ".$thousand. " ";
            $strRep .= $this->convertToString(($n%100000)%1000);
            break;
        case $n >= 1000000 && $n <  10000000:                   
            $strRep = $strRep . $one2twenty[(($n/1000000) - 1)]. " ".$million." ";
            $strRep .= $this->convertToString($n%1000000);
                break;
        case $n >= 10000000 && $n < 10000000000:
            $strRep .= $this->convertToString($n/1000000). " ".$million. " ";
            $strRep .= $this->convertToString(($n%1000000));
            break;

    }

    return $strRep;
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


function settings()
{
    
    return \Cache::remember('settings', env('CACHE_DURATION') , function(){
        
        return \App\Setting::find(1);
        
    });
    
}