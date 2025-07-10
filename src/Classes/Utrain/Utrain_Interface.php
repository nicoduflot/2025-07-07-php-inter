<?php
namespace App\Utrain;
interface Utrain_Interface{
    public const PRIXABO = 15;
    public function getNomUtilisateur();
    public function setPrixAbo();
    public function getPrixAbo();
}