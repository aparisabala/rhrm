<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Login\ValidateAdminLogin;
use App\Repositories\IBaseRepository;
use App\Traits\BaseTrait;
use Auth;
use Illuminate\Http\JsonResponse;
//vpx_imports
class AdminLoginPostController extends Controller
{
    use BaseTrait;
    public function __construct(private IBaseRepository $IBaseRepo)
    {
        $this->middleware(['guest:admin']);
    }

    /**
     * Admin Login
     *
     * @param ValidateAdminLogin $request
     * @return JsonResponse
     */
    public function login(ValidateAdminLogin $request) : JsonResponse
    {
        $u = $request->get('u');
        $attempt_to = $request->get('attempt_to');
        if (empty($u)) {
            return $this->response([ 'type' => "noUpdate", "title" => "User not found, try again"]);
        }
        $remember = false;
        if(isset($request->remember) && $request->remember == "yes") {
            $remember = true;
        }
        if (Auth::guard('admin')->attempt([$attempt_to => $request->safe()->email, 'password' => $request->safe()->password], $remember)) {
            $data['extraData'] = [
                "inflate" => "Successfully logged in, redirecting shortly",
                "redirect" => 'admin/dashboard'
            ];
            return $this->response(['type' => "success",'data'=> $data]);
        } else {
            return $this->response([ 'type' => "noUpdate", "title" => '<span class="text-danger fs-16">Incorrect username or password combination</span>']);
        }
    }
}
