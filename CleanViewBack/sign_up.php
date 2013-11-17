<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PeerCalendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/stylesheets/style.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body class="b-body b-body--grey">
    <h1 class="b-signup-page-logo">PeerCalendar</h1>
    <div class="b-signup-form">
      
        <div class="b-signup-form__create-account">
          
          <h2 class="b-signup-form__title">Create an Account</h2>
          
          <form id="b-signup-form__form" class="b-signup-form__form" action="add_classes.php">
            <div class="b-signup-form__input-group">
              <input type="text" name="b-signup-form__firstname" class="b-signup-form__firstname g-required-input" placeholder="First Name">
            </div>
            <div class="b-signup-form__input-group">
              <input type="text" name="b-signup-form__lastname" class="b-signup-form__lastname g-required-input" placeholder="Last Name">
            </div>   
            <div class="b-signup-form__input-group">
              <input type="text" name="b-signup-form__email" class="b-signup-form__email g-required-input" placeholder="Email">
            </div>
            <div class="b-signup-form__input-group">
              <input type="password" name="b-signup-form__password" class="b-signup-form__password g-required-input" placeholder="Password">
            </div>  
              <div class="b-signup-form__input-group">
              <input type="password" name="b-signup-form__password-confirm" class="b-signup-form__password-confirm g-required-input" placeholder="Confirm Password">
            </div>  
            <button type="submit" class="b-signup-form__button">Create an Account</button>
          </form>

        </div>  
    
        <div class="b-signup-form__social">
          <h2 class="b-signup-form__title">Or sign up with:</h2>
          <div class="b-signup-form__input-group">
            <a href="#" class="b-signup-form__facebook-link"><img class="b-signup-form__facebook-img" src="assets/images/ico/facebook-icon.svg" alt="facebook icon"></a>
            <a href="#" class="b-signup-form__google-plus-link"><img class="b-signup-form__google-plus-img" src="assets/images/ico/google-plus-icon.svg" alt="google plus icon"></a>
          </div>  
        </div>

      </div>
      <div class="b-footer">
        <div class="b-footer__container b-footer__container--signup-form">
          <p>&copy; PeerCal 2013</p>
        </div>  
      </div>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
      <script>
        $(document).ready(function() {
          $(".b-signup-form__firstname").focus();
          
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

            validateWithEmailandPassword : function(emailName, password1, password2){
              console.log(this.formName);
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

          var signUpForm = new FormValidation('.b-signup-form__form');
              
          $('.b-signup-form__button').click(function (event) {
            event.preventDefault();
            return signUpForm.validateWithEmailandPassword("b-signup-form__email", "b-signup-form__password", "b-signup-form__password-confirm");
          }); 
        });  
      </script>  
   </body>
</html>    