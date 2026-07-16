<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $status;
    public $statusInfo;

    public function __construct($order, $status)
    {
        $this->order = $order;
        $this->status = (int) $status;
        $this->statusInfo = $this->resolveStatus($this->status);
    }

    // خريطة الحالات: النص + الرسالة + الألوان للشارة
    private function resolveStatus($s)
    {
        $map = [
            0 => ['label' => 'قيد الانتظار',  'msg' => 'طلبك قيد المراجعة، وسنبدأ في معالجته قريباً.',                'color' => '#b7791f', 'bg' => '#fff6e6'],
            1 => ['label' => 'تمت الموافقة',  'msg' => 'تمت الموافقة على طلبك بنجاح، وسيتم تحضيره قريباً.',            'color' => '#0a7d3f', 'bg' => '#eafaf1'],
            2 => ['label' => 'تم الرفض',      'msg' => 'نعتذر، تم رفض طلبك. لأي استفسار يرجى التواصل مع فريق المبيعات.', 'color' => '#c0392b', 'bg' => '#fdecec'],
            3 => ['label' => 'جاري التحضير',  'msg' => 'نقوم الآن بتحضير طلبك تمهيداً لشحنه.',                        'color' => '#2b6cb0', 'bg' => '#eef4ff'],
            4 => ['label' => 'جاري التوصيل',  'msg' => 'طلبك في الطريق إليك الآن 🚚',                                 'color' => '#2b6cb0', 'bg' => '#eef4ff'],
            5 => ['label' => 'تم التوصيل',    'msg' => 'تم توصيل طلبك بنجاح. شكراً لتعاملك مع إيمان دنتال 🎉',          'color' => '#0a7d3f', 'bg' => '#eafaf1'],
        ];

        return $map[$s] ?? ['label' => 'تحديث الحالة', 'msg' => 'تم تحديث حالة طلبك.', 'color' => '#6B0B0C', 'bg' => '#fdf3f4'];
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'تحديث حالة طلبك #' . $this->order->id . ' — إيمان دنتال',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.orderStatusChanged',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
