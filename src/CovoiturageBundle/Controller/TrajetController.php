<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Localisation;
use CovoiturageBundle\Entity\Trajet;
use CovoiturageBundle\Entity\Vehicule;
use FOS\RestBundle\Controller\Annotations as Rest;
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
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request) {
        $em = $this->getDoctrine();
        $isConducteur = (bool)$request->get('is_conducteur');
        /** @var User $userConducteur */
        $user = $em->getRepository('UserBundle:User')->find($request->get('user'));
        /** @var  Localisation[] localisations */
        $localisations = $request->get('localisations');

        $trajet = new Trajet();
        if ($isConducteur) {
            /** @var Vehicule $vehicule */
            $vehicule = $em->getRepository('CovoiturageBundle:Vehicule')->find($request->get('vehicule'));

            $trajet->setUserConducteur($user);
            $trajet->setNbPlaceRestante($request->get('nb_place_restante'));
            $trajet->setVehicule($vehicule);
        } else {
            $trajet->addUser($user);
        }

        foreach ($localisations as $localisation) {
            $trajet->addLocalisation(Localisation::jsonDeserialize($localisation));
        }

        $em->getManager()->persist($trajet);
        $em->getManager()->flush();

        return new Response($this->serialize(['message' => "Votre tajet a été crée"]), Response::HTTP_CREATED);
    }

    /**
     * @Rest\Post(path="/trajets/rejoindre", name="covoiturage_trajets_rejoindre")
     * @Rest\View(statusCode=Response::HTTP_CREATED)
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
     * @Rest\Delete(path="/trajets/{id}", name="covoiturage_trajets_delete")
     */
    public function deleteAction() {

    }

    /**
     * @Rest\Get(path="/trajets/search/{q}")
     * @Rest\View(serializerGroups={"trajet_detail", "user_trajet", "localisation_always",  "vehicule_always", "energie_always", "assurance_always", "etat_always"})
     *
     * @param Request $request
     * @return mixed
     */
    public function searchAction(Request $request) {
        return $this->getDoctrine()
            ->getRepository("CovoiturageBundle:Trajet")
            ->findAllForSearch($request->get('q'));
    }
}
