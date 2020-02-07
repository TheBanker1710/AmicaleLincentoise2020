<?php
class Team extends AppModel{

    public $primaryKey = 'id';
    public $recursive = 2;

    public $belongsTo = array(
        'Ranking' => array(
            'className' => 'Ranking',
            'foreignKey' => 'id'
        )
    );

    
}
?>
