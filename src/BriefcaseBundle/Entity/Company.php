<?php

namespace BriefcaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="BriefcaseBundle\Repository\CompanyRepository")
 */
class Company
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=255)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="vat", type="string", length=255)
     */
    private $vat;

    /**
     *
     * @ORM\OneToMany(targetEntity="CourtCase", mappedBy="company")
     */
    private $court_case;

    /**
     *
     * @ORM\OneToMany(targetEntity="Document", mappedBy="company")
     */
    private $document;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->court_case = new ArrayCollection();
        $this->document = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Company
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Company
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return Company
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Company
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set vat
     *
     * @param string $vat
     *
     * @return Company
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return string
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Add courtCase
     *
     * @param \BriefcaseBundle\Entity\CourtCase $courtCase
     *
     * @return Company
     */
    public function addCourtCase(\BriefcaseBundle\Entity\CourtCase $courtCase)
    {
        $this->court_case[] = $courtCase;

        return $this;
    }

    /**
     * Remove courtCase
     *
     * @param \BriefcaseBundle\Entity\CourtCase $courtCase
     */
    public function removeCourtCase(\BriefcaseBundle\Entity\CourtCase $courtCase)
    {
        $this->court_case->removeElement($courtCase);
    }

    /**
     * Get courtCase
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourtCase()
    {
        return $this->court_case;
    }

    /**
     * Add document
     *
     * @param \BriefcaseBundle\Entity\Document $document
     *
     * @return Company
     */
    public function addDocument(\BriefcaseBundle\Entity\Document $document)
    {
        $this->document[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \BriefcaseBundle\Entity\Document $document
     */
    public function removeDocument(\BriefcaseBundle\Entity\Document $document)
    {
        $this->document->removeElement($document);
    }

    /**
     * Get document
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocument()
    {
        return $this->document;
    }
}
