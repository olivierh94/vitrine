<?php

namespace QW\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Form\Extension\Core\Type\TextType;
use Symfony\component\Form\Extension\Core\Type\HiddenType;
use Symfony\component\Form\Extension\Core\Type\SubmitType;
use Symfony\component\Form\Extension\Core\Type\TextareaType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QWPresentationBundle:Template:Solid/index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('QWPresentationBundle:Template:Solid/about.html.twig');
    }

    public function contactAction(Request $request)
    {
        $returnMessage = '';
        $form = $this->createFormBuilder()
            ->add('name', null,[
                'label' => 'Votre Nom'
            ])
            ->add('email', null,[
                'label' => 'Votre Email'
            ])
            ->add('subject', null,[
                'label' => 'Sujet'
            ])
            ->add('body', null,[
                'label' => 'Message'
            ])
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()['name'];
            $email = $form->getData()['email'];
            $subject = $form->getData()['subject'];
            $body = $form->getData()['body'];

            $message = (new \Swift_Message($subject))
                ->setFrom($email)
                ->setTo('contact@taxi-idir.fr')
                ->setBody(
                    $this->renderView(
                        'QWPresentationBundle:Template:Solid/emails/contact.html.twig', [
                            'name' => $name,
                            'email' => $email,
                            'subject' => $subject,
                            'body' => $body
                        ]
                    ),
                    'text/html'
                );

                $returnMessage = 'Message envoyé';
            ;

            $this->get('mailer')->send($message);
        }

        return $this->render('QWPresentationBundle:Template:Solid/contact.html.twig', [
            'formContact' => $form->createView(),
            'returnMessage' => $returnMessage
        ]);
    }

    public function zoneAction()
    {
        return $this->render('QWPresentationBundle:Template:Solid/zone.html.twig');
    }

    public function portfolioAction()
    {
        return $this->render('QWPresentationBundle:Template:Solid/portfolio.html.twig');
    }

    public function blogAction()
    {
        return $this->render('QWPresentationBundle:Template:Solid/blog.html.twig');
    }

    public function postAction()
    {
        return $this->render('QWPresentationBundle:Template:Solid/singlePost.html.twig');
    }

    public function projectAction()
    {
        return $this->render('QWPresentationBundle:Template:Solid/singleProject.html.twig');
    }

    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}
