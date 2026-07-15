<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Payment;
use App\Models\PaymentTranslation;

class AddInstapayPaymentMethod extends Migration
{
    /**
     * إضافة طريقة دفع جديدة: انستا باي / instapay
     */
    public function up()
    {
        // نتأكد إنها مش مضافة من قبل عشان ما نكررهاش
        $exists = Payment::whereHas('translations', function ($q) {
            $q->where('name', 'instapay');
        })->exists();

        if ($exists) {
            return;
        }

        $payment = new Payment();
        $payment->status = 1;
        $payment->translateOrNew('en')->name = 'instapay';
        $payment->translateOrNew('ar')->name = 'انستا باي';
        $payment->save();
    }

    /**
     * التراجع: حذف طريقة الدفع وترجماتها
     */
    public function down()
    {
        $ids = Payment::whereHas('translations', function ($q) {
            $q->where('name', 'instapay');
        })->pluck('id');

        if ($ids->isEmpty()) {
            return;
        }

        PaymentTranslation::whereIn('payment_id', $ids)->delete();
        Payment::whereIn('id', $ids)->delete();
    }
}
