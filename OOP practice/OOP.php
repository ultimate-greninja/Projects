<?php
    class Weapons{
        public $weapon;
        public $damage;
        public $attack_speed;
        public $attack_type;

        public function __construct($weapon,$damage,$attack_speed,$attack_type){
            $this->weapon = $weapon;
            $this->damage = $damage;//high medium low
            $this->attack_speed = $attack_speed;//high medium low
            $this->attack_type = $attack_type;
        }

        public function description(){
            echo "This is a {$this->weapon} that does {$this->damage} amount of damage with a {$this->attack_speed} attack speed, it deals damages through {$this->attack_type}.\n";
        }
        public function name(){
            echo "{$this->weapon}";
        }
    }
    $scythe = new Weapons("Scythe","high","low","piercing or slicing");
    $meteor_hammer = new Weapons("Meteor Hammer","high","medium","blunt force");
    
    $scythe->description();
    $meteor_hammer->description();

    echo get_class($scythe);
    echo get_class($meteor_hammer);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mystyles.css">
    <title><?php $scythe->name()?></title>
</head>
<body>
</body>
</html>