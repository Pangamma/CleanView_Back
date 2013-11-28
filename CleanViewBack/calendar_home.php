<?php
	include('head.php'); 
	
	require_once ('secure/api.php');
	$api = new Api ();

	$email = (isset($_POST["b-login-form__email"]) ? $_POST["b-login-form__email"] : null);
	$password = (isset($_POST["b-login-form__password"]) ? $_POST["b-login-form__password"] : null);
	
	if (!$api->isLoggedIn () && !$api->login($email, $password)) {
		// die after printing a redirect because nothing more is needed
		// by the page.
		echo '<meta http-equiv="refresh" content="0; url=index.php">';
		die ();
	}
?>
    
    <body class="b-body b-body--grey">
        
        <div class="b-header b-header--calendar">
            <div class="g-container">
                
                <h1 class="b-header__logo">PeerCalendar</h1>
                <div class="b-header__profile" style="display: inline-block;">Profile</div> 
                <ul class="b-cal-navlist">
                    <li class="b-cal-navlist__item b-cal-navlist__item--help">Help</li>
                    <li class="b-cal-navlist__item b-cal-navlist__item--settings">Settings</li>
                    <li class="b-cal-navlist__item b-cal-navlist__item--logout"><a href="logout.php">Log out</a></li>
                </ul>
                <ul class="b-button-list b-button-list--cal">
                    <li class="b-button-list__button b-button-list__button--active b-button-list__button--calday">Day</li><!--
                    --><li class="b-button-list__button b-button-list__button--calweek">Week</li><!--
                    --><li class="b-button-list__button b-button-list__button--calmonth">Month</li>
                </ul>
            
            </div>
        </div>
        
        <div class="b-day-dash">
            <div class="b-day-dash__container">
                <div class="b-day-dash__up">
                    <div class="b-day-dash__up-content">
                        <div class="b-day-dash__day-name">Thursday</div>
                        <div class="b-day-dash__day-num">14</div>
                        <div class="b-day-dash__month-year">November, <span class="b-day-dash__year">2013</span></div>    
                    </div>    
                </div>
                <div class="b-day-dash__day b-day-dash__day--active">
                    <div class="b-day-dash__day-content">
                        <div class="b-day-dash__day-name">Friday</div>
                        <div class="b-day-dash__day-num">15</div>
                        <div class="b-day-dash__month-year">November, <span class="b-day-dash__year">2013</span></div>
                        <div class="b-day-dash__time">12:12 pm</div>
                    </div>    
                </div>
                <div class="b-day-dash__down">
                    <div class="b-day-dash__down-content">
                        <div class="b-day-dash__day-name">Saturday</div>
                        <div class="b-day-dash__day-num">16</div>
                        <div class="b-day-dash__month-year">November, <span class="b-day-dash__year">2013</span></div>
                    </div>    
                </div>
            </div>    
        </div>
            
        <div class="b-main-dash">
            <div class="b-sync-block">
                <div class="b-sync-block__container">
                    Main
                </div>    
            </div>
            <div class="b-reminders-block">
                <div class="b-reminders-block__container">
                    Reminders
                </div>    
            </div>        
        </div>
            
        <div class="b-conf-dash">
            <div class="b-conf-dash__container">
                <p>Classes</p>
                <p>Groups</p>
            </div>    
        </div>    
    
    <!--javascript-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script>
        var windowHeight = $(window).height();
            noDashHeight = windowHeight - $('.b-header--calendar').outerHeight();
            dayHeight = (noDashHeight - 15)/3,
            dayContentHeight = $('.b-day-dash__day-content').height(),
            dayContentMargin = (dayHeight - dayContentHeight)/2;
            mainDashBlockHeight = (noDashHeight/2) - 15;
        $('.b-day-dash__container, .b-conf-dash__container').css('height', noDashHeight - 20);
        $('.b-day-dash__day, .b-day-dash__up, .b-day-dash__down').css('height', dayHeight);
        $('.b-day-dash__day-content, .b-day-dash__up-content, .b-day-dash__down-content').css('padding-top', dayContentMargin);
        $('.b-sync-block__container, .b-reminders-block__container').css('height', mainDashBlockHeight);
    </script>

    </body>

</html>        