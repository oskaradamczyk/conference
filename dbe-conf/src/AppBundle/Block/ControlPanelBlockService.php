<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 16:03
 */


namespace AppBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractAdminBlockService;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ControlPanelBlockService
 * @package AppBundle\Block
 */
class ControlPanelBlockService extends AbstractAdminBlockService
{
    /** @var string */
    private $yamlDir;

    /**
     * ControlPanelBlockService constructor.
     * @param string $name
     * @param EngineInterface $templating
     * @param string $yamlDir
     */
    public function __construct(string $name, EngineInterface $templating, string $yamlDir)
    {
        parent::__construct($name, $templating);
        $this->yamlDir = $yamlDir;
    }

    /**
     * @param BlockContextInterface $blockContext
     * @param Response|null $response
     * @return Response
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse($blockContext->getTemplate(), [
            'context' => $blockContext,
            'block' => $blockContext->getBlock(),
            'buttons' => Yaml::parseFile($this->yamlDir)
        ], $response);
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', [
            'keys' => [
                ['number', 'integer', ['required' => true]],
                ['title', 'text', ['required' => false]],
                ['mode', 'choice', [
                    'choices' => [
                        'public' => 'public',
                        'admin' => 'admin',
                    ],
                ]],
            ],
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Panel';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mode' => 'public',
            'title' => 'admin.control_panel.title',
            'template' => ':Admin/Panel:control_panel.html.twig',
        ]);
    }
}
