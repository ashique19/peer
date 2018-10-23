<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 
 * Add Mailchimp to Laravel
 * 
 * https://scotch.io/tutorials/ultimate-guide-on-sending-email-in-laravel
 * 
*/

class MailChimps extends Controller
{
    
    // List ID from .env
    private $listId;
    
    // API KEY
    private $apiKey;
    
    // Mailchimp instantiation with Key
    private $mailchimp;
    
    // Mailchimp Campaign
    private $campaign;
    
    public function __construct()
    {
        
        // List ID from .env
        $this->listId = env('MAILCHIMP_LIST_ID');
        
        // API KEY
        $this->apiKey = env('MAILCHIMP_KEY');
        
        // Mailchimp Instanse
        $this->mailchimp = new \Mailchimp( $this->apiKey );
        
    }
    
    /**
     * 
     * TODO List:
     *   
     *  1. Add & Update subscribers to List
     *  2. Create Templates
     *  3. Make templates choosable
     *  4. Create Campaign - done
     *  5. Send Mail to Campaign - done
     * 
    */
    
    public function campaign( $html_content = '', $text_content = '', $campaign_type = 'regular', $listId = null, $subject = 'Marketing Campaign', $from_email = 'marketing@airposted.com', $from_name = 'Marketing Team', $to_name = 'Subscriber' )
    {

        /**
         * 
         * Create a Campaign $mailchimp->campaigns->create( (str) $type, (array) $options, (array) $content)
         * 
        */
        
        $this->campaign = $this->mailchimp->campaigns->create(
            $campaign_type, 
            [
            'list_id'       => $listId ? $listId : $this->listId,
            'subject'       => $subject,
            'from_email'    => $from_email,
            'from_name'     => $from_name,
            'to_name'       => $to_name
            ],
            [
                'html'      => $html_content,
                'text'      => $text_content
            ]
        );


        return $this;
        
    }
    
    
    private function send()
    {
        
        // Send campaign
        $this->mailchimp->campaigns->send($this->campaign['id']);

        return response()->json(['status' => 'Success']);
        
    }
    
}
