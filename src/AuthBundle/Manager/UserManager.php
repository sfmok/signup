<?php

namespace App\AuthBundle\Manager;

use App\AuthBundle\Api\Api;
use App\AuthBundle\Entity\User;
use Core\DoctrineManager;

class UserManager
{

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function parseDataSignup(User $user, array $data): User
    {
        $user->setFirstName($data['firstname']);
        $user->setLastName($data['lastname']);
        $user->setTelephone($data['telephone']);
        $user->setAddress($data['address']);
        $user->setHouseNumber($data['house_number']);
        $user->setZip($data['zip']);
        $user->setCity($data['city']);
        $user->setAccountOwner($data['account_owner']);
        $user->setIban($data['iban']);
        $user->setPaymentDataId('asas');

        return $user;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getResponseApiPayment(User $user)
    {
        $data = [
            'customerId' => $user->getId(),
            'iban' => $user->getIban(),
            'owner' => $user->getAccountOwner()
        ];

        $result =  Api::postAPI($data);

        return json_decode($result, true);
    }

    /**
     * Save data user using doctrine
     * @param User $user
     */
    public function save(User $user): void
    {
        $em = DoctrineManager::entityManager();
        $em->persist($user);
        $em->flush();
    }
}