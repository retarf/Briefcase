<?php

namespace BriefcaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="BriefcaseBundle\Repository\DocumentRepository")
 */
class Document
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
     * @ORM\Column(name="ChancellerNumber", type="string", length=255, unique=true)
     */
    private $chancellerNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="court_case", type="string", length=255)
     */
    private $courtCase;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_date", type="string", length=255)
     */
    private $mailDate;

    /**
     * @var string
     *
     * @ORM\Column(name="sender", type="string", length=255)
     */
    private $sender;

    /**
     * @var string
     *
     * @ORM\Column(name="recipient", type="string", length=255)
     */
    private $recipient;

    /**
     * @var string
     *
     * @ORM\Column(name="response_to", type="string", length=255)
     */
    private $responseTo;

    /**
     * @var string
     *
     * @ORM\Column(name="court", type="string", length=255)
     */
    private $court;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255)
     */
    private $file;


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
     * Set chancellerNumber
     *
     * @param string $chancellerNumber
     *
     * @return Document
     */
    public function setChancellerNumber($chancellerNumber)
    {
        $this->chancellerNumber = $chancellerNumber;

        return $this;
    }

    /**
     * Get chancellerNumber
     *
     * @return string
     */
    public function getChancellerNumber()
    {
        return $this->chancellerNumber;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Document
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Document
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set courtCase
     *
     * @param string $courtCase
     *
     * @return Document
     */
    public function setCourtCase($courtCase)
    {
        $this->courtCase = $courtCase;

        return $this;
    }

    /**
     * Get courtCase
     *
     * @return string
     */
    public function getCourtCase()
    {
        return $this->courtCase;
    }

    /**
     * Set mailDate
     *
     * @param string $mailDate
     *
     * @return Document
     */
    public function setMailDate($mailDate)
    {
        $this->mailDate = $mailDate;

        return $this;
    }

    /**
     * Get mailDate
     *
     * @return string
     */
    public function getMailDate()
    {
        return $this->mailDate;
    }

    /**
     * Set sender
     *
     * @param string $sender
     *
     * @return Document
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set recipient
     *
     * @param string $recipient
     *
     * @return Document
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set responseTo
     *
     * @param string $responseTo
     *
     * @return Document
     */
    public function setResponseTo($responseTo)
    {
        $this->responseTo = $responseTo;

        return $this;
    }

    /**
     * Get responseTo
     *
     * @return string
     */
    public function getResponseTo()
    {
        return $this->responseTo;
    }

    /**
     * Set court
     *
     * @param string $court
     *
     * @return Document
     */
    public function setCourt($court)
    {
        $this->court = $court;

        return $this;
    }

    /**
     * Get court
     *
     * @return string
     */
    public function getCourt()
    {
        return $this->court;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Document
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
}

