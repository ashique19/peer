<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Response;

class CartRepository
{    

    public function get($params = null) {
        $cart = Cart::select('carts.id', 'carts.user_id', 'carts.title', 'carts.price', 'carts.category', 'carts.url', 'carts.image', 'carts.quantity', 'carts.created_at');
        if($params->user_id){
            $cart = $cart->where('user_id', $params->user_id);
        }

        return $cart->get();

    }

    public function cartData($userId) {
        \Session('key', 'value'); 
        
        
        $cart = Cart::select('carts.product_id', 'p.name', 'p.description', 'p.price', 'p.tax', 'c.thumb', 'u.name as owner_name', 'cat.name as cat_name');
        $cart = $cart->where('carts.user_id', $userId);
        $cart = $cart
                    ->Join('products AS p', 'p.id', '=', 'carts.product_id')
                    ->Join('caddies AS c', 'c.id', '=', 'p.caddy_id')
                    ->Join('users AS u', 'u.id', '=', 'c.user_id')
                    ->Join('categories AS cat', 'cat.id', '=', 'p.category_id');
        return $cart->get();

    }

    public function cart(){
        
        $data = ['total_price' => 0, 'total_tax' => 0 ]; 
        
        $data['items'] = Cart::select('carts.*')
            ->whereRaw('carts.price <> ""')
            ->where('carts.user_id', Auth::id())
            ->get();
        
        foreach ($data['items'] as $item) {
            $price = ($item->price) ? (int)$item->price : 0;
            $tax = ($item->tax) ? (int)$item->tax :0;
            $data['total_price'] += $price;
            $data['total_tax'] += $tax;
        }
        // return [];
        return $data;
    }

    public function cartCount() {
        return Cart::where('user_id', Auth::id())->count();
    }

    public function add($param) {
        $cart = Cart::firstOrNew([
                'product_id' => isset($param['id']) ? $param['id'] : '',
                'title' => isset($param['title']) ? $param['title'] : '',
                'price' => isset($param['price']) ? $param['price'] : '',
                'image' => isset($param['image']) ? $param['image'] : '',
                'url' => isset($param['url']) ? $param['url'] : '',
                'custom_link_note' => isset($param['custom_link_note']) ? $param['custom_link_note'] : '',
                'quantity' => isset($param['quantity']) ? $param['quantity'] : '',
                'user_id' => $param['user_id']
        ]);
        
        // dump($cart);
        
        if (!$cart->exists) {
            $cart->save();
            $data['id'] = $cart->id;
            $data['quantity'] = $cart->where('user_id', $param['user_id'])->count();
            $data['status'] = 200;
            \Session::put('cartCount', $data['quantity']);
            return $data;
        }
        
        $data['status'] = 204;
        return $data;
    }
    
    public function delete($id){
        $data['isDelete'] = Cart::find($id)->delete();
        $cartCount = \Session::get('cartCount');
        $data['quantity'] = ($cartCount == 0) ? 0 : --$cartCount;
        \Session::put('cartCount', $data['quantity']);
        return $data;
    }

    public function deleteByUser($userId) {
        Cart::where('user_id', $userId)->delete();
        \Session::put('cartCount', 0);
    }

    public function update($id, $param)
    {
        return DB::table('carts')
                    ->where('id', $id)
                    ->update(
                        [
                            'product_id' => isset($param['id']) ? $param['id'] : '',
                            'title' => isset($param['title']) ? $param['title'] : '',
                            'price' => isset($param['price']) ? $param['price'] : '',
                            'image' => isset($param['image']) ? $param['image'] : '',
                            'url' => isset($param['url']) ? $param['url'] : '',
                            'quantity' => isset($param['quantity']) ? $param['quantity'] : ''
                        ]
                    );
    }

    public function incompleteCartData() {
        $cart = Cart::select('carts.id', 'carts.url', 'carts.custom_link_note', 'u.name as owner_name', 'carts.created_at')
            ->Join('users AS u', 'u.id', '=', 'carts.user_id')
            ->whereRaw('price = ""')
            ->whereNotNull('url');
        return $cart->get();

    }
}
