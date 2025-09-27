<?php

namespace App\Http\Controllers\Admin\Logout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\RedirectResponse;
use App\Traits\BaseTrait;
//vpx_imports
class AdminLogoutGetController extends Controller
{
    use BaseTrait;
    public function __construct()
    {
        $this->middleware(['auth:admin','HasSetAdminPassword','HasAdminAuth']);
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.index')->withErrors(["success" => [0 => "Succesfully logged out from the system"]]);
    
    }
    //vpx_attach
}
