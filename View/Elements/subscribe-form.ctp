<div class="newsletter-box">
    <div id="newsletter-msg"></div>
    <form class="form-inline" role="form" id="newsletter-signup" action="/mailchimp/mailchimp/subscribe" method="post">
        <div class="form-group">
            <input type="text" name="email" class="form-control input-sm" id="email" placeholder="Sign up to our newsletter">
            <input type="hidden" name="id" class="form-control input-sm" id="id" value="<?php if(isset($id)){echo $id;} ?>">
        </div>
        <button type="submit" class="btn btn-warning btn-sm nl-signup">Sign Up</button>
    </form>
</div>