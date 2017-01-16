<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BadDomain;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Click;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $clicks = $this->getDoctrine()
            ->getRepository('AppBundle:Click')
            ->findAll();

        $badDomains = $this->getDoctrine()
            ->getRepository('AppBundle:BadDomain')
            ->findAll();

        $form = $this->createFormBuilder(new BadDomain())
            ->add('name', 'Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Domain: '))
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('label' => 'Add'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleForm($form);
        }

        return $this->render('default/index.html.twig', ['clicks' => $clicks, 'domains' => $badDomains, 'form' => $form->createView()]);
    }

    private function handleForm($form){
        $em = $this->getDoctrine()->getEntityManager();

        $domain = $form->getData();

        $existing = $this->getDoctrine()
            ->getRepository('AppBundle:BadDomain')
            ->findOneBy(['name' => $domain->getName()]);

        if(!$existing)
        {
            $em->persist($domain);
            $em->flush();

            return true;
        }

        return false;
    }

    /**
     * @Route("/success/{id}", name="success")
     */
    public function successAction($id)
    {
        return $this->render('default/success.html.twig', ['id' => $id]);
    }

    /**
     * @Route("/error/{id}", name="error")
     */
    public function errorAction($id)
    {
        return $this->render('default/error.html.twig', ['id' => $id]);
    }

    /**
     * @Route("/click/{param1}/{param2}", name="click", requirements={"param1": "\d+", "param2": "\d+"})
     */
    public function clickHandleAction($param1, $param2)
    {
        $generatedId = $this->getDoctrine()
            ->getRepository('AppBundle:Click')
            ->findHighestId() + 1;

        if(isset($_SERVER['HTTP_REFERER'])){
            $existingClick = $this->getDoctrine()
                ->getRepository('AppBundle:Click')
                ->findOneByKey($_SERVER['HTTP_REFERER'] . $param1);

            $em = $this->getDoctrine()->getManager();

            if(!$existingClick){
                $click = new Click($generatedId, $_SERVER);

                $click->setParam1($param1);
                $click->setParam2($param2);

                $em->persist($click);
                $em->flush();

                return $this->redirect('/success/' . $generatedId);
            }else{
                $existingClick->setError($existingClick->getError() + 1);

                $bad = $this->getDoctrine()
                    ->getRepository('AppBundle:BadDomain')
                    ->findOneBy(['name' => $_SERVER['HTTP_REFERER']]);

                if($bad){
                    $existingClick->setIsBadDomain(true);
                }

                $em->persist($existingClick);
                $em->flush();

                return $this->redirect('/error/' . $existingClick->getId());
            }
        }else{
            return $this->redirect('/');
        }
    }
}
