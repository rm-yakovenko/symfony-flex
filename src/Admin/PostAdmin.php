<?php

declare(strict_types=1);

namespace App\Admin;

use App\Spec\PostSpec;

final class PostAdmin extends AbstractPostAdmin
{
    protected function getQuerySpec()
    {
        return PostSpec::not(
            PostSpec::deleted()
        );
    }
}
