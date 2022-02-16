<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $fillable = [
        'name', 'description', 'status','category_id','uploaded_by'
    ];

    public function user(){
        return $this->belongsTo(User::class ,'uploaded_by');
    }

}
