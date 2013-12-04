AKKA-CakePHP-Mailchimp-Plugin
=============================

This Plugin allows CakePHP to interact with the Mailchimp API. Currently I am in the first stages of developing this Plugin and it can only Subscribe a user. However, future version will include much more.

This plugin works with CakePHP 2.x, Mailchimp API 2.x and it also takes advantage of Bootstrap 3.0.

## Setup

1. Download Plugin here
2. Copy the content of this plugin into the `APP/Plugin/Mailchimp`
3. Looad it into CakePHP using `CakePlugin::loadAll('Mailchimp')`

## Usage
1. Add the following into the `Config\bootstrap.php`
  `Configure::write('Mailchimp.apiKey', 'YOUR API KEY');`
  `Configure::write('Mailchimp.default_list_id', 'DEFAULT LIST ID');`
  `Configure::write('Mailchimp.ssl_verifypeer', 'FALSE');`
  `Configure::write('Mailchimp.update_existing', 'TRUE');`
  `Configure::write('Mailchimp.send_welcome', 'TRUE');`
2. 

