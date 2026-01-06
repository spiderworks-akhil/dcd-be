<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalNotification extends Model
{
    protected $table   = 'approval_notifications';

    protected $fillable = ['notifiable_type','notifiable_id','email_sent','created_by','status','remarks','remarks','action_date'];


     public function creator()
    {
        return $this->belongsTo('App\Models\Admin', 'created_by');
    }

}
