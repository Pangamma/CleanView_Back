function FormValidation(formName){
  this.formName = formName;
};

FormValidation.prototype = {
  constructor: FormValidation,

  emptyFields : function (){
              var isFormNotEmpty = false;
              $('.g-required-input').each(function(){
                var $this = $(this),
                    nameAttr = $this.attr('name')
                    placehlrAttr = $this.attr('placeholder');
                if($this.val() === '' && $this.next(".g-empty-error").length <= 0){
                  $this.addClass('g-input-error');
                  $this.after('<p class="g-empty-error">' + placehlrAttr + ' is required</p>');
                  isFormNotEmpty = true;
                }
                $this.on("click", function(){
                  $this.removeClass('g-input-error');
                  $this.next(".g-empty-error").remove();
                });
              });
              return isFormNotEmpty;
            },

  emailCheck : function (emailName) {
    var regexp = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/,
        element = $('[name="' + emailName + '"]'),
        emailValue = element.val();
    if ( emailValue != '' && !regexp.test(emailValue) && element.next(".g-wrong-email-error").length <= 0){
      console.log("Blah");
      element.addClass('g-input-error');
      element.after('<p class="g-wrong-email-error">This email is not valid.</p>');
      return false;
    }
              element.on("click", function(){
                element.removeClass('g-input-error');
                element.next(".g-wrong-email-error").remove();
              });
              return true;
            },

  passwordValidation : function (passwordField, passwordField2) {
              var pass1 = $('[name="' + passwordField + '"]'),
                  pass2 = $('[name="' + passwordField2 + '"]');
              if(pass1.val() != pass2.val() && pass1.next(".g-same-password-error").length <= 0 && pass1.next(".g-empty-error").length <= 0){
                  pass1.addClass("g-input-error").after('<p class="g-same-password-error">Password fields should be the same.</p>');
                  pass2.addClass("g-input-error").after('<p class="g-same-password-error">Password fields should be the same.</p>');  
                  return false;
              }
              pass1.on("click", function(){
                pass1.removeClass('g-input-error');
                pass1.next(".g-same-password-error").remove();
              });
              pass2.on("click", function(){
                pass2.removeClass('g-input-error');
                pass2.next(".g-same-password-error").remove();
              });
              return true;
            },
  validateWithEmail : function(emailName){
    if(!this.emptyFields()){
      isFormValid = false;
    }
    if(!this.emailCheck(emailName)){
      isFormValid = false;
    }
    return isFormValid;
  },

  validateWithEmailandPassword : function(emailName, password1, password2){
              isFormValid = true;
              if(!this.passwordValidation(password1, password2)){
                isFormValid = false;
              }
              if(!this.emptyFields()){
                isFormValid = false;
              }
              if(!this.emailCheck(emailName)){
                isFormValid = false;
              }
              return isFormValid;
            }

          };          