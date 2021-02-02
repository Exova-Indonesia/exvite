<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments_method')->insert([
            // 'pm_name' => 'gopay',
            // 'pm_description' => 'Membayar dengan metode <strong> QRIS </strong> yaitu dengan scan barcode dari aplikasi E-Money seperti <strong> Gopay, OVO, Dana, LinkAja, Jenius,</strong> Dll',
            // 'pm_icons' => 'http://localhost:8000/images/icons/qris.png',
            // 'pm_name' => 'vabni',
            // 'pm_description' => 'Membayar dengan metode <strong> Virtual Account Mandiri </strong> akan otomatis terkonfirmasi. <br> terdapat biaya transfer sebesar IDR 4,000 untuk setiap transaksi',
            // 'pm_icons' => 'http://localhost:8000/images/icons/bni.png',
            // 'pm_name' => 'otherbank',
            // 'pm_description' => 'Membayar dengan <strong> Bank Lainnya </strong> dapat dilakukan dengan bank apapun dan juga akan otomatis terkonfirmasi. <br> terdapat biaya transfer sebesar IDR 4,000 untuk setiap transaksi',
            // 'pm_icons' => 'http://localhost:8000/images/icons/other.png',
            'pm_name' => 'vapermata',
            'pm_description' => 'Membayar dengan metode <strong> Virtual Account Permata </strong> akan otomatis terkonfirmasi. <br> terdapat biaya transfer sebesar IDR 4,000 untuk setiap transaksi',
            'pm_icons' => 'http://localhost:8000/images/icons/permata.png',
            ]);
    }
}
