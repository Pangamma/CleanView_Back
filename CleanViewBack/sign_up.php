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
          
          <form class="b-signup-form__form" action="add_classes.php" method="post">
            <div class="b-signup-form__input-group">
              <input type="text" name="b-signup-form__firstname" placeholder="First Name">
            </div>
            <div class="b-signup-form__input-group">
              <input type="text" name="b-signup-form__lastname" placeholder="Last Name">
            </div>   
            <div class="b-signup-form__input-group">
              <input type="text" name="b-signup-form__email" placeholder="Email">
            </div>
            <div class="b-signup-form__input-group">
              <input type="text" name="b-signup-form__username" placeholder="Username">
            </div>  
            <div class="b-signup-form__input-group">
              <input type="password" name="b-signup-form__password" placeholder="Password">
            </div>  
              <div class="b-signup-form__input-group">
              <input type="password" name="b-signup-form__password-confirm" placeholder="Confirm Password">
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
          $(".b-signup-form__name").focus();
        });  
      </script>  
   </body>
</html>    