<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyCollection;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        // return PropertyResource::collection(Property::limit(3)->with('options')->get());
        return new PropertyCollection(Property::limit(3)->with('options')->get());
    }
}
