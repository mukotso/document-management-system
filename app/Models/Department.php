<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name','description',
    ];

    public function documents(){
        return $this->belongsToMany(Document::class, 'department_documents',
            'department_id', 'document_id');
    }
}
