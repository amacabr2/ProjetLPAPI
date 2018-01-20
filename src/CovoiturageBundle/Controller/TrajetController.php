<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Localisation;
use CovoiturageBundle\Entity\Trajet;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use UserBundle\Helper\ControllerHelper;

class TrajetController extends Controller {

    use ControllerHelper;

    /**
     * @Rest\Get(path="/trajets", name="covoiturage_trajets_index")
     * @Rest\View(serializerGroups={"trajet_list", "user_trajet", "localisation_always", "vehicule_always", "energie_always", "assurance_always", "etat_always"})
     *
     * @return Trajet[]
     */
    public function indexAction() {
        return $this->getDoctrine()->getRepository('CovoiturageBundle:Trajet')->findAll();
    }

    /**
     * @Rest\Get(path="/trajets/{id}", name="covoiturage_trajets_show")
     * @Rest\View(serializerGroups={"trajet_detail", "user_trajet", "localisation_always",  "vehicule_always", "energie_always", "assurance_always", "etat_always"})
     *
     * @param Trajet $trajet
     * @return Trajet
     */
    public function showAction(Trajet $trajet) {
        return $trajet;
    }

    /**
     * @Rest\Post(path="/trajets", name="covoiturage_trajets_create")
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     *
     * @param Trajet $trajet
     * @return Trajet
     */
    public function addAction(Trajet $trajet) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($trajet);
        $em->flush();

        return $trajet;
    }

    /**
     * @Rest\Put(path="/trajets/{id}", name="covoiturage_trajets_update")
     */
    public function updateAction() {

    }

    /**
     * @Rest\Post(path="/trajets/rejoindre", name="covoiturage_trajets_rejoindre")
     * @Rest\View(statusCode=Response::HTTP_OK)
     *
     * @param Request $request
     * @return Response
     */
    public function joinTrajetAction(Request $request) {
        $em = $this->getDoctrine();
        /** @var Trajet $trajet */
        $trajet = $em->getRepository('CovoiturageBundle:Trajet')->find($request->get('trajet_id'));
        /** @var User $user */
        $user = $em->getRepository('UserBundle:User')->find($request->get('user_id'));
        /** @var Localisation $localisation */
        $localisation = Localisation::jsonDeserialize($request->get('localisation'));

        $trajet->addLocalisation($localisation);
        $trajet->addUser($user);
        $em->getManager()->persist($trajet);
        $em->getManager()->flush();

        return new Response($this->serialize(['message' => 'Vous avez été ajouté au trajet']), Response::HTTP_CREATED);
    }

    /**
     * @Rest\Delete(path="/trajets/{id}")
     */
    public function deleteAction() {

    }
}
