<?php
class News extends AppModel{

    public $primaryKey = 'id';
    public $recursive = 2;

    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'author_id'
        )
    );

}
?>
