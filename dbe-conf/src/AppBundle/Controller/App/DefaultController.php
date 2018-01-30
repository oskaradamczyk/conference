<?php

namespace AppBundle\Controller\App;

use AppBundle\Entity\Slide;
use AppBundle\Form\GuestType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller\App
 */
class DefaultController extends Controller
{
    /**
     * @return Response
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render(':Default:index.html.twig');
    }

    /**
     * @return Response
     * @Route("/presenter", name="presenter")
     */
    public function presenterAction()
    {
        return $this->render(':Default:presenter.html.twig');
    }

    /**
     * @return Response
     * @Route("/question", name="question")
     */
    public function questionAction()
    {
        return $this->render(':Default:question.html.twig');
    }

    /**
     * @return Response
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        $test = new Slide();
        $test->setActive(false);
        dump($this->get('validator')->validate($test));exit;
        return $this->render(':Default:test.html.twig', [
            'form' => $this->createForm(GuestType::class, null, [
                'action' => $this->generateUrl('patch_guest'),
                'method' => Request::METHOD_PUT
            ])->createView()
        ]);
    }
}
