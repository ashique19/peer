<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;

class Amazons extends Controller
{
    
    // Available top level nodes for US market are collected from 
    // http://docs.aws.amazon.com/AWSECommerceService/latest/DG/LocaleUS.html
    
    
    /**
     * 
     * Prepare URL with signature to send request to Amazon.
     *      - It is fully qualified URL with 'http://'
     *      - Even if you browse this URL at browser, you will get data from Amazon in XML format
     * 
     * @return string url
     * 
    */
    private function prepare($params, $version='2016-05-01')
    {
        /*
        Copyright (c) 2009-2012 Ulrich Mierendorff
    
        Permission is hereby granted, free of charge, to any person obtaining a
        copy of this software and associated documentation files (the "Software"),
        to deal in the Software without restriction, including without limitation
        the rights to use, copy, modify, merge, publish, distribute, sublicense,
        and/or sell copies of the Software, and to permit persons to whom the
        Software is furnished to do so, subject to the following conditions:
    
        The above copyright notice and this permission notice shall be included in
        all copies or substantial portions of the Software.
    
        THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
        IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
        FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
        THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
        LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
        FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
        DEALINGS IN THE SOFTWARE.
        */
        
        // 'region', 'public key' and 'private key' from env file
        $public_key     = env('AWS_ACCESS_KEY_ID');
        $private_key    = env('AWS_SECRET_ACCESS_KEY');
        $region         = env('AWS_REGION');
        
        // some paramters
        $method = 'GET';
        $host = 'webservices.amazon.'.$region;
        $uri = '/onca/xml';
        
        // additional parameters
        $params['Service'] = 'AWSECommerceService';
        $params['AWSAccessKeyId'] = $public_key;
        // GMT timestamp
        $params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');
        // API version
        $params['Version'] = $version;
        $params['AssociateTag'] = env('AssociateTag');
        // sort the parameters
        ksort($params);
        
        // create the canonicalized query
        $canonicalized_query = array();
        foreach ($params as $param=>$value)
        {
            $param = str_replace('%7E', '~', rawurlencode($param));
            $value = str_replace('%7E', '~', rawurlencode($value));
            $canonicalized_query[] = $param.'='.$value;
        }
        $canonicalized_query = implode('&', $canonicalized_query);
        
        // create the string to sign
        $string_to_sign = $method."\n".$host."\n".$uri."\n".$canonicalized_query;
        
        // calculate HMAC with SHA256 and base64-encoding
        $signature = base64_encode(hash_hmac('sha256', $string_to_sign, $private_key, TRUE));
        
        // encode the signature for the request
        $signature = str_replace('%7E', '~', rawurlencode($signature));
        
        // create request
        $request = 'http://'.$host.$uri.'?'.$canonicalized_query.'&Signature='.$signature;
        // die($request);
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
        
        $amazon_url_to_fetch = $this->prepare($parameter);
        
        $response_from_amazon = file_get_contents($amazon_url_to_fetch);
        
        $xml_to_json = json_decode(json_encode(simplexml_load_string($response_from_amazon)), true);
        
        return $xml_to_json;
        
    }
    
    /**
     * 
     * Amazon has top level categories called departments (also known as nodes)
     * Under departments, there are several categories (also known as nodes)
     * 
     * @argument top level category
     * 
     * @return second level categories under top level category
     * 
    */
    private function subCategories($parent_category_node = 2619526011)
    {
        
        return $this->get(['Operation'=> 'BrowseNodeLookup', 'BrowseNodeId'=> $parent_category_node, 'ResponseGroup'=> 'BrowseNodeInfo']);
        
    }
    
