<?php
/*
 * This file is part of the SimpleSamlBundle.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sgomez\Bundle\SimpleSamlBundle\Security;

class SimpleSamlAuth
{
    private $auth;

    public function __construct($provider)
    {
        $this->auth = new \SimpleSAML_Auth_Simple($provider);
    }

    public function getAuth()
    {
        return $this->auth;
    }
}
