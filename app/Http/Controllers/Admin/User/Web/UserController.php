<?php

namespace App\Http\Controllers\Admin\User\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        return Inertia::render('admin/user/index');
    }
}
