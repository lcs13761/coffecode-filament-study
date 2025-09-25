<?php

use App\Livewire\About;
use App\Livewire\BlogPage;
use App\Livewire\Home;
use App\Livewire\PostShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('web.home');

Route::get('/about', About::class)->name('web.about');

Route::get('/blog', BlogPage::class)->name('web.blog');

Route::redirect('/login', '/admin/login', 301);

Route::get('/blog/{post:slug}', PostShow::class)->name('web.blog.post');
