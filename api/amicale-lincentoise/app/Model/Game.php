<?php
class Game extends AppModel{

    public $primaryKey = 'id';
    public $recursive = 2;

    public $belongsTo = array(
        'Day' => array(
            'className' => 'Day',
            'foreignKey' => 'id_day'
        ),
        'Team1' => array(
            'className' => 'Team',
            'foreignKey' => 'id_team_home'
        ),
        'Team2' => array(
            'className' => 'Team',
            'foreignKey' => 'id_team_away'
        )
    );

}
?>
