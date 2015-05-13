<?php
header("Content-Type: text/html; charset=utf-8");
   include("street.php");
   
  class Town{
      
     public $town_name;
     public $foundation_year;
     public $coordinates;
     public $number_of_streets;
     public $arr_of_streets;
     public $budget;
     public $population;
     
     public function __construct($town_name, $foundation_year, $coordinates, $number_of_streets){
         
             $this->town_name = $town_name;
             $this->foundation_year = $foundation_year;
             $this->coordinates = $coordinates;
             $this->number_of_streets = $number_of_streets;
             $this->arr_of_streets = array();
     }
     
     public function add_streets(){
         
        for($i =0; $i<$this->number_of_streets;$i++){
             $street = new Street(self::rand_street(),mt_rand(2,15),mt_rand(50,60),mt_rand(50,60),mt_rand(1,50));
             $street->add_buildings();
             $this->arr_of_streets[] = $street;
           }
         
     } 
     public function rand_street(){
         
         $rand_name = mt_rand(1,5);
         switch($rand_name) {
                 case 1: $street_name = "Зерновая"; return $street_name; break;
                 case 2: $street_name = "Морозова"; return $street_name; break;
                 case 3: $street_name = "Полевая"; return $street_name; break;
                 case 4: $street_name = "Киргизская"; return $street_name; break;
                 case 5: $street_name = "Каштановая"; return $street_name; break;
          }
     }
     public function calculate_budget(){
         
        for($i = 0; $i<$this->number_of_streets;$i++){
            for ($j= 0; $j<$this->arr_of_streets[$i]->number_of_buildings;$j++){
                  $this->budget += $this->arr_of_streets[$i]->arr_of_buildings[$j]->calculate_land_tax();
            }
        } 
        return $this->budget; 
     }
     public function calculate_population(){
         
        for ($i = 0; $i<$this->number_of_streets;$i++){
            for ($j = 0; $j<$this->arr_of_streets[$i]->number_of_buildings;$j++){
                $this->population += $this->arr_of_streets[$i]->arr_of_buildings[$j]->calculate_inhabitants_in_house();
                }
            }
        return $this->population;
     }
        
     
     public function display(){
          if (isset($this->town_name)) {echo "<h3>Информация о городе:</h3>";}
          if (isset($this->town_name)) {echo "Название города - ".$this->town_name."<br>";}
          if (isset($this->foundation_year)) {echo "Год основания - ".$this->foundation_year."г.<br>";}
          //if (isset($this->coordinates)) {echo "Координаты города - ".$this->coordinates."<br>";}
          if (isset($this->number_of_streets)) {echo "Количество улиц - ".$this->number_of_streets."<br>";}
          if (isset($this->number_of_streets)){echo "Бюджет города: ".$this->calculate_budget()."грн.<br>";}
          if (isset($this->number_of_streets)){echo "Количество жителей в городе: ".$this ->calculate_population()."чел.<br><br>";}
     }
  }
 /* $town = new Town("Харьков",1654,"50 50",3);
  echo $town->display();
  $town->add_streets();
  echo "Бюджет города: ".$town->calculate_budget()."грн.<br>";
  echo "Количество жителей в городе: ".$town ->calculate_population()."чел."; */
?>
