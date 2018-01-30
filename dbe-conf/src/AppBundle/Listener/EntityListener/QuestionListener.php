<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 17:37
 */

namespace AppBundle\Listener\EntityListener;


use AppBundle\Entity\Lecture;
use AppBundle\Entity\Question;
use AppBundle\Factory\LectureFactory;
use AppBundle\Service\LectureService;
use Doctrine\ORM\Mapping as ORM;
use Gos\Bundle\WebSocketBundle\Pusher\PusherInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class QuestionListener
{
    /** @var LectureFactory */
    protected $lFactory;

    /** @var PusherInterface */
    protected $pusher;

    /** @var SerializerInterface */
    protected $serializer;

    /**
     * QuestionListener constructor.
     * @param LectureFactory $lFactory
     * @param PusherInterface $pusher
     * @param SerializerInterface $serializer
     */
    public function __construct(LectureFactory $lFactory, PusherInterface $pusher, SerializerInterface $serializer)
    {
        $this->lFactory = $lFactory;
        $this->pusher = $pusher;
        $this->serializer = $serializer;
    }

    /**
     * @ORM\PostUpdate()
     *
     * @param Question $question
     */
    public function postUpdateHandler(Question $question)
    {
        /** @var LectureService $lService */
        $lService = $this->lFactory->createService();
        $lecture = $lService->getFilteredData(new ParameterBag(['active' => true]))->get('data');
        if (
            $lecture instanceof Lecture
            && $lecture->getQuestions()->contains($question)
        ) {
            $this->pusher->push(['msg' => ['question_updated' => $this->serializer->serialize($question, 'json')]], 'conference_topic');
        }
    }
}