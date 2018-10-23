<?php
namespace App\Http\Controllers;

use App\BuyerNew;
use App\Http\Controllers\Controller;
use App\Repository\TravellerCartRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Repository\CartRepository;

class TravellerCartController extends Controller
{
    private $CartRepository;
 
    public function __construct(TravellerCartRepository $CartRepository ) {
        $this->CartRepository = $CartRepository;
    }

    public function checkout(){
        $data = $this->CartRepository->cart();

        return view('user.pages.product.traveller-checkout')
                ->with('data', $data);
    }

    public function get(Request $request){
        $request = $this->getUser($request);
        $data = $this->CartRepository->get($request);
        return $this->jsonOutput($data);
    }

    public function add(Request $request){
        $request = $this->getUser($request);
        $data = $this->CartRepository->add($request->request->all());
        return Response::json([
            'data' => $data ,
            'status' => $data['status'] ,
            'message' => ($data['status'] == 200) ? 'Product added to cart successfully.' : 'You have already added this product.'
        ]);

    }

    public function delete($id, Request $request){
        $request = $this->getUser($request);
        $data = $this->CartRepository->delete($id, $request->get('user_id'));
        return Response::json([
            'data' => $data ,
            'status' => ($data['isDelete']) ? 200 : 400 ,
            'message' => ($data['isDelete']) ? 'Product removed from cart.' : 'Product can not be removed.'
        ]);
    }

    public function checkoutAddress(){
        $data = $this->CartRepository->cart();

        return view('user.pages.product.traveller-checkout-address')
            ->with('data', $data);
    }

    public function confirmProduct(Request $request) {
        $cartIds = $request->request->get('product_id');
        if($cartIds) {
            $updated = $this->CartRepository->confirmProduct($cartIds);
            if($updated) {
                \Session::put('travellerCartCount', 0);
            }
        }
        $ids = ($cartIds && is_array($cartIds)) ? implode(',', $cartIds) : '';
        return redirect('user/product-confirm?ids='. $ids);
    }

    public function confirmationPage()
    {
        return view('user.pages.product.product-confirmation');
    }


}
