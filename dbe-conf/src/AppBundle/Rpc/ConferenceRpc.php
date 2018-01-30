<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 20.12.17
 * Time: 14:01
 */

namespace AppBundle\Rpc;

use Ratchet\ConnectionInterface;
use Gos\Bundle\WebSocketBundle\RPC\RpcInterface;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;

class ConferenceRpc implements RpcInterface
{
    /**
     * @param ConnectionInterface $connection
     * @param WampRequest $request
     * @param $params
     * @return array
     */
    public function sum(ConnectionInterface $connection, WampRequest $request, $params)
    {
        return array("result" => array_sum($params));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'streaming.rpc';
    }
}