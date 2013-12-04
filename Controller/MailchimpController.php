<?php

/*
 * Mailchimp Controller
 * 
 * @copyright   AKKA Web Development (http://www.akkaweb.com)
 * @author      Andre Santiago <admin@akkaweb.com>
 * @license     MIT License http://www.opensource.org/licenses/mit-license.php
 * @date        Dec 3, 2013
 */
App::uses('MailchimpAppController', 'Mailchimp.Controller');

class MailchimpController extends MailchimpAppController{
    public $uses = array('Mailchimp.Mailchimp');
    public $paginate = array();
    public $sucess_msg = 'Thank you! You have been successfully subscribed into our newsletter!';
    public $failule_msg = 'Our system has encountered an issue submitted your request. Please try again!';
    protected $_update_existing;
    protected $_send_welcome;
    protected $_id;
    protected $_api_key;
    protected $_list_id;
    protected $_default_list_id;
    protected $_dc;
    
    
    public function beforeFilter(){
        parent::beforeFilter();    
        $this->Auth->allow('subscribe');
        
        $this->_api_key = Configure::read('Mailchimp.apiKey');
        $this->_update_existing = Configure::read('Mailchimp.update_existing');
        $this->_send_welcome = Configure::read('Mailchimp.send_welcome');
        $this->_default_list_id = Configure::read('Mailchimp.default_list_id');        
        
        $opts['ssl_verifypeer'] = Configure::read('Mailchimp.ssl_verifypeer');
        
        App::import('Vendor', 'Mailchimp.Mailchimp');
        $this->Mailchimp = new Mailchimp($this->_api_key, $opts);
    }
    
    public function admin_index(){
        //$this->set('admin', $this->Mailchimp->call('lists/list', null));
    }
    
    /*
     * This action/method can be called by any form to subscribe an user
     * 
     * @method POST
     * @params Any data accepted by Mailchimp ie. fname, lname, email, id, etc
     * @return JSON encoded object if AJAX or redirect if not
     */
    public function subscribe(){  
        if(isset($this->_update_existing) && $this->_update_existing != ''){
            $this->request->data['update_existing'] = $this->_update_existing;
        }
        
        if(isset($this->_send_welcome) && $this->_send_welcome != ''){
            $this->request->data['send_welcome'] = $this->_send_welcome;
        }  
        
        if(!isset($this->request->data['id']) || $this->request->data['id'] == ''){
            $this->request->data['id'] = $this->_id = $this->_default_list_id;
        }
        
        if(!is_array($this->request->data['email'])){
            $this->request->data['email'] = array('email' => $this->request->data['email']);
        }
        
        foreach($this->request->data['email'] as $email){
            if(!isset($email['email']) || $email['email'] == ''){
                $this->Session->setFlash('Please enter your email address to subscribe to our newsletter!', 'default', array('class' => 'alert alert-info'));
                $this->redirect($this->referer());
            }
        }
        
        $result = $this->Mailchimp->call('lists/subscribe', $this->request->data);
        
        if($this->request->is('ajax')){          
            $this->autoRender = false;
            Configure::write('debug', 0);           
                
            if($result){
                $success = array('status' => 'Success', 'msg' => $this->sucess_msg);
                echo json_encode($success);
            }else{
                $failure = array('status' => 'Failure', 'msg' => $this->failule_msg);
                echo json_encode($failure);
            }
        }else{            
            if($result){                
                $this->Session->setFlash($this->sucess_msg, 'default', array('class' => 'alert alert-success'));
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash($this->failure_msg, 'default', array('class' => 'alert alert-error'));
                $this->redirect($this->referer());
            }
        }
    }
    
    public function unsubscribe(){
        
    }
    
    /*
     * Get Mailchimp API Key
     * 
     * @return String
     */
    public function getAPIkey(){
        return $this->_api_key;
    }
    
    /*
     * Get Mailchimp current Newsletter List ID
     * 
     * @return String
     */
    public function getListId(){
        return $this->_id;
    }
    
    /*
     * Gets API data center being used based on API Key
     * 
     * @return String
     */
    public function getDataCenter(){
        if (strstr($this->_api_key,"-")){
            list($key, $this->_dc) = explode("-",$this->_api_key,2);            
        }
        return $this->_dc;
    }
}
?>
