<?php
return [
    'APP_NAME' => 'Saloon POS',
    'DEVELOPED_BY' => 'Zero Technology',
    'PER_PAGE' => 10,
    'PAYMENT_METHODS' => ['CASH' => 'Cash', 'CHEQUE' => 'Cheque', 'CARD' => 'Card', 'ONLINE' => 'Online'],
    'DISCOUNT_TYPE' => ['FLAT' => 'Flat', '%' => '%'],
    'PAYMENT_STATUS' => ['PARTIALLY_PAID' => 'Partially paid', 'UNPAID' => 'Unpaid', 'PENDING' => 'Pending', 'CANCELLED' => 'Cancelled', 'PAID' => 'Paid'],
    "SITE_LOGO_PATH" => "public" . DIRECTORY_SEPARATOR . "logo" . DIRECTORY_SEPARATOR,
    "SITE_LOGO_URI" => "storage" . DIRECTORY_SEPARATOR . "logo" . DIRECTORY_SEPARATOR,
];
