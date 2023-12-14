<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserTypeEnum extends Enum
{ 
	//User Types
    const NORMAL = 'normal';
    const GOLD = 'gold';
    const SILVER = 'silver';

    public static function getPriceCountingForType($type)
    {
    	if ($type == self::NORMAL) {
    		return 1.1;
    	}
    	if ($type == self::GOLD) {
    		return 2;
    	}
    	if ($type == self::SILVER) {
    		return 2.5;
    	}

    	return 1;
    }

}
