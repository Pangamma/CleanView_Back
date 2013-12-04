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
                <ul class="b-cal-navlist">
                    <li class="b-cal-navlist__item b-cal-navlist__item--logout"><a class="b-cal-navlist__logout-link" href="logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
        
        <div class="b-day-dash">
            <div class="b-day-dash__container">
                <div class="b-day-dash__up" style="text-align: center;">
                    <div class="b-day-dash__up-content">
                        <div class="b-day-dash__day-name b-day-dash__day-name--yesterday">Thursday</div>
                        <div class="b-day-dash__day-num b-day-dash__day-num--yesterday">14</div>
                        <div class="b-day-dash__month-year b-day-dash__month-year--yesterday">November, <span class="b-day-dash__year">2013</span></div>     
                    </div>
                    <i class="b-day-dash__up-ico fa fa-angle-up g-hide" style="color: white; font-size: 10em;"></i>    
                </div>
                <div class="b-day-dash__day b-day-dash__day--active">
                    <div class="b-day-dash__day-content">
                        <div class="b-day-dash__day-name b-day-dash__day-name--today">Friday</div>
                        <div class="b-day-dash__day-num b-day-dash__day-num--today">15</div>
                        <div class="b-day-dash__month-year b-day-dash__month-year--today"><span class="b-day-dash__month--today">November</span>, <span class="b-day-dash__year b-day-dash__year--today">2013</span></div>
                        <div class="b-day-dash__time b-day-dash__time--today">12:12 pm</div>
                    </div>    
                </div>
                <div class="b-day-dash__down">
                    <div class="b-day-dash__down-content" style="text-align: center;">
                        <div class="b-day-dash__day-name b-day-dash__day-name--tomorrow">Saturday</div>
                        <div class="b-day-dash__day-num b-day-dash__day-num--tomorrow">16</div>
                        <div class="b-day-dash__month-year b-day-dash__month-year--tomorrow">November, <span class="b-day-dash__year">2013</span></div>
                        <i class="b-day-dash__down-ico fa fa-angle-down g-hide" style="color: white; font-size: 10em;"></i>
                    </div>    
                </div>
            </div>    
        </div>
            
        <div class="b-main-dash">
            <div class="b-main-dash__container">
                <div class="b-main-dash__controller">
                    <ul class="b-button-list b-button-list--cal">
                        <li class="b-button-list__button b-button-list__button--active b-button-list__button--calday"><a class="b-button-list__link" href="calendar_home.php">All</a></li><!--
                        --><li class="b-button-list__button b-button-list__button--calmonth"><a class="b-button-list__link" href="calendar_home.php">Classes</a></li><!--
                        --><li class="b-button-list__button b-button-list__button--calmonth"><a class="b-button-list__link" href="calendar_home.php">Groups</a></li><!--
                        --><li class="b-button-list__button b-button-list__button--calmonth"><a class="b-button-list__link" href="calendar_home.php">Personal</a></li>
                    </ul>
                    <button class="b-main-dash__add-event-button">Add new event</button>
                </div>
                <div class="b-add-event-block g-hide">
                    <textarea placeholder="What's on your mind?" class="b-add-event-block__textarea"></textarea>    
                    <div class="b-add-event-block__button-group">
                        <button class="b-add-event-block__button b-add-event-block__button--done">Done</button>
                        <button class="b-add-event-block__button b-add-event-block__button--tag" type="button" data-toggle="modal" data-target="#addTagModal">Add Tag</button>
                        <button class="b-add-event-block__button b-add-event-block__button--time" type="button" data-toggle="modal" data-target="#addTimeModal">Add Time</button>
                        <button class="b-add-event-block__button b-add-event-block__button--cancel">Cancel</button>
                    </div>    
                </div>


                <!-- Tag Modal -->
                <div class="modal fade b-modal b-modal--tag" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog b-modal__dialog">
                    <div class="modal-content b-modal__content">
                      <div class="modal-header b-modal__header">
                        <button type="button" class="close b-modal__close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add tag to event</h4>
                      </div>
                      <div class="modal-body b-modal__body">
                        <ul class="b-tag-list">
                            <li class="b-tag-list__item b-tag-list__item--class">
                                CSS360
                            </li> 
                            <li class="b-tag-list__item b-tag-list__item--group">
                                Blah Club
                            </li>
                            <li class="b-tag-list__item b-tag-list__item--group">
                                Derp Club
                            </li>
                            <li class="b-tag-list__item b-tag-list__item--personal b-tag-list__item--active">
                                Personal
                            </li>   
                        </ul>    
                      </div>
                      <div class="modal-footer b-modal__footer">
                        <button type="button" class="btn btn-default b-modal__close-btn" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary b-modal__add" data-dismiss="modal">Add Tag</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                <!-- Time Modal -->
                <div class="modal fade b-modal b-modal--time" id="addTimeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog b-modal__dialog">
                    <div class="modal-content b-modal__content">
                      <div class="modal-header b-modal__header">
                        <button type="button" class="close b-modal__close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add time to event</h4>
                      </div>
                      <div class="modal-body b-modal__body">
                        <select class="b-add-time-select-digit">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                        <select class="b-add-time-select-am-pm">
                            <option>AM</option>
                            <option>PM</option>
                        </select>
                      </div>
                      <div class="modal-footer b-modal__footer">
                        <button type="button" class="btn btn-default b-modal__close-btn" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary b-modal__add" data-dismiss="modal">Add Time</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                    
                <!-- Add Group Modal -->
                <div class="modal fade b-modal b-modal--group" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog b-modal__dialog">
                    <div class="modal-content b-modal__content">
                      <div class="modal-header b-modal__header">
                        <button type="button" class="close b-modal__close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add time to event</h4>
                      </div>
                      <div class="modal-body b-modal__body">
                        <input class="b-modal__add-group-textfield" type="text" placeholder="Name of a group"></input>
                      </div>
                      <div class="modal-footer b-modal__footer">
                        <button type="button" class="btn btn-default b-modal__close-btn" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary b-modal__add" data-dismiss="modal">Add Group</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <ul class="b-day-event-list" style="margin-left: 0; list-style-type: none;">
                    <li class="b-day-event-list-item b-day-event-list-item--class">
                        <div class="b-day-event-list-item__header b-day-event-list-item__header--class"><p class="b-day-event-list-item__header-p"><span class="b-day-event-list-item__class-tag-id">CSS360</span> <span class="b-day-event-list-item__tag-name b-day-event-list-item__tag-name--class">Software Engineering</span></p> <span class="b-day-event-list-item__time b-day-event-list-item__time--class">8:00 AM</span></div>
                        
                        <div class="b-day-event-list-item__container">
                            <p class="b-day-event-list-item__text">Eat breakfast</p>
                            <div class="b-day-event-list__check-mark-wrapper"><img class="b-day-event-list__check-mark g-svg" src="assets/images/ico/check-mark-icon.svg" alt="check icon"></div>
                        </div>    
                        <div class="b-day-event-list-item__button-group">
                            <button class="b-day-event-list-item__flag">Flag</button><!--
                            --><button class="b-day-event-list-item__delete">Delete</button>
                        </div>    
                    </li>
                    <li class="b-day-event-list-item b-day-event-list-item--personal">
                        <div class="b-day-event-list-item__header b-day-event-list-item__header--personal"><p class="b-day-event-list-item__header-p"><span class="b-day-event-list-item__tag-name b-day-event-list-item__tag-name--personal">Personal</span></p> <span class="b-day-event-list-item__time b-day-event-list-item__time--personal">8:00 AM</span></div>
                        
                        <div class="b-day-event-list-item__container">
                            <p class="b-day-event-list-item__text">Eat breakfast</p>
                            <div class="b-day-event-list__check-mark-wrapper"><img class="b-day-event-list__check-mark g-svg" src="assets/images/ico/check-mark-icon.svg" alt="check icon"></div>
                        </div>    
                        <div class="b-day-event-list-item__button-group">
                            <button class="b-day-event-list-item__flag">Flag</button><!--
                            --><button class="b-day-event-list-item__delete">Delete</button>
                        </div>    
                    </li>
                    <li class="b-day-event-list-item b-day-event-list-item--group">
                        <div class="b-day-event-list-item__header b-day-event-list-item__header--group"><p class="b-day-event-list-item__header-p"><span class="b-day-event-list-item__tag-name b-day-event-list-item__tag-name--group">Blah Club</span></p> <span class="b-day-event-list-item__time b-day-event-list-item__time--group">8:00 AM</span></div>
                        
                        <div class="b-day-event-list-item__container">
                            <p class="b-day-event-list-item__text">Eat breakfast</p>
                            <div class="b-day-event-list__check-mark-wrapper"><img class="b-day-event-list__check-mark g-svg" src="assets/images/ico/check-mark-icon.svg" alt="check icon"></div>
                        </div>    
                        <div class="b-day-event-list-item__button-group">
                            <button class="b-day-event-list-item__flag">Flag</button><!--
                            --><button class="b-day-event-list-item__delete">Delete</button>
                        </div>    
                    </li>
                    <li class="b-day-event-list-item b-day-event-list-item--personal b-day-event-list-item--done">
                        <div class="b-day-event-list-item__header b-day-event-list-item__header--personal"><p class="b-day-event-list-item__header-p"><span class="b-day-event-list-item__tag-name b-day-event-list-item__tag-name--personal">Personal</span></p> <span class="b-day-event-list-item__time b-day-event-list-item__time--personal">8:00 AM</span></div>
                        
                        <div class="b-day-event-list-item__container">
                            <p class="b-day-event-list-item__text">Eat breakfast</p>
                            <div class="b-day-event-list__check-mark-wrapper"><img class="b-day-event-list__check-mark g-svg" src="assets/images/ico/check-mark-icon.svg" alt="check icon"></div>
                        </div>    
                        <div class="b-day-event-list-item__button-group">
                            <button class="b-day-event-list-item__flag">Flag</button><!--
                            --><button class="b-day-event-list-item__delete">Delete</button>
                        </div>    
                    </li>
                </ul>    
            </div>    
        </div>
            
        <div class="b-conf-dash">
            <div class="b-conf-dash__container">
                <h2 class="b-conf-dash__title">Your Classes</h2>
                <ul class="b-dash-class-list">
                    <li class="b-dash-class-list__item"><a class="b-dash-class-list__link"><span class="b-dash-class-list__class">CSS360</span><span class="b-dash-class-list__name">Software Engineering</span></a></li>
                    <li class="b-dash-class-list__item"><a class="b-dash-class-list__link"><span class="b-dash-class-list__class">CSS301</span><span class="b-dash-class-list__name">Technical Writing</span></a></li>
                    <li class="b-dash-class-list__item"><a class="b-dash-class-list__link"><span class="b-dash-class-list__class">CSS342</span><span class="b-dash-class-list__name">Introduction Into Algorithms</span></a></li>
                </ul>
                <a class="b-conf-dash__button-link b-conf-dash__button-link--add-class" href="add_classes.php"><button class="b-conf-dash__button b-conf-dash__button--add-class">Add class</button></a>    
                
                <h2 class="b-conf-dash__title">Your Groups</h2>
                <ul class="b-dash-group-list">
                    <li class="b-dash-group-list__item"><a class="b-dash-group-list__link"><span class="b-dash-group-list__name">Blah Club</span></a></li>
                    <li class="b-dash-group-list__item"><a class="b-dash-group-list__link"><span class="b-dash-group-list__name">Derp Club</span></a></li>
                </ul>
                <button class="b-conf-dash__button b-conf-dash__button--add-group" data-toggle="modal" data-target="#addGroupModal">Add group</button>
            </div>    
        </div>    
    
    <!--javascript-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/socket.io/0.9.16/socket.io.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="assets/js/modal.js"></script>
    <!-- TODO: move to external file -->
    <script>
        $(document).ready(function(){
            var windowHeight = $(window).height();
            var noDashHeight = windowHeight - $('.b-header--calendar').outerHeight();
            var dayHeight = (noDashHeight - 15)/3;
            var dayContentHeight = $('.b-day-dash__day-content').height();
            var dayContentMargin = (dayHeight - dayContentHeight)/2;
            var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
            var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
            var newDate = new Date();
            var todaysDate = newDate.getDate();
            var yesterdayDate = new Date();
            var tomorrowDate = new Date();
            
            newDate.setDate();
            yesterdayDate.setDate(todaysDate - 1);
            tomorrowDate.setDate(todaysDate + 1);

            var connection = (function establishConnection(){
                var uid = getCookie("uid");
               $.ajax({
                    type: "GET",
                    url : "http://localhost:38368/" + uid + "/establish",
                    dataType: "jsonp",
                    success : function(data){
                        console.log(data);
                    },
                    error: function(err) { console.log(err); },
                });
                // var socket = io.connect("localhost:38368", {userId: 55});
            })();

            function getCookie(c_name) {
                var c_value = document.cookie;
                var c_start = c_value.indexOf(" " + c_name + "=");
                if (c_start == -1) {
                  c_start = c_value.indexOf(c_name + "=");
                }
                if (c_start == -1) {
                  c_value = null;
                }
                else {
                    c_start = c_value.indexOf("=", c_start) + 1;
                    var c_end = c_value.indexOf(";", c_start);
                    if (c_end == -1) {
                        c_end = c_value.length;
                    }
                    c_value = unescape(c_value.substring(c_start,c_end));
                }
                return c_value;
            }

            // This function displays the current time
            function updateClock(){
                var currentDate = new Date(),
                    currentHours = currentDate.getHours(),
                    currentMinutes = currentDate.getMinutes();
                    timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
                
                currentMinutes = ( currentMinutes < 10 ? "0" : "") + currentMinutes; 
                $('.b-day-dash__time--today').html(currentHours + ":" + currentMinutes + " " + timeOfDay);
            }
            // This function displays and hides up and down day buttons 
            function dayUpDownShowHide(button_str, name_str, month_year_str, num_str, ico_str){
                $(button_str).on( "mouseenter", function(){
                    $(name_str).hide();
                    $(month_year_str).hide();
                    $(num_str).hide();
                    $(ico_str).removeClass('g-hide');
                });
                 $(button_str).on( "mouseleave", function(){
                    $(name_str).show();
                    $(month_year_str).show();
                    $(num_str).show();
                    $(ico_str).addClass('g-hide');
                });
            }

            // This function displays the day
            function setADate(name_str, num_str, month_str, year_str, date){
                $(name_str).html(dayNames[date.getDay()]);
                $(num_str).html(date.getDate());
                $(month_str).html(monthNames[date.getMonth()]);
                $(year_str).html(date.getFullYear());
            }

            // This function displays yesterday, today, and tomorrow date
            function setAllDates(name_str, num_str, month_str, year_str, date, name_str2, num_str2, month_str2, year_str2, date2, name_str3, num_str3, month_str3, year_str3, date3){
                setADate(name_str, num_str, month_str, year_str, date);
                setADate(name_str2, num_str2, month_str2, year_str2, date2);
                setADate(name_str3, num_str3, month_str3, year_str3, date3);
            }

            // This function changes the day
            function changeDay(today, yesterday, tomorrow){
                setAllDates('.b-day-dash__day-name--today', '.b-day-dash__day-num--today', '.b-day-dash__month--today', '.b-day-dash__year--today', today, '.b-day-dash__day-name--yesterday', '.b-day-dash__day-num--yesterday', '.b-day-dash__month--yesterday', '.b-day-dash__year--yesterday', yesterday, '.b-day-dash__day-name--tomorrow', '.b-day-dash__day-num--tomorrow', '.b-day-dash__month--tomorrow', '.b-day-dash__year--tomorrow', tomorrow);    
            }
            $('.b-day-dash__container, .b-conf-dash__container').css('height', noDashHeight - 20);
            $('.b-day-dash__day, .b-day-dash__up').css('height', dayHeight);
            $('.b-day-dash__down').css('height', dayHeight-5);
            $('.b-day-dash__day-content, .b-day-dash__up-content, .b-day-dash__down-content').css('padding-top', dayContentMargin);
            

            setInterval(function(){updateClock()}, 1000);

            dayUpDownShowHide('.b-day-dash__up', '.b-day-dash__day-name--yesterday', '.b-day-dash__month-year--yesterday', '.b-day-dash__day-num--yesterday', '.b-day-dash__up-ico');
            dayUpDownShowHide('.b-day-dash__down', '.b-day-dash__day-name--tomorrow', '.b-day-dash__month-year--tomorrow', '.b-day-dash__day-num--tomorrow', '.b-day-dash__down-ico');

            setAllDates('.b-day-dash__day-name--today', '.b-day-dash__day-num--today', '.b-day-dash__month--today', '.b-day-dash__year--today', newDate, '.b-day-dash__day-name--yesterday', '.b-day-dash__day-num--yesterday', '.b-day-dash__month--yesterday', '.b-day-dash__year--yesterday', yesterdayDate, '.b-day-dash__day-name--tomorrow', '.b-day-dash__day-num--tomorrow', '.b-day-dash__month--tomorrow', '.b-day-dash__year--tomorrow', tomorrowDate);

            $('.b-day-dash__up').on("click", function(){
                newDate.setDate(newDate.getDate() - 1);
                yesterdayDate.setDate(yesterdayDate.getDate() - 1);
                tomorrowDate.setDate(tomorrowDate.getDate() - 1);
                changeDay(newDate, yesterdayDate, tomorrowDate);
            });

            $('.b-day-dash__down').on("click", function(){
                newDate.setDate(newDate.getDate() + 1);
                yesterdayDate.setDate(yesterdayDate.getDate() + 1);
                tomorrowDate.setDate(tomorrowDate.getDate() + 1);
                changeDay(newDate, yesterdayDate, tomorrowDate);
            }); 
        
            
            var add_even_block = $('.b-add-event-block'),
                check_mark_wrapper = $('.b-day-event-list__check-mark-wrapper'),
                tag_list_item = $('.b-tag-list__item');

            $('.b-main-dash__add-event-button').on("click", function(){
                add_even_block.removeClass('g-hide');
                $('.b-add-event-block__textarea').focus();
            });
            $('.b-add-event-block__button--cancel').on("click", function(){
                add_even_block.addClass('g-hide');
            });
            $('.b-add-event-block__button--done').on("click", function(){
                add_even_block.addClass('g-hide');
            });    
            
            if($('.b-day-event-list-item__container').height() > 70){
                check_mark_wrapper.css('margin-top', ($('.b-day-event-list-item__container').height() - 70)/2 );
            }
            check_mark_wrapper.on("click", function(){
                $(this).parent().parent().addClass('b-day-event-list-item--done');
                console.log("blah");
            });
            $('.b-day-event-list-item__delete').on("click", function(){
                $(this).parent().parent().remove();
            });
        });
        
        $('.b-button-list__button').on("click", function(){
            $('.b-button-list__button').removeClass('b-button-list__button--active');
            $(this).addClass('b-button-list__button--active');
            return false;
        });
        $('#addTagModal').modal({show: false});
        $('#addTimeModal').modal({show: false});
        $('#addGroupModal').modal({show: false});

        $('.b-tag-list__item').on("click", function(){
            $('.b-tag-list__item').removeClass('b-tag-list__item--active');
            $(this).addClass('b-tag-list__item--active');
        });


         /*
     * Replace all SVG images with inline SVG
     */
        jQuery('img.g-svg').each(function(){
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');

                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');

        });
    </script>

    </body>

</html>        