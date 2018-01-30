<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 17:11
 */

namespace AppBundle\Controller\Admin\Main;


use Gos\Bundle\WebSocketBundle\Pusher\PusherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ConferenceController
 * @package AppBundle\Controller\Admin\Conference
 */
class ConferenceController extends Controller
{
    /**
     * @param string $operation
     * @return Response
     * @Route("/conference/{operation}", name="conference_operation")
     * @Method({"POST"})
     */
    public function conferenceOperationAction(string $operation)
    {
        /** @var PusherInterface $pusher */
        $pusher = $this->get('gos_web_socket.zmq.pusher');
        $pusher->push(['msg' => ['action' => $operation]], 'conference_topic');
        return new JsonResponse();
    }
}
