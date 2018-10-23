<section class="row white-bg scrollable">
    
    <h2 class=" push-up-30">My Buys</h2>
    
    <table class="table table-responsive table-theme-1">
        <thead>
            <tr>
                <th>Edit</th>
                <th>Post Date</th>
                <th>Product</th>
                <th>Price</th>
                <th>Category</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            
            @if( auth()->user()->buyPosts()->count() > 0 )
            @foreach(auth()->user()->buyPosts()->latest()->take(50)->get() as $buy)
            
            <tr>
                <td>
                    <a href="#" class="btn" data-toggle="modal" data-target="#edit-buy-{{$buy->id}}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-buy-{{$buy->id}}" id="edit-buy-{{$buy->id}}">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                              
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h2 class="modal-title  text-left">Edit Post</h2>
                            </div>
                            
                            <div class="modal-body">
                              {!! Form::open(['url'=> action('Buyers@update', $buy->id), 'enctype'=> 'multipart/form-data', 'class'=> 'blue-label buy-info-post', 'method'=> 'patch' ]) !!}
                                <section class="row text-left">
                                    
                                    <div class="col-xs-12 no-padding">
                                        <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                            {!! Form::label('amazon_url', 'Amazon url:') !!}
                                            {!! Form::text('amazon_url', $buy->amazon_url, ['class'=> 'form-control', 'placeholder'=> 'e.g. http://www.amazon.com/iphone']) !!}
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20">
                                            {!! Form::label('other_url', "Other Url (optional)") !!}
                                            {!! Form::text('other_url', $buy->other_url, ['class'=> 'form-control', 'placeholder'=> ' Enter any url showing the product (optional)']) !!}
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 no-padding">
                                        
                                        <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20 image-chooser-area">
                                            
                                            <div class="image-chooser row">
                                                
                                                {!! Form::label('image_url', 'Choose/Upload an image for your post:') !!}
                                                
                                                <div class="upload">
                                                    <input type="file" id="img_for_amazon">
                                                    <i class="fa fa-plus"></i>
                                                    <small>Upload your own</small>
                                                </div>
                                                <div class="fetch" id="fetch_from_amazon">
                                                    <p>Fetch from Amazon</p>
                                                </div>
                                                <div class="amazon_preview">
                                                    <input type="radio" name="image_url" value="@if(strlen(trim($buy->amazon_url)) > 0){{$buy->image_url}} @endif" checked />
                                                    <img src="@if(strlen(trim($buy->amazon_url)) > 0){{$buy->image_url}} @endif" alt="Preview" id="amazon_img_preview">
                                                    <small class="message"></small>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20 image-chooser-area">
                                            
                                            <div class="image-chooser row">
                                                
                                                {!! Form::label('image_url', 'Upload an image for your post:') !!}
                                                
                                                <div class="upload">
                                                    <input type="file" value="@if(strlen(trim($buy->amazon_url)) == 0){{$buy->image_url}} @endif" id="img_for_non_amazon">
                                                    <i class="fa fa-plus"></i>
                                                    <small>Upload your own</small>
                                                </div>
                                                <div class="preview">
                                                    <img src="@if(strlen(trim($buy->amazon_url)) == 0){{$buy->image_url}} @endif" alt="Preview" id="non_amazon_img_preview">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                        {!! Form::label('name', 'What is the name of the product?') !!}
                                        {!! Form::text('name', $buy->name, ['class'=> 'form-control', 'placeholder'=> 'e.g. iPhone 6s', 'required'=> 'required' ]) !!}
                                    </div>
                                    
                                    <div class="col-xs-6 col-sm-5 col-sm-offset-1 price_area pull-up-20" transaction_charge="{{settings()->transaction_charge}}" commission="{{settings()->commission}}">
                                        
                                        {!! Form::label('price', 'How much does the product cost (USD)?') !!}
                                        {!! Form::text('price', $buy->price, ['class'=> 'form-control price', 'placeholder'=> 'Product Price (USD)', 'required'=> 'required' ]) !!}
                                        
                                        <div class="price_summary">
                                            <p>
                                                Airposted Fee <span class="pull-right">$<span class="total_commission">0</span></span>
                                                <p class="small">({{settings()->commission}}%)</p>
                                            </p>
                                            <p>
                                                Paypal Fee <span class="pull-right">$<span class="total_transaction_charge">0</span></span>
                                                <p class="small">({{settings()->transaction_charge}}% + {{env('FIXED_TRANSACTION_CHARGE')}} USD)</p>
                                            </p>
                                            <p>
                                                <b>
                                                    Total USD <span class="pull-right"><span class="total_price">0</span></span>
                                                </b>
                                            </p>
                                        </div>
                                        
                                    </div>

                                    <div class="col-xs-12 no-padding">
                                            
                                        <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                            {!! Form::label('category_id', 'Our travelers carry certain items.') !!}
                                            {!! Form::select('category_id', \App\Category::lists('name', 'id'), $buy->category_id, ['class'=> 'form-control select2', 'placeholder'=> 'Select the category for this product', 'required'=> 'required']) !!}
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20">
                                            {!! Form::label('p_weight', 'Weight (lb)') !!}
                                            {!! Form::text('p_weight', old('p_weight'), ['class'=> 'form-control', 'required'=> 'required']) !!}
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-xs-12 no-padding">
                                        
                                        
                                        <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                            {!! Form::label('p_length', 'Length (Inch)') !!}
                                            {!! Form::text('p_length', old('p_length'), ['class'=> 'form-control', 'required'=> 'required']) !!}
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20">
                                            {!! Form::label('p_height', 'Height (Inch)') !!}
                                            {!! Form::text('p_height', old('p_height'), ['class'=> 'form-control', 'required'=> 'required']) !!}
                                        </div>
                                        
                                        
                                    </div>
                                    
                                
                                    <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                        {!! Form::label('p_width', 'Width (Inch)') !!}
                                        {!! Form::text('p_width', old('p_width'), ['class'=> 'form-control', 'required'=> 'required']) !!}
                                    </div>
                                    
                                    @if( strlen( \App\User::find(auth()->user()->id)->contact ) < 5 )
                                    <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20">
                                        <div class="col-xs-12">
                                            {!! Form::label('contact', 'Phone Number (mobile/landline)') !!}
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-5 pull-right-0">
                                            {!! Form::text('contact', null, ['class'=> 'form-control', 'required'=> 'required']) !!}
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                                            {!! Form::text('contact', null, ['class'=> 'form-control', 'placeholder'=> 'Phone number starting with country code', 'required'=> 'required']) !!}
                                        </div>
                                        <small class="help-block">For verification purpose only. Will not be visible to public.</small>
                                    </div>
                                    @endif
                                    
                                </section>
                                
                            
                                <section class="row">
                                    <div class="col-xs-12 text-center pull-up-20 pull-down-20">{!! Form::submit('Update', ['class'=>'btn btn-lg green-bg white-text large-font']) !!}</div>
                                </section>
                                {!! Form::close() !!}
                                
                                <section class="row or text-center push-up-50 push-down-50">
                                    <span>OR</span>
                                </section>  
                                
                                {!! Form::open(['url'=> action('Buyers@destroy', $buy->id), 'method'=> 'delete']) !!}
                                <section class="row">
                                    <div class="col-xs-12 text-center pull-up-20 pull-down-20">{!! Form::submit('Delete Post', ['class'=>'btn btn-lg black-bg white-text large-font']) !!}</div>
                                </section>
                                {!! Form::close() !!}
                                
                                
                            </div>
                          
                        </div>
                      </div>
                    </div>
                    
                </td>
                <td>{{$buy->created_at->format('m/d/Y')}}</td>
                <td>{{$buy->name}}</td>
                <td>${{$buy->price}}</td>
                <td>@if($buy->category){{$buy->category->name}} @endif</td>
                <td>@if($buy->country){{$buy->country->name}} @endif</td>
            </tr>
            
            @endforeach
            @endif
            
        </tbody>
    </table>
    
</section>