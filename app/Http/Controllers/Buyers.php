<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\buyersStoreRequest;
use App\Http\Requests\myBuyInfoStoreRequest;
use App\Http\Controllers\Controller;
use App\Buyer;
use App\Http\Requests\buyersNewStoreRequest;
use App\BuyerNew;

class Buyers extends Controller
{
    
    use \App\Http\Traits\Images;
    
    private $app;
    
    public function __construct()
    {
        
        $this->app = \App\Setting::first();
        
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.buyers.index', ['buyers'=> Buyer::latest()->paginate(20)]);
        
    }

    public function newIndex()
    {

        $requestedProducts = BuyerNew::where('status', BuyerNew::$ACTIVE_STATUS)->latest()->paginate(20);
        return view('admin.buyers.new', ['buyers'=> $requestedProducts]);

    }

    public function updateStatus($id, Request $request)
    {

        $save_success = BuyerNew::find($id)->update(['status' => 1 ]);

        if($save_success) {
            return back()->withErrors('Data has been updated successfully.');

        } else {
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
        }

    }
    
    /**
     * Searches the listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchIndex(Request $request)
    {
    
        $search = array_filter($request->all());
        unset($search['_token']);
        
        $result =   new Buyer;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('amazon_url'))   ? $result = $result->where('amazon_url', 'like', '%'.$request->input('amazon_url').'%') : false;
					($request->input('other_url'))   ? $result = $result->where('other_url', 'like', '%'.$request->input('other_url').'%') : false;
					($request->input('price'))   ? $result = $result->where('price', 'like', '%'.$request->input('price').'%') : false;
					($request->input('country_id'))   ? $result = $result->where('country_id', $request->input('country_id')) : false;
					($request->input('user_id'))   ? $result = $result->where('user_id', $request->input('user_id')) : false;
					($request->input('category_id'))   ? $result = $result->where('category_id', $request->input('category_id')) : false;
        
        return view('admin.buyers.index', ['buyers'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.buyers.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(buyersStoreRequest $request)
    {
        
        
        
        $save_success = Buyer::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Buyers@index')->withErrors('Data has been stored successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
    
    }
    
    public function storeNew(buyersNewStoreRequest $request)
    {
        $save_success = BuyerNew::create($request->all());
        if($request->is('api/*')) {
            if($save_success){
                return JsonResponse::create(['data' => $save_success, 'status' => 200, 'message' => 'Product added'], 200);
            } else{
                return JsonResponse::create(['data' => $save_success, 'status' => 400, 'message' => 'Bad request'], 200);
            }
        } else {
            // For web
            if($save_success){
                return redirect()->action('Payments@add1')->withErrors('Data has been stored successfully.Now complete the payment.');
            } else{
                return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            }
        }

    
    }
    
    public function search(\App\Travel $travels, \App\BuyerNew $buyer)
    {
        $buyers = [];
        $myTravels = $travels->with('countryFrom')->with('countryTo')->where('user_id', auth()->user()->id)->valid()->latest()->get();
        if(count($myTravels) >= 1) {
            $buyers = $buyer->where('to_country_id', $myTravels[0]->country_to)
                ->where('status', BuyerNew::$ACTIVE_STATUS) // Only not received
                ->get();
        }
        
        return view('user.pages.product.buyers-search', compact('myTravels', 'buyers'));
        
    }
    
    public function searchByTravel($id, \App\BuyerNew $buyer, \App\Travel $travels)
    {
        $buyers = [];
        $travel = $travels->where('id', $id)->get()->first();
        
        if($travel) {
            $buyers = $buyer->where('to_country_id', $travel->country_to)
                ->where('status', 0) // Only not received
                ->get();
        }
        if(count($buyers)) {
            $data = ['data' => $buyers, 'status' => 200];
        } else {
            $data = ['data' => [], 'status' => 204];
        }
        
        return response()->json($data);
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $buyer = Buyer::find($id); 
        
        return view('admin.buyers.show', compact('buyer') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $buyer = Buyer::find($id); 
        
        return view('admin.buyers.edit', compact('buyer') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(buyersStoreRequest $request, $id)
    {
        $buyer = Buyer::find($id);
        
        if( starts_with( $request->input('image_url'), 'data:image') )
        {
            
            $ext = explode(';base64', $request->input('image_url') )[0];
            
            $ext = explode('/',$ext)[1];
            
            $imageName = rand(1000000, 2000000).auth()->user()->id .'_lg.'. $ext ;
            
            $imagePath = public_path().'/img/product-image/'.$imageName;
            
            file_put_contents( $imagePath, base64_decode($request->input('image_url')));
            
            $ifp = fopen($imagePath, "wb"); 
            $data = explode(',', $request->input('image_url'));
            fwrite($ifp, base64_decode($data[1])); 
            fclose($ifp);
            
            $request['image_url'] = trim('/public/img/product-image/'.$imageName);
            
        }
        
        $save_success = Buyer::find($id)->update($request->all());
        
        if($save_success)
        {
            return back()->withErrors('Data has been updated successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $buyer = Buyer::find($id);
        
        if($buyer)
        {
    
    
            if($buyer->delete())
            {
            
                return back()->withErrors('Post has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    public function myBuys(Buyer $buyers)
    {
        
        if(auth()->user())
        {
            
            $myBuys = $buyers->where('user_id', auth()->user()->id)->latest()->paginate(20);
            
            $app    = \App\Setting::first();
            
            return view('user.pages.my-buy-info', compact('myBuys', 'app') );
            
        } else {
            
            return redirect()->route('login')->withErrors('Please login to continue');
            
        }
        
    }
    
    
    public function storeMyBuys(myBuyInfoStoreRequest $request, Buyer $buyers, \App\Http\Controllers\Mails $mail)
    {
        
        if( starts_with( $request->input('image_url'), 'data:image') )
        {
            
            $ext = explode(';base64', $request->input('image_url') )[0];
            
            $ext = explode('/',$ext)[1];
            
            $imageName = rand(1000000, 2000000).auth()->user()->id .'_lg.'. $ext ;
            
            $imagePath = public_path().'/img/product-image/'.$imageName;
            
            file_put_contents( $imagePath, base64_decode($request->input('image_url')));
            
            $ifp = fopen($imagePath, "wb"); 
            $data = explode(',', $request->input('image_url'));
            fwrite($ifp, base64_decode($data[1])); 
            fclose($ifp);
            
            $request['image_url'] = trim('/public/img/product-image/'.$imageName);
            
        }
        
        if(strlen($request->input('amazon_url')) == 0 && strlen($request->input('other_url')) == 0)
        {
            
            return back()->withInput()->withErrors('Please provide product url at amazon or elsewhere.');
            
        }
        
        if($request->hasFile('picture'))
        {
            if($request->file('picture')->isValid())
            {
                
                
                /**
                 * SimpleImage can't make dir. It returns error if directory does not exist.
                 * Make directory (if it dows not exists) before putting file in it
                 */
                $location   = public_path().'/img/product-image/';
                if(!is_dir($location))
                {
                    
                    mkdir($location, 0777, true);
                                    
                }
                
                
                /**
                *
                * Prepare names for file at different sizes
                * 
                */
                $image_lg  = date('Ymdhis').'_lg.'.$request->file('picture')->getClientOriginalExtension();
                $image_md  = date('Ymdhis').'_md.'.$request->file('picture')->getClientOriginalExtension();
                $image_sm  = date('Ymdhis').'_sm.'.$request->file('picture')->getClientOriginalExtension();
                $image_xs  = date('Ymdhis').'_xs.'.$request->file('picture')->getClientOriginalExtension();
                
