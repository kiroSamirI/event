<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TicketStatus extends Enum
{
    const PENDING = "Pending";
    const RESERVED = "Reserved";
    const CANCELED = "Canceled";
    const UNPAIED = "Un Paid";
}
