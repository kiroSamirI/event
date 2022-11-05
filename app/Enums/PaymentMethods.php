<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentMethods extends Enum
{
    const COD               = 1;
    const FAWRY             = 2;
    const VISA              = 3;
    const WALLET            = 4;
    const BANK_INSTALLMENTS = 5;
    const VALU              = 6;
    const MOBILE_WALLETS    = 7;
    const AMAN              = 8;

    public static function label($method)
    {
        return match($method) {
            self::COD => translate('COD'),
            self::FAWRY => translate('Fawry'),
            self::VISA => translate('Visa'),
            self::BANK_INSTALLMENTS => translate('Bank Installments'),
            self::VALU => translate('valU'),
            self::MOBILE_WALLETS => translate('valU'),
            self::AMAN => translate('Aman'),
            default => null
        };
    }

    public static function integration($integration)
    {
        return match($integration) {
            self::VISA => 2984049,
            self::BANK_INSTALLMENTS => 2984049,
            self::VALU => 2999934,
            self::MOBILE_WALLETS => 3001624,
            self::AMAN => 3000620,
            default => null
        };
    }

    public static function iframe($integration)
    {
        return match($integration) {
            self::VISA => 672269,
            self::BANK_INSTALLMENTS => 692185,
            self::VALU => 692013,
            self::MOBILE_WALLETS => 672269,
            self::AMAN => 692112,
            default => null
        };
    }
}
