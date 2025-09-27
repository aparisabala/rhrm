<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
class AdminProfileSetupGetController extends Controller
{
    use BaseTrait;
    public function __construct()
    {
       $this->middleware(['auth:admin','HasAdminAuth']);
    }

    /**
     * View Admin profile setup
     *
     * @param Request $request
     * @return View
    */
    public function index(Request $request)
    {
        $user = Auth::user();
        if($user->setup_done == "yes") {
            return redirect()->route('admin.dashboard.index');
        }
        $data['item'] = $user;
        return  view('admin.pages.setup.index')->with("data",$data); 
    }
}
