<?php

namespace App\Services;

use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerReportService
{
    public function generatePdf($customers = null)
    {
        // If no specific customers are provided, fetch all customers
        if (is_null($customers)) {
            $customers = Customer::orderBy('created_at', 'asc')->get();
        }

        // Set the title for the PDF
        $title = 'Laporan Pelanggan';

        // Load the view and pass the customers data and title
        $pdf = Pdf::loadView('pdf.customers', [
            'customers' => $customers,
            'title' => $title
        ]);

        return $pdf;
    }

}