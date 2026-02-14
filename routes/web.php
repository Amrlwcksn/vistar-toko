<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [\App\Http\Controllers\Guest\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [\App\Http\Controllers\Guest\ProductController::class, 'show'])->name('products.show');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('adminpanel')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('services', ServiceController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', ProductController::class);
    
    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
    
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// Utility route to create storage link on shared hosting
Route::get('/create-storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');
    
    // Fix permissions recursively if possible
    @chmod(storage_path(), 0755);
    @chmod(storage_path('app'), 0755);
    @chmod($target, 0755);
    @mkdir($target . '/products', 0755, true);
    @chmod($target . '/products', 0755);

    echo "<h3>Laravel Path Info</h3>";
    echo "Base Path: " . base_path() . "<br>";
    echo "Public Path: " . public_path() . "<br>";
    echo "Target: $target <br>";
    echo "Link: $link <br><br>";
    
    echo "<h3>Parent Permissions Check</h3>";
    $pathParts = explode('/', $target);
    $currentPath = '';
    foreach ($pathParts as $part) {
        if (empty($part)) {
            $currentPath .= '/';
            continue;
        }
        $currentPath .= $part . '/';
        if (file_exists($currentPath)) {
            $perms = decoct(fileperms($currentPath) & 0777);
            echo "Path: $currentPath | Permissions: <b>$perms</b><br>";
        }
    }
    echo "<br>";

    // Test write
    $testFile = $target . '/test_write.txt';
    if (@file_put_contents($testFile, 'web_server_test')) {
        @chmod($testFile, 0644);
        echo "Write Test: <b>SUCCESS</b> (Server can write to storage)<br>";
        echo "Test URL: <a href='".asset('storage/test_write.txt')."' target='_blank'>Klik untuk cek akses file</a><br><br>";
    } else {
        echo "Write Test: <b>FAILED</b> (Permission issue on storage folder)<br><br>";
    }

    if (file_exists($link)) {
        if (is_link($link)) {
            echo "Symlink status: <b>Valid</b><br>";
        } else {
            echo "Symlink status: <b>ERROR</b> (Physical folder exists instead of link)<br>";
        }
    } else {
        if (symlink($target, $link)) {
            echo "Symlink status: <b>Created just now</b><br>";
        } else {
            echo "Symlink status: <b>Failed to create</b><br>";
        }
    }
});




