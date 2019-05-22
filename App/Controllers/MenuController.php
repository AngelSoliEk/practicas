<?php
  use App\Core\Controller\Controller;
  class MenuController extends Controller
  {
    public function __construct() {
    }
   public function index()
   {
       return ['texto'  => 'teste'];
   }
  }
?>