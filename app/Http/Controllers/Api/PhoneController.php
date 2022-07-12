<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhoneResource;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index()
    {
        return PhoneResource::collection(Phone::with('user')->paginate(15));
    }

    public function store(Request $request)
    {
    }

    public function show(Phone $phone)
    {
    }

    public function update(Request $request, Phone $phone)
    {
    }

    public function destroy(Phone $phone)
    {
    }
}
