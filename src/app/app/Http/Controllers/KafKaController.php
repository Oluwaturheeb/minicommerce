<?php

namespace App\Http\Controllers;

use Junges\Kafka\Facades\Kafka;
use Illuminate\Http\Request;

class KafKaController extends Controller
{
    Kafka::publishOn('broker', 'topic')
    ->withConfigOption('property-name', 'property-value')
    ->withConfigOptions([
        'property-name' => 'property-value'
    ]);
}
