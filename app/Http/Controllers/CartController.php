<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Repository\CartRepository;

class CartController extends Controller
{
    private $CartRepository;
 
    public function __construct(CartRepository $CartRepository ) {
        $this->CartRepository = $CartRepository;
    }

    public function checkout(){
        $data = $this->CartRepository->cart(); 
        
        return view('user.pages.product.checkout')
                ->with('data', $data);
    }
    
    public function checkoutAddress(){
        $data = $this->CartRepository->cart(); 
        
        return view('user.pages.product.checkout-address')
                ->with('data', $data);
    }

    public function get(Request $request) {
        $request = $this->getUser($request);
        $data = $this->CartRepository->get($request);
        return $data;
    }

    public function add(Request $request) {
        
        // return $request->request->all();
        
        $request = $this->getUser($request);
        $data = $this->CartRepository->add( $request->request->all() );
        return Response::json([
            'data' => $data ,
            'status' => $data['status'] ,
            'message' => ($data['status'] == 200) ? 'Product added to cart successfully.' : 'You have already added this product.'
        ]);

    }

    public function delete($id, Request $request) {
        $request = $this->getUser($request);
        $data = $this->CartRepository->delete($id, $request->get('user_id'));
        return Response::json([
            'data' => $data ,
            'status' => ($data['isDelete']) ? 200 : 400 ,
            'message' => ($data['isDelete']) ? 'Product removed from cart.' : 'Product can not be removed.'
        ]);
    }

    public function update($id, Request $request) {
        $data = $this->CartRepository->update($id, $request->request->all());
        return Response::json([
            'data' => $data ,
            'status' => $data['status'] ,
            'message' => ($data['status'] == 200) ? 'Cart updated successfully.' : ''
        ]);

    }
}
