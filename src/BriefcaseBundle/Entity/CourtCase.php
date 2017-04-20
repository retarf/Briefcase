<?php

namespace BriefcaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * CourtCase
 *
 * @ORM\Table(name="court_case")
 * @ORM\Entity(repositoryClass="BriefcaseBundle\Repository\CourtCaseRepository")
 */
class CourtCase
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, unique=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_it_court_case", type="boolean")
     */
    private $isItCourtCase;

    /**
     * @var string
     *
     * @ORM\Column(name="court_case_number", type="string", length=255, nullable=true, unique=true)
     */
    private $courtCaseNumber;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="court_case")
     * @ORM\JoinColumn(name="company", referencedColumnName="id")
     */
    private $company;

    /**
     *
     *@ORM\OneToMany(targetEntity="Document", mappedBy="court_case")
     */
    private $documents;

    public function __construct()
    {
        $this -> documents = new ArrayCollection();
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
     * @return CourtCase
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
     * Set number
     *
     * @param string $number
     *
     * @return CourtCase
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
     * Set description
     *
     * @param string $description
     *
     * @return CourtCase
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isItCourtCase
     *
     * @param boolean $isItCourtCase
     *
     * @return CourtCase
     */
    public function setIsItCourtCase($isItCourtCase)
    {
        $this->isItCourtCase = $isItCourtCase;

        return $this;
    }

    /**
     * Get isItCourtCase
     *
     * @return boolean
     */
    public function getIsItCourtCase()
    {
        return $this->isItCourtCase;
    }

    /**
     * Set courtCaseNumber
     *
     * @param string $courtCaseNumber
     *
     * @return CourtCase
     */
    public function setCourtCaseNumber($courtCaseNumber)
    {
        $this->courtCaseNumber = $courtCaseNumber;

        return $this;
    }

    /**
     * Get courtCaseNumber
     *
     * @return string
     */
    public function getCourtCaseNumber()
    {
        return $this->courtCaseNumber;
    }

    /**
     * Set company
     *
     * @param \BriefcaseBundle\Entity\Company $company
     *
     * @return CourtCase
     */
    public function setCompany(\BriefcaseBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \BriefcaseBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add document
     *
     * @param \BriefcaseBundle\Entity\Document $document
     *
     * @return CourtCase
     */
    public function addDocument(\BriefcaseBundle\Entity\Document $document)
    {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \BriefcaseBundle\Entity\Document $document
     */
    public function removeDocument(\BriefcaseBundle\Entity\Document $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}
