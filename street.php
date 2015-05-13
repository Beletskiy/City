<?php
  header("Content-Type: text/html; charset=utf-8");
  include("building.php");
  
  class Street {
      
      public $street_name;
      public $street_length;
      public $coordinates_start;
      public $coordinates_finish;
      public $number_of_buildings;
      public $arr_of_buildings;
      public $all_area;
      public $number_of_yardmans;
      public $street_utilities;
      
      const YARDMAN_PER_1000M2 = 0.5; 
      
      public function __construct($street_name,$street_length,$coordinates_start,$coordinates_finish,$number_of_buildings){
          $this->street_name = $street_name;
          $this->street_length = $street_length;
          $this->coordinates_start = $coordinates_start;
          $this->coordinates_finish = $coordinates_finish;
          $this->number_of_buildings = $number_of_buildings;
          $this->arr_of_buildings = array();
      }
      public function add_buildings(){
          for($i =0; $i<$this->number_of_buildings;$i++){
             $building = new Building($i+1,mt_rand(1,16),mt_rand(1,6),mt_rand(50,200),mt_rand(1000,2000));
             $building->add_flats();
             $this->arr_of_buildings[] = $building;
           //  $building->display();
           }
      }
      public function calculate_yardmans(){
          for ($i = 0; $i<$this->number_of_buildings;$i++){
              $this->all_area += $this->arr_of_buildings[$i]->area_adjacent_territory;
          }
            $number_of_yardmans = $this->all_area*self::YARDMAN_PER_1000M2/1000;
            return ceil($number_of_yardmans);
      }
      public function calculate_street_utilities(){
          for($i =0; $i<$this->number_of_buildings;$i++){
            $this->street_utilities += $this->arr_of_buildings[$i]->calculate_all_utilities(); 
         }
         return $this->street_utilities;
      }
     public function display(){
          if (isset($this->street_name)) {echo "<h3>Информация об улице:</h3>";}
          if (isset($this->street_name)) {echo "Название улицы - ".$this->street_name."<br>";}
          if (isset($this->street_length)) {echo "Длина улицы - ".$this->street_length."км.<br>";}
         // if (isset($this->coordinates_start)) {echo "Координаты начала улицы - ".$this->coordinates_start."<br>";}
         // if (isset($this->coordinates_finish)) {echo "Координаты конца улицы - ".$this->coordinates_finish."<br>";}
          if (isset($this->number_of_buildings)) {echo "Количество домов - ".$this->number_of_buildings."<br>";}
          if (isset($this->number_of_buildings)) {echo "Необходимое количество дворников "
              . " для данной улицы - ".$this->calculate_yardmans()."чел.<br>";}
          if (isset($this->number_of_buildings)) {echo "Сумма комунальных платежей "
              . " всех квартир данной улицы - ".$this->calculate_street_utilities()."грн.<br><br>";}    
       } 
  }
 /* $street = new Street("Зерновая",2,"5 8","5 10",5);
  $street->add_buildings();
  $yardmans = $street->calculate_yardmans();
  $street_util = round($street->calculate_street_utilities(),2);
  $street->display();
  echo "Необходимое количество дворников - ".$yardmans."<br>";
  echo "Объем коммунальных платежей, которые будут получены со всех домов - ".$street_util."грн.";  */
?>
