<?php


namespace App\Spec;

use Happyr\DoctrineSpecification\Spec;

class PostSpec extends Spec
{
    public static function active($alias = null)
    {
        return self::not(self::deleted($alias));
    }

    public static function deleted($alias = null)
    {
        return self::isNotNull('deletedAt', $alias);
    }
}
