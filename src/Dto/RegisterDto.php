<?php

namespace App\Dto;


class RegisterDto
{

    public string $email;
    public $password;
    public string $prenom;
    public string $nom;
//    public $dateNaiss;
    public $agreeTerms;
    public $passwordConfirmation;
}

