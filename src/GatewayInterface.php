<?php

namespace Phpfox\Model;

/**
 * Class GatewayInterface
 *
 * @package Phpfox\Model
 */
interface GatewayInterface
{
    /**
     * @param mixed $id
     *
     * @return mixed
     * @throws GatewayException
     */
    public function findById($id);
}