                // Instantiate SimpleImage class
                $image = new \App\Http\Controllers\SimpleImage($request->file('picture'));
                
                
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
                
                $request['image_url'] = '/public/img/product-image/'.$image_lg;
                
            }
                        
        }
        
        $request['user_id'] = auth()->user()->id;
        
        if( $request->has('phone_no') && $request->has('country_code') )
        {
            
            \App\User::find( auth()->user()->id )->update( ['contact'=> $request->input('country_code') . $request->input('phone_no')] );
            
        }
        
        $request['city_id'] = (is_int($request->input('city_id'))) ? $request->input('city_id') : null;
        
        $dataSaved = $buyers->create($request->all());
        
        if($dataSaved)
        {
            
            // $mail->buyWishPosted();
            
            return redirect()->action('Travels@travellerSearchByBuyer')->withErrors('Your buy info has been published successfully.');
            
        } else{
            
            return back()->withErrors('Failed to store data. Please retry later.');
            
        }
                
    }
    
    
    public function removeMyPost(Request $request, $id, Buyer $buyers)
    {
        
        $buyer = $buyers->where('id', $id)->where('user_id', auth()->user()->id)->first();
        
        if($buyer->image_url)
            {
                $image_to_delete_lg = $buyer->image_url;
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
        
        if($buyer->delete())
        {
            
            return back()->withErrors('Post info deleted successfully.');
            
        } else{
            
            return back()->withErrors('Failed to delete the post. Please retry later.');
            
        }
        
    }
    
    
    public function buyerSearchByTraveller()
    {
        
        if( !auth()->user()->country_id ) return redirect()->action('UserAccounts@modify')->withErrors('Please fill in your basic profile first, so that we can guide you to carrying requests.');
        
        $buyers     = \App\Buyer::latest()->paginate(20);
        
        $categories = \App\Category::all();
        
        $countries  = \App\Country::all();
        
        $app        = $this->app;
        
        return view('user.pages.search-for-buyer', compact('buyers', 'categories', 'countries', 'app') );
        
    }
    
    
    public function postBuyerSearchByTraveller(Request $request, Buyer $buyers)
    {
        
        if( !auth()->user()->country_id ) return redirect()->action('UserAccounts@modify')->withErrors('Please fill in your basic profile first, so that we can guide you to carrying requests.');

        $categories = (array_key_exists('categories', $request->all()) && count(array_filter($request->input('categories')))) ? \App\Category::whereIn('name', $request->input('categories'))->lists('id') : null;
        
        ($categories)                                       ? $buyers = $buyers->whereIn('category_id', $categories) : false;
        (array_key_exists('keyword', $request->all()))      ? $buyers = $buyers->where('name', 'like', '%'.$request->input('keyword').'%') : false;
        ($request->input('country') * 1)                    ? $buyers = $buyers->where('country_id', $request->input('country')) : false;
        
        $buyers     = $buyers->latest()->paginate(20);
        
        $categories = \App\Category::all();
        
        $countries  = \App\Country::all();
        
        $app        = $this->app;
        
        return view('user.pages.search-for-buyer', compact('buyers', 'categories', 'countries', 'app') );
        
    }
    
    
    public function details($id)
    {
        
        $buyer      = \App\User::find($id);
        
        $buys       = ( $buyer ) ? $buyer->buys : [];
        
        return view('user.pages.buyer-details', compact( 'buyer', 'buys' ) );
        
    }
    
    /**
     * 
     * If a Buyer adds a product to list, we store that as a buy post of that buyer
     * 
     * @check - If the user is logged in, if the user type is 'buyer'
     * 
     * @return - no return
     * 
    */
    public function addToMyBuy(Request $request)
    {
        
        if(auth()->user())
        {
            
            if(auth()->user()->role == 3 && session('user_type') == 'buyer')
            {
                
                $data = [
                    'name'          => $request->input('name'),
                    'amazon_url'    => $request->input('link'),
                    'image_url'     => $request->input('image'),
                    'price'         => $request->input('price'),
                    'country_id'    => auth()->user()->country_id,
                    'user_id'       => auth()->user()->id,
                    'category_id'   => 1,
                ];
                
                $buyer = \App\Buyer::create($data);
                
                // return $buyer;
            }
            
        }
        
    }
    
    
    public function oldBuyPosts()
    {
        
        $myBuys = \App\Buyer::where('user_id', auth()->user()->id)->latest()->paginate(20);
        
        $app    = \App\Setting::first();
        
        return view('user.pages.buy-history', compact('myBuys', 'app') );
        
    }
    
    
}

