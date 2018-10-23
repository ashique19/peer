<?php

namespace App\Http\Controllers;

use App\BuyerNew;
use App\Models\Payout;
use App\Repository\TravellerCartRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfiles extends Controller
{
    public function index()
    {
        return view('user.pages.product.dashboard');
    }

    public function profile()
    {
        
        // return auth()->user();
        $userData = User::with('country')->where('id', '=', Auth::id())->get();
//        dump($userData[0]);die;
        return view('user.pages.product.settings', ['user' => $userData[0]]);
    }

    public function travels()
    {
        $myRoute = auth()->user()->tripPosts()->with(['airportFrom','countryFrom', 'airportTo', 'countryTo'])->active()->valid()->latest()->paginate(20);
//dump($myRoute[0]);die;
        return view('user.pages.product.mytravels', ['travel' => $myRoute, 'tab' => 'active']);
    }

    public function upcomingTravels()
    {
        $myRoute = auth()->user()->tripPosts()->with(['airportFrom','countryFrom', 'airportTo', 'countryTo'])->upcoming()->valid()->latest()->paginate(20);
        return view('user.pages.product.mytravels', ['travel' => $myRoute, 'tab' => 'active']);
    }

    public function payout(TravellerCartRepository $travellerCartRepository)
    {
        $buyerData = BuyerNew::where('user_id', Auth::user()->id)->select(DB::raw('SUM(price) as total_purchased'))->get();
        $purchasedAmount = ($buyerData) ? $buyerData[0]->total_purchased : 0;

        $travellerCartInfo = $travellerCartRepository->cart();
        $travellerAvailableAmount = $travellerCartRepository->availableAmount();
        // Total : 100, P  : 80, Traveller will get 95 and 5 % will get the Peerposted
        $pendingPrice = round($travellerCartInfo['total_price'] * 0.95, 2);
        $availableAmount = round($travellerAvailableAmount['total_price'] * 0.95, 2);

        return view('user.pages.product.payout', [
            'purchasedAmount' => $purchasedAmount,
            'pending_price' => $pendingPrice,
            'available_amount' => $availableAmount
        ]);
    }

    public function withdraw(TravellerCartRepository $travellerCartRepository)
    {

        $travellerAvailableAmount = $travellerCartRepository->availableAmount();
        // Total : 100, P  : 80, Traveller will get 95 and 5 % will get the Peerposted
        $pendingPrice = round($travellerAvailableAmount['total_price'] * 0.95, 2) - Payout::where('user_id', auth()->user()->id)->where('payout_status','complete')->sum('amount');
        return view('user.pages.product.withdraw', ['pending_price' => $pendingPrice]);
    }

    public function postWithdraw(Request $request, TravellerCartRepository $travellerCartRepository)
    {
        // return $request->all();
        $travellerAvailableAmount = $travellerCartRepository->availableAmount() - Payout::where('user_id', auth()->user()->id)->where('payout_status','complete')->sum('amount') ;
        // Total : 100, P  : 80, Traveller will get 95 and 5 % will get the Peerposted
        $pendingPrice = round($travellerAvailableAmount['total_price'] * 0.95, 2);

        if( $pendingPrice < $request->request->get('amount')) {
            return back()->withErrors('Insufficient Fund.');
        }
        $data = [
            'user_id' => Auth::user()->id,
            'amount' => $request->request->get('amount'),
            'type' => $request->request->get('type'),
            'bank_name' => $request->input('bank_name'), 
            'branch_name' => $request->input('bank_branch'), 
            'swift_code' => $request->input('swift_code'), 
            'account_name' => $request->input('account_name'), 
            'account_number' => $request->input('account_number'),

        ];
        
        // TravellerCartRepository::
        
        $isAdded = Payout::create($data);

        return ($isAdded) ? back()->withErrors('Payout request added successfully')
            : back()->withErrors('Couldn\'t added Payout request.');
    }
}
