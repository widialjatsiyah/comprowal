<?php

use App\Models\CompanySetting;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        $company = CompanySetting::query()->first();
        $clientCount = Project::query()->where('is_active', true)->whereNotNull('client')->where('client', '!=', '')->distinct('client')->count('client');
        $productCount = Product::query()->where('is_active', true)->count();
        $products = Product::query()->where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->limit(6)->get();
        if ($products->isEmpty()) {
            $products = Product::query()->where('is_active', true)->orderBy('sort_order')->limit(6)->get();
        }
        $services = Service::query()->where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::query()->where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->limit(6)->get();
        if ($projects->isEmpty()) {
            $projects = Project::query()->where('is_active', true)->orderBy('sort_order')->limit(6)->get();
        }
        $testimonials = Testimonial::query()->where('is_active', true)->orderBy('sort_order')->get();
    } catch (Throwable) {
        $company = null;
        $services = collect();
        $projects = collect();
        $testimonials = collect();
        $clientCount = 0;
        $productCount = 0;
        $products = collect();
    }

    $company ??= new CompanySetting([
        'company_name' => config('app.name', 'Nexa Digital'),
        'tagline' => 'Digital systems for ambitious teams.',
        'description' => 'Kami membantu bisnis membangun fondasi digital yang cepat, aman, dan siap berkembang.',
        'email' => 'hello@example.com',
    ]);

    return view('welcome', compact('company', 'services', 'projects', 'testimonials', 'clientCount', 'productCount', 'products'));
})->name('home');

Route::get('/portofolio', function () {
    try {
        $company = CompanySetting::query()->first();
        $clientCount = Project::query()->where('is_active', true)->whereNotNull('client')->where('client', '!=', '')->distinct('client')->count('client');
        $projects = Project::query()->where('is_active', true)->orderBy('sort_order')->paginate(12);
    } catch (Throwable) {
        $company = null;
        $projects = collect();
        $clientCount = 0;
    }

    $company ??= new CompanySetting([
        'company_name' => config('app.name', 'Nexa Digital'),
        'description' => 'Kami membantu bisnis membangun fondasi digital yang cepat, aman, dan siap berkembang.',
    ]);

    return view('portfolio', compact('company', 'projects', 'clientCount'));
})->name('portfolio.index');

Route::get('/produk', function () {
    try {
        $company = CompanySetting::query()->first();
        $products = Product::query()->where('is_active', true)->orderBy('sort_order')->paginate(12);
    } catch (Throwable) {
        $company = null;
        $products = collect();
    }

    $company ??= new CompanySetting([
        'company_name' => config('app.name', 'Nexa Digital'),
        'description' => 'Kami membantu bisnis membangun fondasi digital yang cepat, aman, dan siap berkembang.',
    ]);

    return view('products', compact('company', 'products'));
})->name('products.index');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['nullable', 'string', 'max:50'],
        'message' => ['required', 'string', 'max:5000'],
    ]);

    ContactMessage::create($data);

    return back()->with('contact_sent', 'Pesan Anda sudah diterima. Kami akan segera menghubungi Anda.');
})->name('contact.store');
