var ContactForm = function () {

    return {
        
        //Contact Form
        initContactForm: function () {
	        // Validation
	        $("#contact-form").validate({
	            // Rules for form validation
	            rules:
	            {
	                name:
	                {
	                    required: true
	                },
	                email:
	                {
	                    required: true,
	                    email: true
	                },
	                message:
	                {
	                    required: true,
	                    minlength: 10
	                }
	            },
	                                
	            // Messages for form validation
	            messages:
	            {
	                name:
	                {
	                    required: '請輸入你的姓名',
	                },
	                email:
	                {
	                    required: '請輸入你的email',
	                    email: '請輸入正確Email帳號'
	                },
	                message:
	                {
	                    required: '請輸入你的留言'
	                }
	            },
	                                
	            // Ajax form submition                  
	            submitHandler: function(form)
	            {
					if(grecaptcha.getResponse() != ''){

						$(form).ajaxSubmit({
							beforeSend: function()
							{
								$('#contact-form button[type="submit"]').attr('disabled', true);
							},
							success: function()
							{
								$("#contact-form").addClass('submited');
							}
						});
					}else{
						$('.g-recaptcha').after('<em for="recaptcha" class="invalid">請確認你不是機器人</em>')
					}
	            },
	            
	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
        }

    };
    
}();