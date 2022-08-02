<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mailbox;
use Illuminate\Support\Facades\Auth;

class MailboxController extends Controller
{
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
