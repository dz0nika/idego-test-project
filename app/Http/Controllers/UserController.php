<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display user index view.
     *
     * @return Inertia\Response
     */
    public function index()
    {
        return Inertia::render('User/Index', [
            'filters' => request()->all('search', 'per_page'),
            'users' => User::filter(request()->only('search'))
                ->latest()
                ->paginate((int) request()->per_page)
                ->appends(request()->all('search', 'per_page'))
                ->through(function ($user) {
                    return array_merge(
                        $user->only(
                            'id',
                            'name',
                            'email',
                        ), [
                            'created_at' => $user->created_at->toDateTimeString(),
                        ]
                    );
                }),
        ]);
    }
}
