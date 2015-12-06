<?php

namespace SportFunBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SportFunBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
