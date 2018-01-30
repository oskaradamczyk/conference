<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 20.12.17
 * Time: 12:03
 */

namespace AppBundle\Topic;


use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Gos\Bundle\WebSocketBundle\Topic\PushableTopicInterface;
use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Ratchet\WebSocket\Version\RFC6455\Connection;

class ConferenceTopic implements TopicInterface, PushableTopicInterface
{
    /**
     * @param Topic        $topic
     * @param WampRequest  $request
     * @param array|string $data
     * @param string       $provider The name of pusher who push the data
     */
    public function onPush(Topic $topic, WampRequest $request, $data, $provider)
    {
        $topic->broadcast($data);
    }
    /**
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $connection->resourceId . " has joined " . $topic->getId()]);
    }

    /**
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $connection->resourceId . " has left " . $topic->getId()]);
    }

    /**=
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     * @param $event
     * @param array $exclude
     * @param array $eligible
     */
    public function onPublish(ConnectionInterface $connection, Topic $topic, WampRequest $request, $event, array $exclude, array $eligible)
    {
        /*
            $topic->getId() will contain the FULL requested uri, so you can proceed based on that
            if ($topic->getId() == "acme/channel/shout")
               //shout something to all subs.
        */
        $topic->broadcast([
            'msg' => $event
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'conference.topic';
    }
}