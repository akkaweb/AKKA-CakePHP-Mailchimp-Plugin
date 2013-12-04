<?php

/*
 * Mailchimp Model
 * 
 * @copyright   AKKA Web Development (http://www.akkaweb.com)
 * @author      Andre Santiago <admin@akkaweb.com>
 * @license     MIT License http://www.opensource.org/licenses/mit-license.php
 * @date        Dec 3, 2013
 */
App::uses('MailchimpAppModel', 'Mailchimp.Model');

class Mailchimp extends MailchimpAppModel{    
    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Your email address is invalid. Please try again!'
            )
        )
    );
}
?>
