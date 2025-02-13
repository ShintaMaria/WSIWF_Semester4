<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class ManagementUserController extends Controller
{
    public function index(){
        return "Halo ini adalah method index, dalam controller ManagementUser";
    }
}