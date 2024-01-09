<?php

class ComposerScripts
{
    public static function postInstall()
    {
        // Lấy giá trị option từ cấu hình Laravel
        $paymentType = config('laravel.options.payment_type', 'credit_card');

        // Thực hiện các công việc dựa trên giá trị option
        if ($paymentType === 'credit_card') {
            // Thực hiện công việc cho loại thanh toán Credit Card
            echo "Installing Credit Card Service...\n";
        } elseif ($paymentType === 'linepay') {
            // Thực hiện công việc cho loại thanh toán LinePay
            echo "Installing LinePay Service...\n";
        } elseif ($paymentType === 'paypay') {
            // Thực hiện công việc cho loại thanh toán PayPay
            echo "Installing PayPay Service...\n";
        }
    }
}