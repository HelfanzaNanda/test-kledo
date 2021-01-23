<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = ['BNI', 'BCA', 'BRI', 'Mandiri', 'BPTN'];
        foreach ($payments as $payment) {
            Payment::create([
                'payment_name' => $payment
            ]);
        }
    }
}
