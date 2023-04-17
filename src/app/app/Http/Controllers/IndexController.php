<?php

namespace App\Http\Controllers;

use App\Http\Services\IndexService;
use App\Models\Items;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public $service;
    public function __construct() {
        $this->service = new IndexService();
    }
    public function index () {
        $items = $this->service->index();

        // dd($items->data);

        return view('index', ['items' => $items]);
    }

    public function singleProduct (Request $request) {
        if (!$request->slug) redirect()->route(404);

        $item = $this->service->getSingleItem($request->slug);
        if (!$item->data) redirect()->route(404);
        return view('single-product', ['item' => $item->data]);
    }
}
