<?php

namespace App\Http\Controllers;

use App\Jobs\ByeJob;
use App\Jobs\HelloJob;
use App\Models\Item;
use Illuminate\Contracts\View\View;

class HelloController extends Controller
{
    public function sayHello()
    {
//        $items = Item::all();
//
//        return view('hello', [
//            'items' => $items
//        ]);

        $this->dispatch(new HelloJob);
    }

    public function sayBye()
    {
        $this->dispatch(new ByeJob);
    }

    public function say()
    {
        return view('say');
    }
}
