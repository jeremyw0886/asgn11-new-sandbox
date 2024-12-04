<?php
class Bird extends DatabaseObject {
  // Set the database table name
  static protected $table_name = 'birds';
  
  // Define database columns
  static protected $columns = ['id', 'common_name', 'habitat', 'food', 'conservation_id', 'backyard_tips'];

  // Define object properties that match database columns
  public $id;
  public $common_name;
  public $habitat;
  public $food;
  public $conservation_id;
  public $backyard_tips;

  // Define conservation levels
  public const CONSERVATION_OPTIONS = [
    1 => 'Low concern',
    2 => 'Moderate concern',
    3 => 'High concern',
    4 => 'Extreme concern'
  ];

  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->common_name = $args['common_name'] ?? '';
    $this->habitat = $args['habitat'] ?? '';
    $this->food = $args['food'] ?? '';
    $this->conservation_id = $args['conservation_id'] ?? 1;
    $this->backyard_tips = $args['backyard_tips'] ?? '';
  }

  public function conservation_level() {
    if($this->conservation_id > 0) {
      return self::CONSERVATION_OPTIONS[$this->conservation_id];
    } else {
      return "Unknown";
    }
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->common_name)) {
      $this->errors[] = "Name cannot be blank.";
    }
    if(is_blank($this->habitat)) {
      $this->errors[] = "Habitat cannot be blank.";
    }
    if(is_blank($this->food)) {
      $this->errors[] = "Food cannot be blank.";
    }
    if(!isset(self::CONSERVATION_OPTIONS[$this->conservation_id])) {
      $this->errors[] = "Conservation level must be valid.";
    }

    return $this->errors;
  }
}
?>
