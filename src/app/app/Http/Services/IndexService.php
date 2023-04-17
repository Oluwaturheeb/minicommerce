<?php

namespace App\Http\Services;

use App\Models\Items;
use App\Models\User;

class IndexService extends Service
{
  public function index()
  {
    $items = Items::paginate(10);

    return $this->formattedResponse(
      status: 'success',
      message: $items ? 'Items found!' : 'No record found!',
      data: $items
    );
  }

  public function getSingleItem($slug)
  {
    $item = Items::where('slug', $slug)->first();

    return $this->formattedResponse(
      status: 'success',
      message: $item ? 'Item found!' : 'No record found!',
      data: $item,
    );
  }
}
