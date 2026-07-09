<?php
namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Contracts\Service\Attribute\Required;
class IndexController extends Controller
{
    public function about(): View
    {
        $users = [
            ['name' => 'Alice', 'email' => 'alice@example.com'],
            ['name' => 'Bob', 'email' => 'bob@example.com'],
        ];
        return view('about', ['users' => $users]);
    }

    public function store(StorePostRequest $request)
    {

        $request->validated();

        session(['last_user' => $request->all()]);
        return redirect()->route('about');
    }

}