    /**
     * 
     * Search for Product.
     * 
     * @required argument = category search index (available at category table)
     *                      Collected from http://docs.aws.amazon.com/AWSECommerceService/latest/DG/LocaleUS.html
     * 
     * @optional arguments = keyword, minimum price, maximum price, page no
     * 
     * @returns = (array) Search result
     * 
    */
    private function products( $query )
    {
        
        $query = (array_key_exists('ItemPage', $query) && session()->has('last_amazon_search_query')) ? session('last_amazon_search_query') : $query;
        
        $query = (array_key_exists('Operation', $query)) ? $query : ['Operation' => 'ItemSearch'] + $query;
        
        $query['MinimumPrice']  = array_key_exists('MinimumPrice', $query)  ? $query['MinimumPrice'] : 0;
        $query['Keywords']      = array_key_exists('Keywords', $query)      ? $query['Keywords']     : ' ';
        $query['MinimumPrice']  = array_key_exists('MinimumPrice', $query)  ? $query['MinimumPrice'] : 0;
        $query['MaximumPrice']  = array_key_exists('MaximumPrice', $query)  ? $query['MaximumPrice'] : 100000;
        $query['ItemPage']      = array_key_exists('ItemPage', $query)      ? $query['ItemPage']     : 1;
        
        $result = collect($this->get($query)['Items']);
        
        $page_limit = ($query['SearchIndex'] == 'All') ? 5 : 10;
        $nextPage = $query['ItemPage'];
        $nextPage = ( (int) $nextPage >= (int) $result['TotalPages'] || (int) $nextPage >= $page_limit ) ? action('Amazons@productSearch', ['ItemPage' => 1]) : action('Amazons@productSearch', ['ItemPage' => $nextPage+1]);
        
        
        $prevPage = $query['ItemPage'];
        $prevPage = ( $prevPage - 1 < 2) ? action('Amazons@productSearch', ['ItemPage'=>1]) : action('Amazons@productSearch', ['ItemPage'=> $prevPage - 1]) ;
        
        $collction['data']      = $result['Item'];
        $collction['nextPage']  = $nextPage;
        $collction['prevPage']  = $prevPage;
        $collction['searchResult'] = $result['MoreSearchResultsUrl'];
        
        return $collction;
        
    }

    
    public function short($query)
    {
        
        $data   = $this->products($query);
        
        $products   = [];
        
        if(count($data['data']) > 0)
        {
            
            foreach($data['data'] as $item)
            {
                
                $price = 0;
                
                if(array_key_exists('OfferSummary', $item))
                {
                    if(array_key_exists('LowestNewPrice', $item['OfferSummary']))
                    {
                        
                        if(array_key_exists('Amount', $item['OfferSummary']['LowestNewPrice']))
                        {
                            
                            $price = $item['OfferSummary']['LowestNewPrice']['Amount'];
                            
                        } else{
                            
                            if(array_key_exists('Offers', $item))
                            {
                                
                                if(array_key_exists('Offer', $item['Offers']))
                                {
                                    
                                    $price = (array_key_exists('Amount', $item['Offers']['Offer']['OfferListing']['Price'])) ? $item['Offers']['Offer']['OfferListing']['Price']['Amount'] : 0;
                                    
                                }
                                
                            }
                        
                        }
                        
                    } else {
                        
                        if(array_key_exists('Offers', $item))
                        {
                            
                            $price = (array_key_exists('Offer', $item['Offers'])) ? $item['Offers']['Offer']['OfferListing']['Price']['Amount'] : 0;
                            
                        }
                        
                    }
                } else {
                        
                    if(array_key_exists('Offers', $item))
                    {
                        
                        $price = (array_key_exists('Offer', $item['Offers'])) ? $item['Offers']['Offer']['OfferListing']['Price']['Amount'] : 0;
                        
                    }
                    
                }
                
                $image = "";
                if(array_key_exists('LargeImage', $item))
                {
                    
                    $image = $item['LargeImage']['URL'];
                    
                } elseif(array_key_exists('ImageSets', $item))
                {
                    
                    if(array_key_exists('LargeImage', $item['ImageSets']['ImageSet']))
                    {
                        
                        $image = $item['ImageSets']['ImageSet']['LargeImage']['URL'];
                        
                    }
                    
                }
                
                
                $products[] = [
                    'name'  => $item['ItemAttributes']['Title'],
                    'price' => $price,
                    'image' => $image,
                    'link'  => $item['DetailPageURL'],
                ];
                
            }
            
        }
        
        $output = [
            'data'      => $products,
            'nextPage'  => $data['nextPage'],
            'prevPage'  => $data['prevPage'],
            'searchResult'  => $data['searchResult'],
        ];
        
        return $output;
        // return $data;
        
    }
    
    
    public function getAllItems()
    {
        
        $amazon              = new self();        
        
        $all_amazon_products = Cache::remember('amazon_product_list', 60*24, function() use ($amazon)
        {
        
            $products       = [];
            $seachResult    = "";
            $data           = [];
            
            for($i = 1; $i < 6; $i++)
            {
                
                $query = [
                    'SearchIndex'   => 'Books',
                    'Availability'  => 'Available',
                    'MinimumPrice'  => '100',
                    'MaximumPrice'  => '10000000',
                    'ResponseGroup' => 'Small,Images,Offers',
                    'ItemPage'      => $i
                ];
                
                $data       = $amazon->short($query);
                
                foreach ($data['data'] as $item) {
                    
                    $products[] = $item;
                    
                }
                
                if($i == 5) $seachResult = $data['searchResult'];
                
            }
            
            $data['products']       = $products;
            $data['searchResult']   = $seachResult;
            
            return $data;
        
        });
        
        return $all_amazon_products;
        
    }
    
    
    public function getSearchedItems($keyword, $category, $minPrice, $maxPrice)
    {
        
        $products       = [];
        $searchResult   = "";
        $data           = [];
        $maxPage        = ($category == 'All') ? 6 : 11;
        
        for($i = 1; $i < $maxPage; $i++)
        {
            
            $query = [
                'SearchIndex'   => $category,
                'Availability'  => 'Available',
                'MinimumPrice'  => $minPrice,
                'MaximumPrice'  => $maxPrice,
                'ResponseGroup' => 'Small,Images,Offers',
                'ItemPage'      => $i
            ];
            
            $data       = $this->short($query);
            
            foreach ($data['data'] as $item) {
                
                $products[] = $item;
                
            }
            
            if($i == 5) $searchResult = $data['searchResult'];
            
        }
        
        $data['products']       = $products;
        $data['searchResult']   = $searchResult;
        
        return $data;
        
        
    }
    

