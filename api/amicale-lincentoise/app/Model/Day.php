<?php
class Day extends AppModel{

    public $primaryKey = 'id';
    public $recursive = 2;
    public $hasMany = array(
       'Game' => array(
           'className' => 'Game',
           'foreignKey' => 'id_day',
         )
     );

     public $belongsTo = array(
        'Season' => array(
            'className' => 'Season',
            'foreignKey' => 'id_season'
        ),
        'Cup' => array(
            'className' => 'Cup',
            'foreignKey' => 'cup_type'
        )
    );

}
?>
