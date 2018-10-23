<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EbayController extends Controller
{

    public $usdToBdtAmount = 80;
    /**
     * 
     * 
     * @return string url
     * 
    */
    private function prepare($params)
    {   
     
        // $public_key     = env('EBAY_APP');
        // $private_key    = env('AWS_SECRET_ACCESS_KEY');
        // $region         = env('AWS_REGION');

        $q = ($params->request->has('q')) ? $params->request->get('q') : 'mobile';
        $limit = ($params->request->has('limit')) ? $params->request->get('limit') : 12;
        $page = ($params->request->has('page')) ? $params->request->get('page') : 1;
        // create request
//        $request = 'http://svcs.sandbox.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=Emranulh-airposte-SBX-5668815a4-947deb46&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords=' . $q . '&paginationInput.entriesPerPage=' . $limit . '&paginationInput.pageNumber=' . $page;
        $request = 'http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=Emranulh-Peerpost-PRD-1f8f85c9b-d88f62f8&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords=' . $q . '&paginationInput.entriesPerPage=' . $limit . '&paginationInput.pageNumber=' . $page;

        return $request;
    }
    
    
    /**
     * 
     * @arguments = array of arguments
     * 
     * Gets url from 'prepare' method and sends request to amazon
     * 
     * @return = json data
     * 
    */
    private function get($parameter)
    {
        
        $url_to_fetch = $this->prepare($parameter);

        $response_from_ebay = file_get_contents($url_to_fetch);
        
        return $response_from_ebay;
        
    }
    

    public function search(Request $request)
    {
        // $app            = \App\Setting::first();

        // return view('user.pages.search-for-products-new', compact( 'app') );
        
        $data = json_decode($this->get($request), true);
        
        $productsData = $this->getData($data['findItemsByKeywordsResponse'][0]['searchResult'][0]['item']);

        return json_encode(['data' => $productsData, 'status' => ($productsData) ? 200 : 204]);
        
    }
    
    private function getData($productsRawData) {
        $productsData = [];
        $i = 0;
        $conversionRate = $this->getUsdToBdt();

        foreach($productsRawData as $products) {
            $productsData[$i]['id'] = $products['itemId'][0];
            $productsData[$i]['title'] = $products['title'][0];
            $productsData[$i]['url'] = $products['viewItemURL'][0];

            $originalPrice = $products['sellingStatus'][0]['currentPrice'][0]['__value__'];
            $price = $originalPrice + ($originalPrice/100)*20;
            $productsData[$i]['originalPrice'] = (float)$originalPrice;
            // Currency USD to BDT
            $productsData[$i]['price'] = round($price * $conversionRate, 2);

            $productsData[$i]['original_currency'] = $products['sellingStatus'][0]['currentPrice'][0]['@currencyId'];
            $productsData[$i]['currency'] = 'BDT';
            $productsData[$i]['image'] = isset($products['galleryURL'])?$products['galleryURL'][0] : '';
            $productsData[$i]['category'] = $products['primaryCategory'][0]['categoryName'][0];
            // $productsData[$i]['url'] = $products['viewItemURL'][0];
            
            $i++;
        }
        
        return $productsData;
    }

    public function getUsdToBdt()
    {
        try {
            if(session('usd_to_bdt')) {
                return $this->usdToBdtAmount;
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://free.currencyconverterapi.com/api/v6/convert?q=USD_BDT&compact=y');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $this->usdToBdtAmount = \GuzzleHttp\json_decode($output, true)['USD_BDT']['val'];
            session('usd_to_bdt', $this->usdToBdtAmount);
            return $this->usdToBdtAmount;
        } catch (\Exception $e) {
            return $this->usdToBdtAmount;
        }
    }
    
    
}
