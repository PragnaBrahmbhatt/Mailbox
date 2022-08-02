@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>{{ $mailbox->id == null ? 'Create' : 'Update' }} Smtp</h1>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <div class="clearfix"></div>
    <div class="card">
        <form action="{{ $mailbox->id == null ?  route('mailbox.store') : route('mailbox.update', ['mailbox' => $mailbox->id]) }}" method="POST" id="mailboxForm">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="mailer_id">Mailer ID</label>
                        <input class="form-control @error('mailer_id') is-invalid @enderror" name="mailer_id" type="text" value="{{ old('mailer_id', $mailbox->mailer_id) }}">
                        @error('mailer_id')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="transport_type">Transport Type</label>
                        <select class="form-control transport_type" name="transport_type" title="Select User">
                            <option value="">--Select--</option>
                            <option value="smtp">SMTP</option>
                            <option value="gmail">Gmail</option>                
                            <option value="yahoo">Yahoo</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="mail_server">Server</label>
                        <input class="form-control @error('mail_server') is-invalid @enderror" name="mail_server" type="text" value="{{ old('mail_server', $mailbox->mail_server) }}">
                        @error('mail_server')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" value="{{ old('email', $mailbox->email) }}">
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" value="{{ old('password', $mailbox->password) }}">
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="port">Port</label>
                        <input class="form-control @error('port') is-invalid @enderror" name="port" type="port" value="{{ old('port', $mailbox->port) }}">
                        @error('port')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="encryption_mode">Encryption Mode</label>
                        <select class="form-control encryption_mode" name="encryption_mode" title="Select Encryption Mode">
                            <option value="">--Select--</option>
                            <option value="smtp">SMTP</option>
                            <option value="gmail">Gmail</option>                
                            <option value="yahoo">Yahoo</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="smtp">SMTP</label>
                        <select class="form-control smtp" name="smtp" title="Select Encryption Mode">
                            <option value="">--Select--</option>
                            <option value="0">SMTP</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="sender_address">Sender Address</label>
                        <textarea class="form-control sender_address" rows="3" name="sender_address" placeholder="Enter ...">{{ old('sender_address', $mailbox->sender_address) }}</textarea>
                        @error('sender_address')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="delivery_address">Delivery Address</label>
                        <textarea class="form-control" rows="3" name="delivery_address" placeholder="Enter ...">{{ old('delivery_address', $mailbox->delivery_address) }}</textarea>
                        @error('delivery_address')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input class="btn btn-primary" type="submit" value="{{ $mailbox->id == null ? 'Save' : 'Update' }}">
                <a href="{{ route('mailbox.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
@endsection