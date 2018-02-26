<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 05/11/17
 * Time: 11:33
 */

namespace UserBundle\Helper;

use CovoiturageBundle\Entity\Localisation;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use UserBundle\Entity\Formation;
use UserBundle\Entity\User;
use UserBundle\Exception\BadRegistrationException;

trait ControllerHelper {

    /**
     * Data serializing via JMS serializer.
     *
     * @param mixed $data
     *
     * @return string JSON string
     */
    public function serialize($data) {
        $context = new SerializationContext();
        $context->setSerializeNull(true);
        return $this->get('jms_serializer')->serialize($data, 'json', $context);
    }

    /**
     * @param  Request $request
     * @param  FormInterface $form
     * @throws BadRequestHttpException
     */
    public function processForm(Request $request, FormInterface $form) {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            throw new BadRequestHttpException();
        }
        $form->submit($data);
    }

    /**
     * @param FormInterface $form
     * @return array
     */
    public function getErrorsFromForm(FormInterface $form): array {
        $errors = [];

        foreach ($form->getErrors() as $key => $error) {
            $template = $error->getMessageTemplate();
            $parameters = $error->getMessageParameters();

            foreach ($parameters as $var => $value) {
                $template = str_replace($var, $value, $template);
            }
            $errors[$key] = $template;
        }

        foreach ($form->all() as $childform) {
            if ($childform instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childform)) {
                    $errors[$childform->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }

    /**
     * @param User $user
     * @param Request $request
     * @param bool $isNew
     * @return User
     */
    public function buildUser(User $user, Request $request, bool $isNew): User {
        $user->setPrenom($request->get("prenom"));
        $user->setNom($request->get("nom"));
        $user->setCivilite($request->get("civilite"));
        $user->setDateNaissance($request->get("dateNaissance"));
        $user->setTelFixe($request->get("telFixe"));
        $user->setTelPortable($request->get("telPortable"));
        $user->setFichier($request->get("fichier"));
        $user->setNewsletter($request->get("newsletter"));
        $user->setPresentation($request->get("presentation"));
        $user->setFormation($this->buildFormation($request));
        $user->setLocalisation($this->buildLocalisation($request));

        if ($isNew) {
            $user->setCreatedAt();
        } else {
            $user->setUpdatedAt();
        }

        return $user;
    }

    /**
     * @param Request $request
     * @return Localisation
     */
    public function buildLocalisation(Request $request): Localisation {
        $localisation = new Localisation();
        $loc = $request->get("localisation");
        $localisation->setAdresse($loc["adresse"]);
        $localisation->setVille($loc["ville"]);
        $localisation->setCodePostal($loc["codePostal"]);
        return $localisation;
    }

    /**
     * @param Request $request
     * @return Formation
     */
    private function buildFormation(Request $request): Formation {
        $for = $request->get("formation");
        $formation = new Formation();
        $formation->setName($for['name']);
        return $formation;
    }

    /**
     * Set base HTTP headers.
     *
     * @param Response $response
     *
     * @return Response
     */
    private function setBaseHeaders(Response $response) : Response {
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}