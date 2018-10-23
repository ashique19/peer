<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon;

class Graphs extends Controller
{
    
    public function userSignupLastWeek(\App\User $users)
    {
        
        $data = [];
        
        for($i = 0; $i > -7; $i--)
        {
            
            $data[$i*-1]['y'] = Carbon::now()->addDays($i)->format('M d');
            
            $data[$i*-1]['a'] = $users->whereBetween('created_at', [Carbon::now()->addDays($i)->format('Y-m-d').' 00:00:00' , Carbon::now()->addDays($i)->format('Y-m-d').' 23:59:59'] )->count();
            
        }
        
        $data = array_reverse($data);
        
        return $data;
        
    }
    
    public function userSignupLastMonth(\App\User $users)
    {
        
        $data = [];
        
        for($i = 0; $i > -30; $i--)
        {
            
            $data[$i*-1]['y'] = Carbon::now()->addDays($i)->format('M d');
            
            $data[$i*-1]['a'] = $users->whereBetween('created_at', [Carbon::now()->addDays($i)->format('Y-m-d').' 00:00:00' , Carbon::now()->addDays($i)->format('Y-m-d').' 23:59:59'] )->count();
            
        }
        
        $data = array_reverse($data);
        
        return $data;
        
    }
    
    public function userSignupLastYear(\App\User $users)
    {
        
        $data = [];
        
        for($i = 0; $i > -12; $i--)
        {
            
            $data[$i*-1]['y'] = Carbon::now()->addMonths($i)->format('M');
            
            $data[$i*-1]['a'] = $users->whereBetween('created_at', [Carbon::now()->addMonths($i)->format('Y-m-01').' 00:00:00' , Carbon::now()->addMonths($i+1)->format('Y-m-01').' 00:00:00'] )->count();
            
        }
        
        $data = array_reverse($data);
        
        return $data;
        
    }
    
    public function buypostLastYear(\App\Buyer $buy)
    {
        
        $data = [];
        
        for($i = 0; $i > -12; $i--)
        {
            
            $data[$i*-1]['y'] = Carbon::now()->addMonths($i)->format('M');
            
            $data[$i*-1]['a'] = $buy->whereBetween('created_at', [Carbon::now()->addMonths($i)->format('Y-m-01').' 00:00:00' , Carbon::now()->addMonths($i+1)->format('Y-m-01').' 00:00:00'] )->count();
            
        }
        
        $data = array_reverse($data);
        
        return $data;
        
    }
    
    public function travelpostLastYear(\App\Travel $travel)
    {
        
        $data = [];
        
        for($i = 0; $i > -12; $i--)
        {
            
            $data[$i*-1]['y'] = Carbon::now()->addMonths($i)->format('M');
            
            $data[$i*-1]['a'] = $travel->whereBetween('created_at', [Carbon::now()->addMonths($i)->format('Y-m-01').' 00:00:00' , Carbon::now()->addMonths($i+1)->format('Y-m-01').' 00:00:00'] )->count();
            
        }
        
        $data = array_reverse($data);
        
        return $data;
        
    }
    
    public function offersLastWeek(\App\Offer $offers)
    {
        
        $data = [];
        
        for($i = 0; $i > -7; $i--)
        {
            
            $data[ $i * -1 ]['y'] = Carbon::now()->addDays($i)->format('Y-m-d');
            
            $data[ $i * -1 ]['a'] = $offers->notReply()->whereBetween('created_at', [Carbon::now()->addDays($i)->format('Y-m-d').' 00:00:00' , Carbon::now()->addDays($i)->format('Y-m-d').' 23:59:59'] )->count();
            
        }
        
        return $data;
        
    }
    
    public function offersLastMonth(\App\Offer $offers)
    {
        
        $data = [];
        
        for($i = 0; $i > -30; $i--)
        {
            
            $data[ $i * -1 ]['y'] = Carbon::now()->addDays($i)->format('Y-m-d');
            
            $data[ $i * -1 ]['a'] = $offers->notReply()->whereBetween('created_at', [Carbon::now()->addDays($i)->format('Y-m-d').' 00:00:00' , Carbon::now()->addDays($i)->format('Y-m-d').' 23:59:59'] )->count();
            
        }
        
        return $data;
        
    }
    
    public function chatLastMonth(\App\Chat $chats)
    {
        
        $data = [];
        
        for($i = 0; $i > -30; $i--)
        {
            
            $data[ $i * -1 ]['y'] = Carbon::now()->addDays($i)->format('Y-m-d');
            
            $data[ $i * -1 ]['a'] = $chats->whereBetween('created_at', [Carbon::now()->addDays($i)->format('Y-m-d').' 00:00:00' , Carbon::now()->addDays($i)->format('Y-m-d').' 23:59:59'] )->count();
            
        }
        
        return $data;
        
    }
    
