<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentDocument extends Model
{
    protected $fillable = [
         'document_id','department_id',
    ];
    protected $table="department_documents";


}
