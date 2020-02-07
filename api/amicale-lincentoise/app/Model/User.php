<?php
  class User extends AppModel{

      var $name = 'User';

      /*public $validate = array(
          'cli_nom' => array(
              'alphaNumeric' => array(
                 'rule' => array('custom', '|^[a-z]+$|'),
                 'required' => true,
                 'message' => 'Veuillez entrer des lettres uniquement'
               )
           ),

           'cli_prenom' => array(
                'alphaNumeric' => array(
                  'rule' => array('custom', '|^[a-z]+$|'),
                  'required' => true,
                    'message' => 'Veuillez entrer des lettres uniquement'
                )
            ),

            'cli_adresse' => array(
               'alphaNumeric' => array(
                   'rule' => 'alphaNumeric',
                   'required' => true,
                   'message' => 'Veuillez entrer des chiffres et des lettres uniquement'
                 )
             ),

             'cli_cp' => array(
                  'alphaNumeric' => array(
                    'rule' => 'numeric',
                    'required' => true,
                    'message' => 'Veuillez entrer des chiffres uniquement'
                  ),
                  'regleCP' => array(
                      'rule' => array('between', 4, 4),
                      'message' => 'Le code postal doit être composé de 4 chiffres'
                  )
              ),

              'cli_localite' => array(
                  'alphaNumeric' => array(
                     'rule' => array('custom', '|^[a-z]+$|'),
                     'required' => true,
                     'message' => 'Veuillez entrer des lettres uniquement'
                   )
               ),

               'cli_telephone' => array(
                    'alphaNumeric' => array(
                      'rule' => 'numeric',
                      'required' => true,
                      'message' => 'Veuillez entrer un numéro de téléphone valide'
                    ),
                    'regleNumeroTelephone' => array(
                        'rule' => array('between', 9, 10),
                        'message' => 'Le numéro de téléphone doit être composé entre 9 et 10 chiffres'
                    )
                ),

                'cli_numero_carte' => array(
                    'alphaNumeric' => array(
                       'rule' => 'numeric',
                       'required' => true,
                       'message' => 'Veuillez entrer un numéro de carte valide'
                     ),
                     'regleNumeroCarte' => array(
                         'rule' => array('between', 16, 16),
                         'message' => 'Le numéro de carte doit être composé de 16 chiffres'
                     )
                 ),

                //  'password' => array(
                //       'alphaNumeric' => array(
                //         'rule' => 'alphaNumeric',
                //         'required' => true,
                //         'message' => 'Veuillez entrer un mot de passe valide'
                //       )
                //   ),
                 //
                 //
                //  'username' => array(
                //       'email' => array(
                //          'rule' => 'email',
                //          'required' => true,
                //          'message' => 'Veuillez entrer un email valide'
                //        )
                //   ),



      );*/

  }
?>
