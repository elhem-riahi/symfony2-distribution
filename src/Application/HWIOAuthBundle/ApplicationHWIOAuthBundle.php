<?php

namespace Application\HWIOAuthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationHWIOAuthBundle extends Bundle
{
    /**
     * extends HWIOAuthBundle
     */
    public function getParent()
    {
        return 'HWIOAuthBundle';
    }
}
