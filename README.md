AKKA-CakePHP-Mailchimp-Plugin
=============================

This Plugin allows CakePHP to interact with the Mailchimp API. Currently I am in the first stages of developing this Plugin and it can only Subscribe a user. However, future version will include much more.

This plugin works with CakePHP 2.x, Mailchimp API 2.x and it also takes advantage of Bootstrap 3.0.

To see a demo of this plugin in action, simply visit `http://www.akkaweb.com` and on the header section you will see the newsletter form.

## Setup

1. Download Plugin from this page
2. Copy the content of this plugin into the `APP/Plugin/Mailchimp`
3. Load it into CakePHP using `CakePlugin::loadAll('Mailchimp')`

## Usage
1. Add the following into the `Config\bootstrap.php` file

  `Configure::write('Mailchimp.apiKey', 'YOUR API KEY');`
  `Configure::write('Mailchimp.default_list_id', 'DEFAULT LIST ID');`
  `Configure::write('Mailchimp.ssl_verifypeer', 'FALSE');`
  `Configure::write('Mailchimp.update_existing', 'TRUE');`
  `Configure::write('Mailchimp.send_welcome', 'TRUE');`
  
2. You can use the predefined form element files (APP/Plugin/Mailchimp/View/Elements/), which uses `Bootstrap 3.0` by doing the following:

  #### Ajax Form (You need to include jQuery)
  Add `<?php echo $this->element('Mailchimp.ajax-subscribe-form', array('id' => 'xxxxxxxx')); ?>` into your view file, where you want your form to appear. Optionally you can pass in your newsletter `id` as depicted above. If you only have one newsletter, you can simply assign the newsletter ID in your `bootstrap` as explained above. 
  
  #### Regular Form
  Add `<?php echo $this->element('Mailchimp.ajax-subscribe-form', array('id' => 'xxxxxxxx')); ?>` into your view file, where you want yoru form to appear. Also, if you only have one newsletter, you can simply assigned the Newsletter ID in your `bootstrap` as explained above. 

3. If you choose not to use the preset element form files, you can create your own form as long as you include `action="/mailchimp/mailchimp/subscribe"` and `method="post"`. Also you need to have a `hidden <input> field`, where you can include your Newsletter Id. This is optional as you can assign your Id in the bootstrap.php file as explained above.

That is pretty much all you have to do to have this working.

