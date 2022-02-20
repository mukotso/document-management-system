<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\User;

class AnalyticsController extends Controller
{
    public function analytics(){
        $users=User::count();
        $department=Department::count();
        $managers=User::where('role_id',2)->count();
        $analysts=User::where('role_id',3)->count();
        $belowAnalysts=User::where('role_id',4)->count();
        $category=Category::count();
        $analysis=[];
        $analysis['user']=$users;
        $analysis['department']=$department;
        $analysis['managers']=$managers;
        $analysis['analysts']=$analysts;
        $analysis['belowAnalysts']=$belowAnalysts;
        $analysis['category']=$category;
        return $analysis;
    }
}
