<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Localisation;
use CovoiturageBundle\Entity\Trajet;
use CovoiturageBundle\Entity\Vehicule;
use CovoiturageBundle\Exception\AlreadyExistingDriverException;
use CovoiturageBundle\Exception\NoPlaceInVehiculeException;
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
        $user = $em->getRepository('UserBundle:User')->find($request->get('user_id'));
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

        return $this->setBaseHeaders(new Response($this->serialize(['message' => "Votre trajet a été crée"]), Response::HTTP_CREATED));
    }

    /**
     * @Rest\Post(path="/trajets/rejoindre", name="covoiturage_trajets_rejoindre")
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     *
     * @param Request $request
     * @return Response
     * @throws NoPlaceInVehiculeException
     * @throws AlreadyExistingDriverException
     */
    public function joinTrajetAction(Request $request) {
        $em = $this->getDoctrine();
        $isConducteur = (bool)$request->get('is_conducteur');
        /** @var Trajet $trajet */
        $trajet = $em->getRepository('CovoiturageBundle:Trajet')->find($request->get('trajet_id'));
        /** @var User $user */
        $user = $em->getRepository('UserBundle:User')->find($request->get('user_id'));
        /** @var Localisation $localisation */
        $localisation = Localisation::jsonDeserialize($request->get('localisation'));
        $nbrUsersInTrajet = $trajet->getUsers();

        if ($isConducteur) {
            if ($this->noConducteurForThisTrajet($trajet)) {
                /** @var Vehicule $vehicule */
                $vehicule = $em->getRepository('CovoiturageBundle:Vehicule')->find($request->get('vehicule'));
                $nbrPlaceInVehicule = $request->get('nb_place_restante');

                if ($nbrPlaceInVehicule > $nbrUsersInTrajet ) {
                    $trajet->setUserConducteur($user);
                    $trajet->setNbPlaceRestante($nbrPlaceInVehicule - $nbrUsersInTrajet);
                    $trajet->addLocalisation($localisation);
                    $trajet->setVehicule($vehicule);
                } else {
                    throw new NoPlaceInVehiculeException("Il y a plus d'utilisateurs que de places dans le vehicule pour ce trajet");
                }
            } else {
                throw new AlreadyExistingDriverException("Il y a déjà un conducteur pour se trajet");
            }
        } else {
            $nbrPlaceInVehicule = $trajet->getNbPlaceRestante();

            if ($nbrPlaceInVehicule > 0) {
                $trajet->addUser($user);
                $trajet->addLocalisation($localisation);
                $trajet->setNbPlaceRestante($nbrPlaceInVehicule - 1);
            } else {
                throw new NoPlaceInVehiculeException("Il n'y a plus de place dans le vehicule");
            }
        }

        $em->getManager()->persist($trajet);
        $em->getManager()->flush();

        $message = 'Vous avez été ajouté au trajet ' . ($isConducteur ? 'antant que conducteur' : 'antant que passagé');
        return $this->setBaseHeaders(new Response($this->serialize(['message' => $message]), Response::HTTP_CREATED));
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

    /**
     * @param Trajet $trajet
     * @return bool
     */
    private function noConducteurForThisTrajet(Trajet $trajet): bool {
        return $trajet->getUserConducteur() == null;
    }
}
