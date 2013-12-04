<div class="newsletter-box">
    <div id="newsletter-msg"></div>
    <form class="form-inline" role="form" id="newsletter-signup">
        <div class="form-group">
            <input type="text" name="email" class="form-control input-sm" id="email" placeholder="Sign up to our newsletter">
            <input type="hidden" name="id" class="form-control input-sm" id="id" value="<?php if(isset($id)){echo $id;} ?>">
        </div>
        <button type="submit" class="btn btn-warning btn-sm nl-signup">Sign Up</button>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('form#newsletter-signup').submit(function(e){
            e.preventDefault()

            var email = $(this).find('input#email').val();
            var id = $(this).find('input#id').val();

            if(email == ''){
                $(this).find('input#email').css('border-color','red');
                return false;
            }else{
                var data = {id:id,email:email};

                $.ajax({
                    url: "/mailchimp/mailchimp/subscribe",
                    type:"POST",
                    data:data,
                    dataType:'JSON',
                    success: function(result){
                        if(result.status == "Success"){
                            $('form#newsletter-signup').hide();
                            $('#newsletter-msg').addClass('label label-success').html(result.msg).show();
                        }else{
                            $('form#newsletter-signup input#email').css('border-color','red');                        
                            $('#newsletter-msg').addClass('label label-danger').html(result).show();
                        }
                        return false;                    
                    },
                    error: function(){
                        $('form#newsletter-signup input#email').css('border-color','red');
                        $('#newsletter-msg').addClass('label label-danger').html("There has been an error processing your request. Please try again!").show();
                        return false;
                    }
                });            
            }        
        });
        
        $('form#newsletter-signup input#email').focus(function(){
            $(this).css('border-color','green');
            $('#newsletter-msg').html("");
        });
    });
</script>