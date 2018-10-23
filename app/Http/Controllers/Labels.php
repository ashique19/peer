<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\labelsStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Pitneybowes;
use App\Label;

class Labels extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.labels.index', ['labels'=> Label::latest()->paginate(20)]);
        
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
        
        $result =   new Label;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('user_id'))   ? $result = $result->where('user_id', $request->input('user_id')) : false;
					($request->input('payment_id'))   ? $result = $result->where('payment_id', $request->input('payment_id')) : false;
					($request->input('is_paid'))   ? $result = $result->where('is_paid', 'like', '%'.$request->input('is_paid').'%') : false;
					($request->input('buyer_name'))   ? $result = $result->where('buyer_name', 'like', '%'.$request->input('buyer_name').'%') : false;
					($request->input('buyer_company'))   ? $result = $result->where('buyer_company', 'like', '%'.$request->input('buyer_company').'%') : false;
					($request->input('buyer_email'))   ? $result = $result->where('buyer_email', 'like', '%'.$request->input('buyer_email').'%') : false;
					($request->input('buyer_phone'))   ? $result = $result->where('buyer_phone', 'like', '%'.$request->input('buyer_phone').'%') : false;
					($request->input('buyer_residential'))   ? $result = $result->where('buyer_residential', 'like', '%'.$request->input('buyer_residential').'%') : false;
					($request->input('buyer_addressLines'))   ? $result = $result->where('buyer_addressLines', 'like', '%'.$request->input('buyer_addressLines').'%') : false;
					($request->input('buyer_cityTown'))   ? $result = $result->where('buyer_cityTown', 'like', '%'.$request->input('buyer_cityTown').'%') : false;
					($request->input('buyer_stateProvince'))   ? $result = $result->where('buyer_stateProvince', 'like', '%'.$request->input('buyer_stateProvince').'%') : false;
					($request->input('buyer_postalCode'))   ? $result = $result->where('buyer_postalCode', 'like', '%'.$request->input('buyer_postalCode').'%') : false;
					($request->input('buyer_countryCode'))   ? $result = $result->where('buyer_countryCode', 'like', '%'.$request->input('buyer_countryCode').'%') : false;
					($request->input('receiver_name'))   ? $result = $result->where('receiver_name', 'like', '%'.$request->input('receiver_name').'%') : false;
					($request->input('receiver_company'))   ? $result = $result->where('receiver_company', 'like', '%'.$request->input('receiver_company').'%') : false;
					($request->input('receiver_email'))   ? $result = $result->where('receiver_email', 'like', '%'.$request->input('receiver_email').'%') : false;
					($request->input('receiver_phone'))   ? $result = $result->where('receiver_phone', 'like', '%'.$request->input('receiver_phone').'%') : false;
					($request->input('receiver_residential'))   ? $result = $result->where('receiver_residential', 'like', '%'.$request->input('receiver_residential').'%') : false;
					($request->input('receiver_addressLines'))   ? $result = $result->where('receiver_addressLines', 'like', '%'.$request->input('receiver_addressLines').'%') : false;
					($request->input('receiver_cityTown'))   ? $result = $result->where('receiver_cityTown', 'like', '%'.$request->input('receiver_cityTown').'%') : false;
					($request->input('receiver_stateProvince'))   ? $result = $result->where('receiver_stateProvince', 'like', '%'.$request->input('receiver_stateProvince').'%') : false;
					($request->input('receiver_postalCode'))   ? $result = $result->where('receiver_postalCode', 'like', '%'.$request->input('receiver_postalCode').'%') : false;
					($request->input('receiver_countryCode'))   ? $result = $result->where('receiver_countryCode', 'like', '%'.$request->input('receiver_countryCode').'%') : false;
					($request->input('parcel_weight_amount'))   ? $result = $result->where('parcel_weight_amount', 'like', '%'.$request->input('parcel_weight_amount').'%') : false;
					($request->input('parcel_weight_unitOfMeasurement'))   ? $result = $result->where('parcel_weight_unitOfMeasurement', 'like', '%'.$request->input('parcel_weight_unitOfMeasurement').'%') : false;
					($request->input('parcel_dimension_unitOfMeasurement'))   ? $result = $result->where('parcel_dimension_unitOfMeasurement', 'like', '%'.$request->input('parcel_dimension_unitOfMeasurement').'%') : false;
					($request->input('parcel_dimension_length'))   ? $result = $result->where('parcel_dimension_length', 'like', '%'.$request->input('parcel_dimension_length').'%') : false;
					($request->input('parcel_dimension_width'))   ? $result = $result->where('parcel_dimension_width', 'like', '%'.$request->input('parcel_dimension_width').'%') : false;
					($request->input('parcel_dimension_height'))   ? $result = $result->where('parcel_dimension_height', 'like', '%'.$request->input('parcel_dimension_height').'%') : false;
					($request->input('parcel_dimension_irregularParcelGirth'))   ? $result = $result->where('parcel_dimension_irregularParcelGirth', 'like', '%'.$request->input('parcel_dimension_irregularParcelGirth').'%') : false;
					($request->input('rates_carrier'))   ? $result = $result->where('rates_carrier', 'like', '%'.$request->input('rates_carrier').'%') : false;
					($request->input('rates_parcelType'))   ? $result = $result->where('rates_parcelType', 'like', '%'.$request->input('rates_parcelType').'%') : false;
					($request->input('rates_serviceId'))   ? $result = $result->where('rates_serviceId', 'like', '%'.$request->input('rates_serviceId').'%') : false;
					($request->input('rates_rateTypeId'))   ? $result = $result->where('rates_rateTypeId', 'like', '%'.$request->input('rates_rateTypeId').'%') : false;
					($request->input('rates_deliveryCommitment_minEstimatedNumberOfDays'))   ? $result = $result->where('rates_deliveryCommitment_minEstimatedNumberOfDays', 'like', '%'.$request->input('rates_deliveryCommitment_minEstimatedNumberOfDays').'%') : false;
					($request->input('rates_deliveryCommitment_maxEstimatedNumberOfDays'))   ? $result = $result->where('rates_deliveryCommitment_maxEstimatedNumberOfDays', 'like', '%'.$request->input('rates_deliveryCommitment_maxEstimatedNumberOfDays').'%') : false;
					($request->input('rates_deliveryCommitment_estimatedDeliveryDateTime'))   ? $result = $result->where('rates_deliveryCommitment_estimatedDeliveryDateTime', 'like', '%'.$request->input('rates_deliveryCommitment_estimatedDeliveryDateTime').'%') : false;
					($request->input('rates_deliveryCommitment_guarantee'))   ? $result = $result->where('rates_deliveryCommitment_guarantee', 'like', '%'.$request->input('rates_deliveryCommitment_guarantee').'%') : false;
					($request->input('rates_deliveryCommitment_additionalDetails'))   ? $result = $result->where('rates_deliveryCommitment_additionalDetails', 'like', '%'.$request->input('rates_deliveryCommitment_additionalDetails').'%') : false;
					($request->input('rates_dimensionalWeight_weight'))   ? $result = $result->where('rates_dimensionalWeight_weight', 'like', '%'.$request->input('rates_dimensionalWeight_weight').'%') : false;
					($request->input('rates_dimensionalWeight_unitOfMeasurement'))   ? $result = $result->where('rates_dimensionalWeight_unitOfMeasurement', 'like', '%'.$request->input('rates_dimensionalWeight_unitOfMeasurement').'%') : false;
					($request->input('rates_baseCharge'))   ? $result = $result->where('rates_baseCharge', 'like', '%'.$request->input('rates_baseCharge').'%') : false;
					($request->input('rates_totalCarrierCharge'))   ? $result = $result->where('rates_totalCarrierCharge', 'like', '%'.$request->input('rates_totalCarrierCharge').'%') : false;
					($request->input('rates_alternateBaseCharge'))   ? $result = $result->where('rates_alternateBaseCharge', 'like', '%'.$request->input('rates_alternateBaseCharge').'%') : false;
					($request->input('rates_currencyCode'))   ? $result = $result->where('rates_currencyCode', 'like', '%'.$request->input('rates_currencyCode').'%') : false;
					($request->input('rates_destinationZone'))   ? $result = $result->where('rates_destinationZone', 'like', '%'.$request->input('rates_destinationZone').'%') : false;
					($request->input('rates_alternateTotalCharge'))   ? $result = $result->where('rates_alternateTotalCharge', 'like', '%'.$request->input('rates_alternateTotalCharge').'%') : false;
					($request->input('documents_type'))   ? $result = $result->where('documents_type', 'like', '%'.$request->input('documents_type').'%') : false;
					($request->input('documents_contentType'))   ? $result = $result->where('documents_contentType', 'like', '%'.$request->input('documents_contentType').'%') : false;
					($request->input('documents_fileFormat'))   ? $result = $result->where('documents_fileFormat', 'like', '%'.$request->input('documents_fileFormat').'%') : false;
					($request->input('documents_contents'))   ? $result = $result->where('documents_contents', 'like', '%'.$request->input('documents_contents').'%') : false;
					($request->input('shipperId'))   ? $result = $result->where('shipperId', 'like', '%'.$request->input('shipperId').'%') : false;
					($request->input('shipmentId'))   ? $result = $result->where('shipmentId', 'like', '%'.$request->input('shipmentId').'%') : false;
					($request->input('parcelTrackingNumber'))   ? $result = $result->where('parcelTrackingNumber', 'like', '%'.$request->input('parcelTrackingNumber').'%') : false;
        
        return view('admin.labels.index', ['labels'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.labels.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(labelsStoreRequest $request)
    {
        
        
        
        $save_success = Label::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Labels@index')->withErrors('Data has been stored successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
    
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $label = Label::find($id); 
        
        return view('admin.labels.show', compact('label') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $label = Label::find($id); 
        
        return view('admin.labels.edit', compact('label') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(labelsStoreRequest $request, $id)
    {
        
        $label = Label::find($id);
        
        $save_success = Label::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Labels@index')->withErrors('Data has been updated successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrderLabel(labelsStoreRequest $request, $id)
    {
        
        $label = Label::find($id);
        
        $save_success = Label::find($id)->update([
        
            'buyer_name' => $request->input('sender_name'),
            'buyer_company' => $request->input('sender_company'),
            'buyer_email' => $request->input('sender_email'),
            'buyer_phone' => $request->input('sender_phone'),
            'buyer_addressLines' => $request->input('sender_address'),
            'buyer_cityTown' => \App\City::find($request->input('sender_city_id')) ? \App\City::find($request->input('sender_city_id'))->name : "",
            'buyer_stateProvince' => $request->input('sender_state'),
            'buyer_postalCode' => $request->input('sender_postcode'),
            'buyer_countryCode' => \App\Country::find($request->input('sender_country_id'))->code,
            'receiver_name' => $request->input('receiver_name'),
            'receiver_company' => $request->input('receiver_company'),
            'receiver_email' => $request->input('receiver_email'),
            'receiver_phone' => $request->input('receiver_phone'),
            'receiver_addressLines' => $request->input('receiver_address'),
            'receiver_cityTown' => \App\City::find($request->input('receiver_city_id')) ? \App\City::find($request->input('receiver_city_id'))->name : "",
            'receiver_stateProvince' => $request->input('receiver_state'),
            'receiver_postalCode' => $request->input('receiver_postcode'),
            'receiver_countryCode' => \App\Country::find($request->input('receiver_country_id'))->code,
            'rates_parcelType' => $request->input('parcel_type'),
            'parcel_weight_amount' => gm_to_oz($request->input('box_weight')),
            'parcel_dimension_length' => $request->input('box_length'),
            'parcel_dimension_width' => $request->input('box_width'),
            'parcel_dimension_height' => $request->input('box_height'),
            'rates_carrier' => $request->input('shipping_agent'),
            'rates_totalCarrierCharge' => $request->input('rates_totalCarrierCharge'),
        
        ]);
        
        if($save_success)
        {
            
            $orderID = \App\Order::where('label_id', $id)->first()->id;
            
            (new \App\Http\Controllers\Orders)->updateOrderPricing( $orderID );
            
            \App\Notification::create([
                'name' => 'Shipping detail of your order has been updated.',
                'link' => 'order-summary/'.$orderID ,
                'notification_to' => $label->user_id
            ]);
            
            return back()->withErrors('Label information has been updated successfully.');
        
        } else{
            
            return back()->withErrors('Sorry! Failed to save Label Information. Please check your data and retry later.');
            
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
        
        $label = Label::find($id);
    
        
        if($label)
        {
    
    
            if($label->delete())
            {
            
                return redirect()->action('Labels@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    
    public function showLabelToUser()
    {
        
        return view('user.pages.label-show', ['labels' => \App\Label::shippingLabels()->latest()->paginate(20)] );
        
    }
    
    
    public function sessionEditByUser()
    {
        
        $label = session('label_purchase_preference');
        
        $rates = [];
        
        return view('user.pages.label-edit-from-session', compact('label', 'rates') );
        
        
    }
    
    
    public function editByUser($labelID)
    {
        
        $label = Label::where('id',$labelID)->where('user_id', auth()->user()->id)->first() ?: null;
        
        if($label)
        {
            
            $label = $label->payment->status == 1 ? $label : null;
            
        }
        
        $rates = [];
        
        return view('user.pages.label-edit', compact('label', 'rates') );
        
        
    }
    
    
    public function deleteByUser($paymentID)
    {
        
        if( \App\Payment::where('id', $paymentID)->where('buyer_id', auth()->user()->id)->where('status', 1)->delete() )
        {
            
            return redirect()->action('Labels@showLabelToUser')->withErrors('Label has been Deleted.');
            
        }
        
        return redirect()->action('Labels@showLabelToUser')->withErrors('Failed to delete label. Please contact admin.');
        
    }
    
    
}

        