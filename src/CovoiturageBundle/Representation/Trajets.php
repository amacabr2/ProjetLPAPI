<?php
/**
 * Created by PhpStorm.
 * User: antho
 * Date: 19/02/2018
 * Time: 14:01
 */

namespace CovoiturageBundle\Representation;

use JMS\Serializer\Annotation as Serializer;
use Pagerfanta\Pagerfanta;

/**
 * Class Trajets
 * @package CovoiturageBundle\Representation
 *
 */
class Trajets {

    /**
     * @var array|\Traversable
     *
     * @Serializer\Type("array<CovoiturageBundle\Entity\Trajet>")
     * @Serializer\Groups({"trajet_list", "user_trajet", "localisation_always"})
     */
    public $data;


    public $meta;

    public function __construct(Pagerfanta $data) {
        $this->data = $data->getCurrentPageResults();

        $this->addMeta('limit', $data->getMaxPerPage());
        $this->addMeta('current_items', count($data->getCurrentPageResults()));
        $this->addMeta('total_items', $data->getNbResults());
        $this->addMeta('offset', $data->getCurrentPageOffsetStart());
    }

    public function addMeta(string $name, string $value) {
        if (isset($this->meta[$name])) {
            throw new \LogicException(sprintf('This meta already exists. You are trying to override this meta, use the setMeta method instead for the %s meta.', $name));
        }

        $this->setMeta($name, $value);
    }

    public function setMeta($name, $value) {
        $this->meta[$name] = $value;
    }
}