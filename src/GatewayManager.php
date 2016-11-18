<?php

namespace Phpfox\Model;

use Phpfox\Db\GatewayInterface;

class GatewayManager implements GatewayManagerInterface
{
    /**
     * @var GatewayInterface[]
     */
    protected $gateways = [];

    /**
     * @var string[]
     */
    protected $map = [];

    public function set($id, GatewayInterface $gateway)
    {
        $this->gateways[$id] = $gateway;
        return $this;
    }

    public function findById($id, $value)
    {
        return $this->get($id)->findById($value);
    }

    /**
     * @param string $id
     *
     * @return GatewayInterface
     */
    public function get($id)
    {
        return isset($this->gateways[$id]) ? $this->gateways[$id]
            : $this->gateways[$id] = $this->build($id);
    }

    public function build($id)
    {
        if (!isset($this->map[$id])
            || !class_exists($this->map[$id][0])
        ) {
            throw new GatewayException("gateway `$id` does not exists");
        }

        list($table, $model, $name) = $this->map[$id];

        if (!class_exists($table) || !class_exists($model)) {
            throw new GatewayException("gateway `$id` does not exists");
        }

        return new $table($name, $model);
    }
}