<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentAccessRequest extends Model
{
    protected $table="document_access_requests";

    protected $fillable = [
        'user_id', 'document_id', 'status','description','decline_reason'
    ];

    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }

    public function document(){
        return $this->belongsTo(Document::class ,'document_id');
    }
}
