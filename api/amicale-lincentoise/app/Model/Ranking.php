<?php
class Ranking extends AppModel{

    public $primaryKey = 'id';
    public $recursive = 2;

    public $belongsTo = array(
        'Team' => array(
            'className' => 'Team',
            'foreignKey' => 'id_team'
        )
    );


}
?>
