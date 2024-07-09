<?php

namespace App\Repository;

use App\Entity\User;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SetNewUserRepository
{
    private $entityManager;
    private $hasher;
    private $parameterBag;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher, ParameterBagInterface $parameterBag)
    {
        $this->entityManager = $entityManager;
        $this->hasher = $hasher;
        $this->parameterBag = $parameterBag;
    }

    public function _setNewUserRepo(Request $request): string
    {
        $message_red = '';
        $message_green = '';

        if (!$request->isMethod('POST')) {
            return $message = 'Méthode non autorisée.';
        }

        // Début de la transaction
        $this->entityManager->beginTransaction();

        try {
            $user = new User();
            $user->setIdUser(Uuid::v4());
            $user->setFirstName($request->request->get('firstName'));
            $user->setLastName($request->request->get('lastName'));
            $user->setEmail($request->request->get('email'));

            $password = $request->request->get('password');
            $rePassword = $request->request->get('re-password');

            if ($password !== $rePassword) {
                return $message_red = 'Les mots de passe ne correspondent pas.';
            }

            $user->setPassword($this->hasher->hashPassword($user, $password));
            $user->setPhoneNumber($request->request->get('telephone'));
            $user->setPrivilege($request->request->get('status'));
            $user->setRoles([$request->request->get('privilege')]);
            $user->setAgency($request->request->get('agency'));
            $user->setProvince($request->request->get('province'));
            $user->setUsername($request->request->get('firstName') . $request->request->get('lastName'));

            $photo = $request->files->get('photo');
            if ($photo) {
                $photoFileName = uniqid() . '.' . $photo->guessExtension();
                $photo->move($this->parameterBag->get('photo_directory'), $photoFileName);
                $user->setPhoto($photoFileName);
            }

            $conditions = $request->request->get('conditions');
            if ($conditions !== 'on') {
                return $message_red = 'Veuillez accepter les termes et conditions.';
            } else {
                $user->setConditions($conditions);
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

           
            $this->entityManager->commit();

            
            return $message_green = 'Utilisateur enregistré avec succès.';
        } catch (\Exception $e) {
           
            $this->entityManager->rollback();

           return $message_red = 'Erreur lors de l\'enregistrement de l\'utilisateur : ' . $e->getMessage();
        }
        return $message_red;
    }
}

?>
