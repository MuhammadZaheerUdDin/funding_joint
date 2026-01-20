<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $user = Auth::user();

        $role = $user->getRole();

        $class = __NAMESPACE__ . '\\' . studly_case($role);
        if(class_exists($class)) {

            $class = new $class;

            return $class->render();

        }else{

            throw new \Exception('No dashboard class found for this user');

        }

    }


}
