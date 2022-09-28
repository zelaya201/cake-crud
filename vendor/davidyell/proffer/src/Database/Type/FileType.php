<?php
declare(strict_types=1);

/**
 * @category Proffer
 * @package FileType.php
 *
 * @author David Yell <neon1024@gmail.com>
 * @when 03/03/15
 *
 */

namespace Proffer\Database\Type;

use Cake\Database\DriverInterface;
use Cake\Database\Type\BaseType;

class FileType extends BaseType
{
    /**
     * Marshalls flat data into PHP objects
     *
     * @param mixed $value Passed UploadedFile instance
     * @return mixed
     */
    public function marshal($value)
    {
        return $value;
    }

    /**
     * Casts given value from a PHP type to one acceptable by a database.
     *
     * @param mixed $value Value to be converted to a database equivalent.
     * @param \Cake\Database\DriverInterface $driver Object from which database preferences and configuration will be extracted.
     * @return mixed Given PHP type casted to one acceptable by a database.
     */
    public function toDatabase($value, DriverInterface $driver)
    {
        return $value;
    }

    /**
     * Casts given value from a database type to a PHP equivalent.
     *
     * @param mixed $value Value to be converted to PHP equivalent
     * @param \Cake\Database\DriverInterface $driver Object from which database preferences and configuration will be extracted
     * @return mixed Given value casted from a database to a PHP equivalent.
     */
    public function toPHP($value, DriverInterface $driver)
    {
        return $value;
    }
}
