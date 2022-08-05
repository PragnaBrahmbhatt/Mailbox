<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mailbox;
use Illuminate\Support\Facades\Auth;
use Webklex\IMAP\Facades\Client;

class MailboxController extends Controller
{
    /**
     * MAIL_MAILER=smtp
        // MAIL_HOST=smtp.gmail.com
        // MAIL_PORT=587
        // MAIL_USERNAME=
        // MAIL_PASSWORD=
        // MAIL_ENCRYPTION=TLS
        // MAIL_FROM_ADDRESS=pragna@gmail.com
        // MAIL_FROM_NAME="${APP_NAME}"

        // IMAP_HOST=imap.gmail.com
        // IMAP_PORT=993
        // IMAP_ENCRYPTION=ssl
        // IMAP_VALIDATE_CERT=true
        // IMAP_USERNAME=
        // IMAP_PASSWORD=
        // IMAP_DEFAULT_ACCOUNT=default
        // IMAP_PROTOCOL=imap
     */
    public function getMails()
    {
        $client = Client::account('default');

        // $oClient = Client::account('default'); // defined in config/imap.php
        $client->connect();

        // get all unseen messages from folder INBOX
        $folders = $client->getFolders();
        // $aMessage = $folders->query()->all()->get();


        // dd($aMessage);
        foreach($folders as $folder){
            //Get all Messages of the current Mailbox $folder
            /** @var \Webklex\PHPIMAP\Support\MessageCollection $messages */
            dd($folder->query()->all()->get());
            $messages = $folder->messages()->all()->get();
            
            /** @var \Webklex\PHPIMAP\Message $message */
            foreach($messages as $message){
                echo $message->getSubject().'<br />';
                echo 'Attachments: '.$message->getAttachments()->count().'<br />';
                echo $message->getHTMLBody();
                
                //Move the current Message to 'INBOX.read'
                if($message->move('INBOX.read') == true){
                    echo 'Message has ben moved';
                }else{
                    echo 'Message could not be moved';
                }
                exit;
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Mailbox::select('id','mailer_id','smtp'))
            ->addColumn('action', function($row){
                $btn = '';
                // if(Auth::user()->can('edit.smtp')){
                    $btn = '<a href="'.route('mailbox.edit', ['mailbox' => $row->id]).'" class="btn btn-success btn-xs edit-mailbox"> <i class="fa fa-edit"></i> </a>';
                // }
                // if(Auth::user()->can('delete.mailbox')){
                    $btn = $btn.'<button type="submit" class="btn btn-danger btn-xs delete-mailbox" data-id="'.$row->id.'"><i class="fa fa-trash"></i></button>';
                // }
                return $btn;
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view('mailbox.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mailbox.create', ['mailbox' => new Mailbox()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = Mailbox::create([
            'mailer_id' => $request->mailer_id,
            'transport_type' => $request->transport_type,
            'mail_server' => $request->mail_server,
            'email' => $request->email,
            'password' => $request->password,
            'port' => $request->port,
            'encryption_mode' => $request->encryption_mode,
            'authentication_mode' => $request->authentication_mode ?? 'login',
            'sender_address' => $request->sender_address,
            'delivery_address' => $request->delivery_address,
            'created_by' => auth()->user()->id,
            'smtp' => $request->smtp
        ]);
        return redirect()->route('mailbox.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mailbox $mailbox)
    {
        return view('mailbox.create', ['mailbox' => $mailbox]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mailbox $mailbox)
    {
        // $request->validate([
        //     'name' => 'required|unique:groups,name,'.$group->id
        // ]);
        $mailbox->fill($request->all())->save();
        
        return redirect()->route('mailbox.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $mailbox = Mailbox::find($request->id)->delete();
        if($mailbox)
            return response()->json(['msg' => 'Mailbox deleted successfully!']);

        return response()->json(['msg' => 'Something went wrong, Please try again'],500);
    }
}
