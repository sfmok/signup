<?php

namespace App\AuthBundle\Entity;

/**
 * @Entity
 * @Table(name="users")
 */
class User
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @Column(type="string", name="first_name")
     * @var string
     */
    private $firstName;

    /**
     * @Column(type="string", name="last_name")
     * @var string
     */
    private $lastName;

    /**
     * @Column(type="integer")
     * @var int
     */
    private $telephone;

    /**
     * @Column(type="string")
     * @var string
     */
    private $address;

    /**
     * @Column(type="integer", name="house_number")
     * @var int
     */
    private $houseNumber;

    /**
     * @var int
     */
    private $zip;

    /**
     * @Column(type="string")
     * @var string
     */
    private $city;

    /**
     * @Column(type="string")
     * @var string
     */
    private $accountOwner;

    /**
     * @Column(type="string")
     * @var string
     */
    private $iban;

    /**
     * @Column(type="datetime")
     * @var \datetime
     */
    private $createdAt;

    /**
     * @Column(type="string")
     * @var string
     */
    private $paymentDataId;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param int $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * @param int $houseNumber
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * @return int
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param int $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getAccountOwner()
    {
        return $this->accountOwner;
    }

    /**
     * @param string $accountOwner
     */
    public function setAccountOwner($accountOwner)
    {
        $this->accountOwner = $accountOwner;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getPaymentDataId()
    {
        return $this->paymentDataId;
    }

    /**
     * @param string $paymentDataId
     */
    public function setPaymentDataId($paymentDataId)
    {
        $this->paymentDataId = $paymentDataId;
    }
}
