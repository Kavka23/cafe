<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;

class PaymentController extends Controller
{
    public function processPaymentAndGenerateReceipt(Request $request)
    {
        // Proses pembayaran
        
        // Pembuatan struk PDF
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        $pdf->writeHTML('<h1>Struk Pembayaran</h1>');
        // Tambahkan informasi struk sesuai kebutuhan
        
        // Simpan struk PDF
        $filePath = public_path('receipts/') . 'receipt_' . time() . '.pdf';
        $pdf->Output($filePath, 'F');

        // Kembalikan struk PDF sebagai respons
        return response()->file($filePath);
    }
    
}
