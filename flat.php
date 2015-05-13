<?php
header("Content-Type: text/html; charset=utf-8");
  
   class Flat{
       
       var $numberOfRooms;
       var $flatArea;
       var $floor;
       var $numberOfPerson;
       var $numberOfBalcony;
       var $typeOfHeating;
       var $flatNumber;
       const COLD_WATER = 5.172;
       const COLD_WATER_NORM = 11;
       const HOT_WATER = 25.93;
       const HOT_WATER_NORM = 3;
       const RENT = 3; //rent for 1 m2
       const ELECTRICITY = 0.4;
       const HEATING_CENTRAL = 9;
       const HEATING_INDIVIDUAL = 5;
         
       function __construct($numberOfRooms,$flatArea,$floor,$numberOfPerson,$numberOfBalcony,$typeOfHeating,$flatNumber) {
           
           $this->numberOfRooms = $numberOfRooms;
           $this->flatArea = $flatArea;
           $this->floor = $floor;
           $this->numberOfPerson = $numberOfPerson;
           $this->numberOfBalcony = $numberOfBalcony;
           $this->typeOfHeating = $typeOfHeating;
           $this->flatNumber = $flatNumber;
     }
       function calculate_cold_water(){
           $cold_water = $this->numberOfPerson*self::COLD_WATER*self::COLD_WATER_NORM;
           return $cold_water;
       }
       function calculate_hot_water(){
           $hot_water = $this->numberOfPerson*self::HOT_WATER*self::HOT_WATER_NORM;
           return $hot_water;
       }
       function calculate_canalization(){
           $canalization = $this->numberOfPerson*(self::COLD_WATER_NORM+self::HOT_WATER_NORM);
           return $canalization;
       }
       function calculate_rent(){
           $rent = $this->flatArea*self::RENT;
           return $rent;
       }
       function calculate_heating(){
        //   if ($this->typeOfHeating == "Central") {
               if ($this->typeOfHeating == 0) {
               $heating = $this->flatArea*self::HEATING_CENTRAL;
               return $heating;
           }
           else {
               $heating = $this->flatArea*self::HEATING_INDIVIDUAL;
               return $heating;
           }
       }
       function calculate_All(){
           $sum_all = ($this->calculate_cold_water() + $this->calculate_hot_water() + $this->calculate_canalization()
                             + $this->calculate_rent() + $this->calculate_heating());
           return $sum_all;
       }
       function change_person($num){
          $this->numberOfPerson = $num;
        //  return $this->numberOfPerson;  
       }
       function display() {
           if ($this->typeOfHeating == 0){
               $heat_disp = "Центральное";
           }
           else {$heat_disp = "Индивидуальное"; }
          if (isset($this->numberOfRooms))  echo "<h3>Информация о квартире:</h3>";
          if (isset($this->flatNumber)) echo "Номер квартиры - ".$this->flatNumber."<br>";
          if (isset($this->numberOfRooms )) echo "Количество комнат - ".$this->numberOfRooms."<br>";
          if (isset($this->flatArea )) echo "Площадь квартиры - ".$this->flatArea."м&sup2<br>";
          if (isset($this->floor )) echo "Этаж - ".$this->floor."<br>";
          if (isset($this->numberOfPerson )) echo "Количество жильцов - ".$this->numberOfPerson."<br>";
          if (isset($this->numberOfBalcony )) echo "Количество балконов - ".$this->numberOfBalcony."<br>";
          if (isset($this->typeOfHeating)) echo "Тип отопления - ".$heat_disp."<br>";
          if ($this->calculate_All())  echo "Сумма ежемесячного платежа - ".$this->calculate_All()."грн.<br>";
       }
   }
  /* $numRoom = ($_POST['numRoom']);     
   $area = ($_POST['area']);
   $floor = ($_POST['floor']);
   $numPer = ($_POST['numPer']);
   $heat = ($_POST['heat']);
   $balkony = ($_POST['balcony']);
   
   $obj = new Flat($numRoom,$area,$floor,$numPer,$balkony,$heat);
   $obj->display(); */
?>
