<?php

class Moto
{
   public function Gaz()
   {
       echo "gazy!!!";
   }
}

class Cat extends Moto
{
    public function Gaz()
    {
        echo "mya mya gazy!!!";
    }
}

$moto = new Moto();
$moto->Gaz();

$cat = new Cat();
$cat->Gaz();
