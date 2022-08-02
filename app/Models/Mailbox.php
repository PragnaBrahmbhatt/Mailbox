<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    use HasFactory;
    protected $fillable=['mailer_id','transport_type','mail_server','email','password','port','encryption_mode','authentication_mode','sender_address','delivery_address','created_by','smtp'];
}
