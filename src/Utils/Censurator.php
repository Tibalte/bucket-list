<?php

namespace App\Utils;

class Censurator
{

    const BAN_WORD = ['lutin', 'caramel', 'voila'];
    public function purify(string $textToPurify): string{
       $purifyText = str_ireplace(self::BAN_WORD, '****', $textToPurify);

       return $purifyText;

    }
}