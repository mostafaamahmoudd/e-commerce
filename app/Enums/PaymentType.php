<?php

namespace App\Enums;

enum PaymentType: string
{
    case VISA = 'visa';
    case MASTERCARD = 'mastercard';
    case MEEZA = 'meeza';
}
