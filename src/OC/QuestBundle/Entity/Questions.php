<?php

namespace OC\QuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Questions
 *
 * @ORM\Table(name="questions")
 * @ORM\Entity(repositoryClass="OC\QuestBundle\Repository\QuestionsRepository")
 */
class Questions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="enfants", type="array")
     */
    private $enfants;

    /**
     * @var array
     *
     * @ORM\Column(name="amis", type="array")
     */
    private $amis;

    /**
     * @var string
     * @Assert\Length(
     *      min = 4,
     *      max = 4
     * )
     * @Assert\Range(
     *      min = 1800,
     *      max = 3333,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     * @ORM\Column(name="annee", type="float", length=4)
     */
    private $annee;

    /**
     * @var array
     *
     * @ORM\Column(name="raison", type="array",)
     */
    private $raison;

    /**
     * @var array
     *
     * @ORM\Column(name="inciter", type="array")
     */
    private $inciter;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set enfants
     *
     * @param array $enfants
     *
     * @return Questions
     */
    public function setEnfants($enfants)
    {
        $this->enfants = $enfants;

        return $this;
    }

    /**
     * Get enfants
     *
     * @return array
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Set amis
     *
     * @param array $amis
     *
     * @return Questions
     */
    public function setAmis($amis)
    {
        $this->amis = $amis;

        return $this;
    }

    /**
     * Get amis
     *
     * @return array
     */
    public function getAmis()
    {
        return $this->amis;
    }

    /**
     * Set annee
     *
     * @param string $annee
     *
     * @return Test
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set raison
     *
     * @param array $raison
     *
     * @return Questions
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;

        return $this;
    }

    /**
     * Get raison
     *
     * @return array
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * Set inciter
     *
     * @param array $inciter
     *
     * @return Questions
     */
    public function setInciter($inciter)
    {
        $this->inciter = $inciter;

        return $this;
    }

    /**
     * Get inciter
     *
     * @return array
     */
    public function getInciter()
    {
        return $this->inciter;
    }
}

