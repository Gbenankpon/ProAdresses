<?php

namespace ProAddress\AppBundle\Controller;

use ProAddress\AppBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Message controller.
 *
 * @Route("admin/message")
 */
class MessageController extends Controller
{
    /**
     * Lists all message entities.
     *
     * @Route("/", name="admin_message_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('ProAddressAppBundle:Message')->findAll();

        return $this->render('message/index.html.twig', array(
            'messages' => $messages,
        ));
    }

    /**
     * Finds and displays a message entity.
     *
     * @Route("/{id}", name="admin_message_show")
     * @Method("GET")
     */
    public function showAction(Message $message)
    {

        return $this->render('message/show.html.twig', array(
            'message' => $message,
        ));
    }
}
