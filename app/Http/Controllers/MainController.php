<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use App\Models\Advantage;
use App\Models\Tariff;

class MainController extends Controller
{
  public function index()
  {
    // $page = Page::latest()->first();
    $page = Page::where('is_published', 1)->latest()->first();
    $advantages = Advantage::where('is_published', 1)->get();
    $services = Service::where('is_published', 1)->get();
    // $services = Service::all();
    // $advantages = [];

    $tariffs = Tariff::where('is_published', 1)->get();

    return view('main', compact('page', 'advantages', 'services', 'tariffs'));
  }
}
