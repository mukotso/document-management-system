<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'access_level', 'status','category_id','uploaded_by','file_path'
    ];

    public function user(){
        return $this->belongsTo(User::class ,'uploaded_by');
    }

    public function category(){
        return $this->belongsTo(Category::class ,'category_id');
    }

    public function department(){
        return $this->belongsToMany(Department::class, 'department_documents',
            'document_id', 'department_id');
    }
}
