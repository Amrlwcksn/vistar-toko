<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use App\Models\Product;
use App\Models\StoreSetting;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin User
        User::create([
            'name' => 'Admin Vistar',
            'email' => 'admin@vistartoko.com',
            'password' => Hash::make('password'),
        ]);

        // Store Settings
        StoreSetting::create([
            'whatsapp_number' => '6281234567890',
            'store_phone' => '021-555555',
            'opening_hours' => 'Setiap Hari',
            'address' => 'Jl. Curug Sewu, Semarang',
            'tagline' => 'Solusi Dokumen & ATK Terpercaya',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d988.2228746500001!2d110.0992061!3d-7.0891494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e706f223487e85d%3A0xb919fd39176a6c0a!2sVISTAR%20Studio!5e0!3m2!1sid!2sid!4v1707900000000!5m2!1sid!2sid'
        ]);

        // Services
        $s1 = Service::create([
            'name' => 'Fotokopi & Print',
            'description' => 'Layanan fotokopi hitam putih dan warna berkualitas tinggi dengan harga terjangkau.',
            'price' => 500,
            'is_highlight' => true
        ]);

        $s2 = Service::create([
            'name' => 'Pass Foto Kilat',
            'description' => 'Cetak pass foto segala ukuran (2x3, 3x4, 4x6) langsung jadi dalam 5 menit.',
            'price' => 15000,
            'is_highlight' => true
        ]);

        Service::create([
            'name' => 'Jilid Dokumen',
            'description' => 'Jilid lakban, spiral kawat, dan soft cover untuk skripsi atau laporan.',
            'price' => 5000,
            'is_highlight' => false
        ]);

        // Categories
        $c1 = Category::create(['name' => 'Alat Tulis', 'slug' => 'alat-tulis']);
        $c2 = Category::create(['name' => 'Kertas & Buku', 'slug' => 'kertas-buku']);
        $c3 = Category::create(['name' => 'Perlengkapan Kantor', 'slug' => 'perlengkapan-kantor']);

        // Products
        Product::create([
            'category_id' => $c1->id,
            'name' => 'Pulpen Standard AE7',
            'slug' => 'pulpen-standard-ae7',
            'price' => 2500,
            'description' => 'Pulpen hitam anti macet.',
            'status' => 'active'
        ]);

        Product::create([
            'category_id' => $c1->id,
            'name' => 'Pensil Faber Castell 2B',
            'slug' => 'pensil-faber-castell-2b',
            'price' => 4000,
            'description' => 'Pensil untuk ujian komputer.',
            'status' => 'active'
        ]);

        Product::create([
            'category_id' => $c2->id,
            'name' => 'Buku Tulis Sinar Dunia 38',
            'slug' => 'buku-tulis-sidu-38',
            'price' => 3500,
            'description' => 'Buku tulis kualitas terbaik.',
            'status' => 'active'
        ]);

        Product::create([
            'category_id' => $c2->id,
            'name' => 'Kertas A4 70gr (Rim)',
            'slug' => 'kertas-a4-70gr-rim',
            'price' => 45000,
            'description' => 'Kertas HVS putih bersih.',
            'status' => 'active'
        ]);

        Product::create([
            'category_id' => $c3->id,
            'name' => 'Map Plastik Clear Holder',
            'slug' => 'map-plastik-clear-holder',
            'price' => 12000,
            'description' => 'Map isi 20 lembar.',
            'status' => 'active'
        ]);
    }
}