    public function userByCountry(\App\User $users)
    {
        
        $data        = ['countries'=> [], 'colors'=> [], 'data'=> [] ];
        
        $countries = $users->where('created_at', '<', Carbon::now()->format('Y-m-d').' 00:00:00')
                            ->where('created_at', '>', Carbon::now()->addDays( -30 )->format('Y-m-d').' 23:59:59')
                            ->whereNotNull('country_id')
                            ->groupBy('country_id')
                            ->lists('country_id');
        
        if( count($countries) > 0 )
        {
            
            $countryData = [];
            
            $data['countries'] = \App\Country::whereIn('id', $countries)->lists('name');
            
            for($i = -30; $i < 0; $i++)
            {
                
                $y = [ 'y' => \Carbon::now()->addDays($i)->format('Y-m-d') ];
                
                foreach( $countries as $c )
                {
                    
                    $y[\App\Country::find($c)->name] = $users->where('country_id', $c)
                                                             ->where('created_at', '>', Carbon::now()->addDays( $i )->format('Y-m-d').' 00:00:00')
                                                             ->where('created_at', '<', Carbon::now()->addDays( $i )->format('Y-m-d').' 23:59:59')
                                                             ->count();
                    
                }
                
                $data['data'][] = $y;
                
            }
            
            foreach($countries as $c)
            {
                
                $data['colors'][] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                
            }
            
        }
        
        return $data;        
        
    }
    
    public function travelByCountry(\App\Travel $travel)
    {
        
        $data        = ['countries'=> [], 'colors'=> [], 'data'=> [] ];
        
        $countries = $travel->where('travel_date', '<', Carbon::now()->format('Y-m-d').' 00:00:00')
                            ->where('travel_date', '>', Carbon::now()->addDays( -30 )->format('Y-m-d').' 23:59:59')
                            ->whereNotNull('travel_date')
                            ->groupBy('country_from')
                            ->lists('country_from');
        
        if( count($countries) > 0 )
        {
            
            $countryData = [];
            
            $data['countries'] = \App\Country::whereIn('id', $countries)->lists('name');
            
            for($i = -30; $i < 0; $i++)
            {
                
                $y = [ 'y' => \Carbon::now()->addDays($i)->format('Y-m-d') ];
                
                foreach( $countries as $c )
                {
                    
                    $y[\App\Country::find($c)->name] = $travel->where('country_from', $c)
                                                              ->where('created_at', '>', Carbon::now()->addDays( $i )->format('Y-m-d').' 00:00:00')
                                                             ->where('created_at', '<', Carbon::now()->addDays( $i )->format('Y-m-d').' 23:59:59')
                                                              ->count();
                    
                }
                
                $data['data'][] = $y;
                
            }
            
            foreach($countries as $c)
            {
                
                $data['colors'][] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                
            }
            
        }
        
        return $data;        
        
    }
    
    public function buyByCountry(\App\Buyer $buys)
    {
        
        $data        = ['countries'=> [], 'colors'=> [], 'data'=> [] ];
        
        $countries = $buys->where('created_at', '<', Carbon::now()->format('Y-m-d').' 00:00:00')
                            ->where('created_at', '>', Carbon::now()->addDays( -30 )->format('Y-m-d').' 23:59:59')
                            ->whereNotNull('country_id')
                            ->groupBy('country_id')
                            ->lists('country_id');
        
        if( count($countries) > 0 )
        {
            
            $countryData = [];
            
            $data['countries'] = \App\Country::whereIn('id', $countries)->lists('name');
            
            for($i = -30; $i < 0; $i++)
            {
                
                $y = [ 'y' => \Carbon::now()->addDays($i)->format('Y-m-d') ];
                
                foreach( $countries as $c )
                {
                    
                    $y[\App\Country::find($c)->name] = $buys->where('country_id', $c)
                                                             ->where('created_at', '>', Carbon::now()->addDays( $i )->format('Y-m-d').' 00:00:00')
                                                             ->where('created_at', '<', Carbon::now()->addDays( $i )->format('Y-m-d').' 23:59:59')
                                                             ->count();
                    
                }
                
                $data['data'][] = $y;
                
            }
            
            foreach($countries as $c)
            {
                
                $data['colors'][] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                
            }
            
        }
        
        return $data;        
        
    }
    
}
