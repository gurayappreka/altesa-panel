<?php

return [
    'company' => [
        'name' => env('COMPANY_NAME', 'Altesa'),
        'address' => env('COMPANY_ADDRESS', ''),
        'phone' => env('COMPANY_PHONE', ''),
        'email' => env('COMPANY_EMAIL', 'info@altesa.com'),
        'tax_number' => env('COMPANY_TAX_NUMBER', ''),
        'tax_office' => env('COMPANY_TAX_OFFICE', ''),
    ],
    
    'formats' => [
        'quote_prefix' => 'TKL',
        'quote_digits' => 5,
        'purchase_prefix' => 'SIP',
        'purchase_digits' => 5,
    ],
    
    'uploads' => [
        'max_size' => env('MAX_UPLOAD_SIZE', 10240), // KB
        'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', 'txt', 'csv'],
    ],
    
    'pagination' => [
        'per_page' => 15,
    ],
    
    'tax_rate' => 18, // %
];
