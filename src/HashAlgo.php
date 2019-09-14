<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Stringify;

use ElegantBro\Interfaces\Stringify;
use Exception;
use InvalidArgumentException;

final class HashAlgo implements Stringify
{
    /**
     * @var Stringify
     */
    private $algo;

    public static function md5(): HashAlgo
    {
        return new HashAlgo(
            new Just('md5')
        );
    }

    public function __construct(Stringify $algo)
    {
        $this->algo = $algo;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function asString(): string
    {
        $str = $this->algo->asString();
        if (!in_array($str, hash_algos(), true)) {
            throw new InvalidArgumentException('Unsupported algo ' . $str);
        }

        return $str;
    }
}
