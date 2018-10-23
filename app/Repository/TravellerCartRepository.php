<?php
namespace App\Repository;

use App\BuyerNew;
use App\Models\TravellerCart;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

class TravellerCartRepository
{    

    public function get($params = null) {
        $cart = TravellerCart::select('traveller_carts.id', 'traveller_carts.user_id');
        if($params->user_id){
            $cart = $cart->where('user_id', $params->user_id);
        }

        return $cart->get();

    }


    public function cart(){
        $data['total_price'] = 0; 
        $data['items'] = TravellerCart::select('traveller_carts.*')->with('products')
            ->with('user')
            ->Join('buyers_new AS b', 'b.id', '=', 'traveller_carts.product_id')
            ->where('traveller_carts.user_id', Auth::id())
            ->where('b.status', BuyerNew::$ACTIVE_STATUS) // Confirmed from Admin panel
            ->get();
        foreach ($data['items'] as $item) {
            $data['total_price'] += $item->products->price;
        }
        return $data;
    }

    public function availableAmount() {
        $data['total_price'] = 0;
        $data['items'] = TravellerCart::select('traveller_carts.*')->with('products')
            ->with('user')
            ->Join('buyers_new AS b', 'b.id', '=', 'traveller_carts.product_id')
            ->where('traveller_carts.user_id', Auth::id())
            ->where('b.status', BuyerNew::$RECEIVED_STATUS) // Confirmed from Admin panel
            ->get();
        foreach ($data['items'] as $item) {
            $data['total_price'] += $item->products->price;
        }
        return $data;
    }

    public function travellerCartCount(){
        return TravellerCart::where('user_id', Auth::id())->count();
    }

    public function add($param) {
        $cart = TravellerCart::firstOrNew([
                'product_id' => $param['id'],
                'user_id' => $param['user_id']
        ]);
        if (!$cart->exists) {
            $cart->save();
            $data['id'] = $cart->id;
            $data['quantity'] = $cart->where('user_id', $param['user_id'])->count();
            $data['status'] = 200;
            \Session::put('travellerCartCount', $data['quantity']);
            return $data;
        }
        $data['status'] = 204;
        return $data;
    }
    
    public function delete($id, $userId){
        $data['isDelete'] = TravellerCart::where('id', $id)->delete();
        $data['quantity'] = TravellerCart::where('user_id', $userId)->count();
        \Session::put('travellerCartCount', $data['quantity']);
        return $data;
    }

    public function confirmProduct($cartIds)
    {
        $updated = BuyerNew::whereIn('id', $cartIds)
            ->update(['status' => BuyerNew::$CONFIRMED_STATUS]);
        return $updated;
    }
}
