<?php
  namespace App\Controllers;
  use App\Core\Controller\Controller;

  class menuController extends Controller
  {
   public function index()
   {
       return ['texto'  => 'teste'];
   }
  }
?>