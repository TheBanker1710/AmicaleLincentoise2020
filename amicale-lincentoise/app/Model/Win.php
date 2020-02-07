<?php
class Win extends AppModel{    

    public $belongsTo = array(
        'Team' => array(
            'className' => 'Team',
            'foreignKey' => 'id_team'
        )
    );


}
?>
