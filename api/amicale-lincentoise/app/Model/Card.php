<?php
class Card extends AppModel{

    public $primaryKey = 'id';
    public $recursive = 2;

    public $belongsTo = array(
        'Player' => array(
            'className' => 'Player',
            'foreignKey' => 'id_player'
        )
    );

}
?>
