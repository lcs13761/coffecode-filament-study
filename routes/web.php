<?php

use App\Livewire\About;
use App\Livewire\Blog;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('web.home');

Route::get('/about', About::class)->name('web.about');

Route::get('/blog', Blog::class)->name('web.blog');

Route::redirect('/login', '/admin/login', 301);