    public function productSearch(Request $request)
    {
// die('ss');
        $products       = ['products' => []];//$this->getAllItems();

        $categories     = \App\Category::active()->select('name','search_index')->get();
        
        $app            = \App\Setting::first();
        
        return view('user.pages.search-for-products', compact('categories', 'products', 'app') );
        
    }

    public function productSearchNew(Request $request)
    {
        $app            = \App\Setting::first();

        return view('user.pages.search-for-products-new', compact( 'app') );
        
    }
    
    public function proxy(Request $request)
    {

        if (!isset($_GET['url'])) die();
        $url = urldecode($_GET['url']);
        $url = 'http://' . str_replace('http://', '', $url); // Avoid accessing the file system
        echo file_get_contents($url);
        
    }
    public function productSearch1(Request $request)
    {
        // dump($request);
        die('ss');
    }

    public function postProductSearch(Request $request)
    {
        
        $keyword    = (array_key_exists('keyword', $request->all())) ? $request->input('keyword') : ' ';
        $category   = (array_key_exists('category', $request->all())) ? $request->input('category') : 'All';
        $minPrice   = 100;
        $maxPrice   = 10000;
        
        if(array_key_exists('price', $request->all()))
        {
            
            switch($request->input('price'))
            {
                
                case 1:
                        $minPrice = 10;
                        $maxPrice = 10000;
                        break;
                case 2:
                        $minPrice = 10100;
                        $maxPrice = 20000;
                        break;
                case 3:
                        $minPrice = 20100;
                        $maxPrice = 30000;
                        break;
                case 4:
                        $minPrice = 30100;
                        $maxPrice = 40000;
                        break;
                case 5:
                        $minPrice = 40100;
                        $maxPrice = 1000000;
                        break;
                
            }
            
        }
        
        $products       = $this->getSearchedItems($keyword, $category, $minPrice, $maxPrice);
        
        $categories     = \App\Category::active()->select('name','search_index')->get();
        
        $app            = \App\Setting::first();
        
        return view('user.pages.search-for-products', compact('categories', 'products', 'app') );
        
    }
    
    
    public function getProductByASIN( $asin )
    {
        
        $query = [
            'Operation'     => 'ItemLookup',
            'ItemId'        => $asin,
            'IdType'        => 'ASIN',
            'ResponseGroup' => 'OfferFull, Images, Large',
            'Condition'     => 'All',
        ];
        // return $this->get($query);
        $data       = collect($this->get($query)['Items']);
        // dd($data);
        return $data;
        
    }
    
    
    public function getProductThumbnail($asin)
    {
        
        $product = json_decode( json_encode( $this->getProductByASIN( $asin ) ), true );
        
        $item = [
            'title'     => '',
            'link'      => '',
            'price'     => 0,
            'thumb'     => '',
            'Length'    => 0,
            'Width'     => 0,
            'Height'    => 0,
            'Weight'    => 0
        ];
        
        
        if( $product ){
            
            if( array_key_exists('Item', (array) $product) )
            {
                
                $item['thumb'] = array_key_exists('LargeImage', $product['Item']) ? $product['Item']['LargeImage']['URL'] : "";
                
                if( array_key_exists('LowestNewPrice', $product['Item']['OfferSummary']) )
                {
                    
                    if( array_key_exists('Amount', $product['Item']['OfferSummary']['LowestNewPrice']) )
                    {
                        
                        $item['price'] = $product['Item']['OfferSummary']['LowestNewPrice']['Amount'];
                        
                    } elseif( array_key_exists('LowestUsedPrice', $product['Item']['OfferSummary']) ) {
                        
                        $item['price'] = $product['Item']['OfferSummary']['LowestUsedPrice']['Amount'];
                        
                    }
                    
                }
                
                if( array_key_exists('ItemAttributes', $product['Item']) )
                {
                    
                    if( array_key_exists( 'PackageDimensions', $product['Item']['ItemAttributes'] ))
                    {
                        
                        $item['Length'] = ceil( $product['Item']['ItemAttributes']['PackageDimensions']['Length'] / 100 );
                        $item['Width'] = ceil( $product['Item']['ItemAttributes']['PackageDimensions']['Width'] / 100 );
                        $item['Height'] = ceil( $product['Item']['ItemAttributes']['PackageDimensions']['Height'] / 100 );
                        $item['Weight'] = ceil( lb_to_gm( $product['Item']['ItemAttributes']['PackageDimensions']['Weight'] / 100) / 1000 ) * 1000;
                        
                    }
                    
                    
                    $item['title'] = array_key_exists('Title', $product['Item']['ItemAttributes']) ? $product['Item']['ItemAttributes']['Title'] : "";
                    
                }
                
                $item['link'] = array_key_exists('DetailPageURL', $product['Item']) ? $product['Item']['DetailPageURL'] : "";
                
            }
            
        }
        
        return $item;
        
        
    }
    
}
