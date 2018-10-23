<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\messagesStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mails;
use App\Message;
use Response;

class Messages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.messages.index', ['messages'=> Message::latest()->paginate(20)]);
        
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
        
        $result =   new Message;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('message_from'))   ? $result = $result->where('message_from', 'like', '%'.$request->input('message_from').'%') : false;
					($request->input('message_to'))   ? $result = $result->where('message_to', 'like', '%'.$request->input('message_to').'%') : false;
					($request->input('is_reply'))   ? $result = $result->where('is_reply', 'like', '%'.$request->input('is_reply').'%') : false;
					($request->input('is_read'))   ? $result = $result->where('is_read', 'like', '%'.$request->input('is_read').'%') : false;
					($request->input('message_id'))   ? $result = $result->where('message_id', $request->input('message_id')) : false;
					($request->input('details'))   ? $result = $result->where('details', 'like', '%'.$request->input('details').'%') : false;
        
        return view('admin.messages.index', ['messages'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.messages.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(messagesStoreRequest $request)
    {
        $save_success = Message::create($request->all());
        
        if($save_success){
            if($request->ajax()) {
                return Response::json([
                    'data' => $save_success,
                    'status'=> 200,
                    'message' => 'message send successful']);
            } else {
                return redirect()->action('Messages@index')->withErrors('Data has been stored successfully.');
            }

        } else{
            if($request->ajax()) {
                return Response::json([
                    'data' => false,
                    'status'=> 400,
                    'message' => 'message send not successful']);
            } else {
                return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            }

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
    
        $message = Message::find($id); 
        
        return view('admin.messages.show', compact('message') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $message = Message::find($id); 
        
        return view('admin.messages.edit', compact('message') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(messagesStoreRequest $request, $id)
    {
        $message = Message::find($id);
        
        
        $save_success = Message::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Messages@index')->withErrors('Data has been updated successfully.');
        
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
        
        $message = Message::find($id);
        
        if($message)
        {
    
    
            if($message->delete())
            {
            
                return back()->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    /**
     * 
     * Get all the messages related to logged in user
     * 
    */
    public function myMessages(\App\Message $messages)
    {
        
        if(auth()->user()){
        
            $mySentMessages     = $messages->where('message_from', auth()->user()->id )->latest()->take(50)->get();
        
            $myReceivedMessages = $messages->where('message_to', auth()->user()->id )->latest()->take(50)->get();
            
            $myAllMessages      = $mySentMessages->merge($myReceivedMessages)->sortByDesc('created_at');
            
            return view('user.pages.my-messages', compact('mySentMessages', 'myReceivedMessages') );
        
        } else {
            
            return redirect()->route('login')->withErrors('Please login to continue');
            
        }
        
    }
    
    /**
     * 
     * Get one individual message related to logged in user
     * 
     * @param id = message id
     * 
    */
    public function myMessageItem($id, \App\Message $messages)
    {
        
        if(auth()->user()){
        
            $firstMessage       = $messages->where('id',$id)->get();
            $replyMessages      = $messages->where('message_id', $id)->get();
            
            /**
             *   Mark Messages as Read
             */
            $messages->where('id',$id)->update(['is_read'=> 1]);
            $messages->where('message_id', $id)->update(['is_read'=> 1]);
            
            $allMessagesWithThisID = $firstMessage->merge($replyMessages)->unique('id');
            
            $messagesIsent      = $allMessagesWithThisID->where('message_from', auth()->user()->id);
            $messagesIreceived  = $allMessagesWithThisID->where('message_to', auth()->user()->id);
            
            $messageList        = $messagesIsent->merge($messagesIreceived)->unique('id')->sortBy('created_at');
            
            return view('user.pages.message-item', compact('messageList') );
        
        } else{
            
            return redirect()->route('login')->withErrors('Please login to continue');
            
        }
    }
    
    /**
     * 
     * Reply one individual message related to logged in user
     * 
     * @param id = message id
     * 
     * @param request = reply data
     * 
    */
    public function replyMessageItem(Request $request, $id, \App\Message $messages, Mails $mails)
    {
        
        $message = $messages->find($id);
        
        if($message)
        {
            
            $reply = $messages->create([
                'name'=> 'Re: '.$message->name,
                'message_from' => auth()->user()->id,
                'message_to' => ($message->from->id == auth()->user()->id) ? $message->to->id : $message->from->id,
                'is_reply' => 1,
                'is_read' => 0,
                'message_id' => $id,
                'details' => $request->input('details')
            ]);
            
            if($reply)
            {
                
                $mails->messageReply($reply->message_to, $reply->message_from , $reply->details);
                
                return redirect()->action('Messages@myMessages')->withErrors('Mail replied successfully.');
                
            } else{
                
                return redirect()->action('Messages@myMessages')->withErrors('Failed to reply message. Please retry later. ');
                
            }
            
        } else {
            
            return redirect()->action('Messages@myMessages')->withErrors('Failed to process request. Please retry later.');
            
        }
        
    }
    
    
    public function messageToTraveller(Request $request, Mails $mails)
    {
        
        if(!$request->input('traveller_id') || !$request->input('name') || !$request->input('details'))
        {
            
            return 'Please enter Subject and Message.';
            
        }
        
        $message = \App\Message::create([
            'name'=> $request->input('name'),
            'message_from' => auth()->user()->id,
            'message_to' => $request->input('traveller_id'),
            'is_reply' => 0,
            'is_read' => 0,
            'message_id' => null,
            'details' => $request->input('details')
        ]);
        
        if($message)
        {
            
            $mails->messageToBuyerTraveller($message->message_to, $message->message_from, $message->name, $message->details);
            
            return 'Message has been sent to the traveler.';
            
        } else{
            
            return 'Failed to send message. Please retry.';
            
        }
        
    }
    
    
    public function messageToBuyer(Request $request, Mails $mails)
    {
        
        if(!$request->input('buyer_id') || !$request->input('name') || !$request->input('details'))
        {
            
            return 'Please enter Subject and Message.';
            
        }
        
        $message = \App\Message::create([
            'name'=> $request->input('name'),
            'message_from' => auth()->user()->id,
            'message_to' => $request->input('buyer_id'),
            'is_reply' => 0,
            'is_read' => 0,
            'message_id' => null,
            'details' => $request->input('details')
        ]);
        
        if($message)
        {
            
            $mails->messageToBuyerTraveller($message->message_to, $message->message_from, $message->name, $message->details);
            
            return 'Message has been sent to the buyer.';
            
        } else{
            return 'Failed to send message. Please retry.';
        }
    }

    public function inbox(\App\Message $messages)
    {
        if(auth()->user()) {
            $loggedInUserId = auth()->user()->id;
            $mySentMessages = $messages->with(['to', 'from'])->where('message_from', $loggedInUserId)->latest()->take(50)->get();

            $myReceivedMessages = $messages->with('from')->where('message_to',$loggedInUserId)->latest()->take(50)->get();

            $myAllMessages = $mySentMessages->merge($myReceivedMessages)->sortBy('created_at');

            return view('user.pages.product.inbox', ['messages' => $myAllMessages, 'loggedInUserId' => $loggedInUserId]);
        }
    }
    
    
}

