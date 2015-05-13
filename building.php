<?php
  header("Content-Type: text/html; charset=utf-8");
 //  include("flat.php");
   
   class Building{
       
       public $house_number;
       public $number_of_floors;
       public $number_of_entrances;
       public $area_adjacent_territory;
       public $number_of_flats;
       public $arr_of_flats;
       public $all_utilities;
       public $inhabitants_in_house;
       
       const STAIRCASE = 20; //electricity consumed in month with a staircase
       const TAX = 5; //tax per 1 m2 territory
       
       function __construct($house_number,$number_of_floors,$number_of_entrances,$number_of_flats,$area_adjacent_territory) {
           
           $this->house_number = $house_number;
           $this->number_of_floors = $number_of_floors;
           $this->number_of_entrances = $number_of_entrances;
           $this->area_adjacent_territory = $area_adjacent_territory;
           $this->number_of_flats = $number_of_flats;
           $this->arr_of_flats = array();
     }
      
       public function add_flats(){
           for($i =0; $i<$this->number_of_flats;$i++){
             $flat = new Flat(mt_rand(1,4),mt_rand(40,70),mt_rand(1,16),mt_rand(1,6),mt_rand(0,2),mt_rand(0,1),$i+1);
             $this->arr_of_flats[] = $flat;
           }
       }
       //calculate utilities from all flats in the building
       public function calculate_all_utilities(){
            for($i =0; $i<count($this->arr_of_flats);$i++){
            $this->all_utilities += $this->arr_of_flats[$i]->calculate_All(); 
         }
         return $this->all_utilities;
       }
       public function calculate_electricity(){
             $total_electricity = $this->number_of_floors*$this->number_of_entrances*self::STAIRCASE;
             return $total_electricity;
       }
       public function calculate_land_tax(){
           $land_tax = $this->area_adjacent_territory*self::TAX;
           return $land_tax;
       }
       public function calculate_inhabitants_in_house(){
           for($i =0; $i<count($this->arr_of_flats);$i++){
            $this->inhabitants_in_house += $this->arr_of_flats[$i]->numberOfPerson; 
           }
           return $this->inhabitants_in_house;
       }
       public function display(){
          if (isset($this->house_number)) {echo "<h3>Информация о доме:</h3>";}
          if (isset($this->house_number)) {echo "Номер дома - ".$this->house_number."<br>";}
          if (isset($this->number_of_floors)) {echo "Количество этажей - ".$this->number_of_floors."<br>";}
          if (isset($this->number_of_entrances)) {echo "Количество подъездов - ".$this->number_of_entrances."<br>";}
          if (isset($this->number_of_flats)) {echo "Количество квартир - ".$this->number_of_flats."<br>";}
          if (isset($this->number_of_flats)) {echo "Количество жильцов - ".$this->calculate_inhabitants_in_house()."<br>";}
          if (isset($this->number_of_flats)) {echo "Сумма комунальных платежей"
              . " со всех квартир - ".$this->calculate_all_utilities()."грн.<br>";}
          if (isset($this->number_of_flats)) {echo "Сумма необходимая для освещения"
              . " лестничных площадок - ".$this->calculate_electricity()."грн.<br>";}
          if (isset($this->number_of_flats)) {echo "Размер налога на землю - ".$this->calculate_land_tax()."грн.<br>";}    
          if (isset($this->area_adjacent_territory)) {echo "Территория, отведенная для дома - ".$this->area_adjacent_territory."м&sup2<br><br>";} 
       }
   }
  /* $build = new Building(50,9,4,144,1000);
   $build->add_flats();
   $build->display();
   $util = $build->calculate_all_utilities();
   echo "Размер коммунальных платежей со всех квартир в этом доме - ".$util."грн.<br>";
   echo "Объем потребляемого электричества для освещения подъездов - ".$build->calculate_electricity()."кВт.<br>";
   echo "Размер налога на землю, отведенной для дома - ".$build->calculate_land_tax()."грн.<br>";    */
?>
