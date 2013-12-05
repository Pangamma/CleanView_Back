<?php include('head.php');

 
        require_once ('../config.php');
        require_once ('secure/api.php');


    $api = new Api ();
    
    $api->addUser( $_POST['b-signup-form__firstname'], 
                    $_POST['b-signup-form__lastname'], 
                    $_POST['b-signup-form__email'], 
                    $_POST['b-signup-form__username'], 
                    $_POST['b-signup-form__password'] );
    
?>
    
    <body class="b-body b-body--grey">
        <h1 class="b-signup-page-logo">PeerCalendar</h1>
        <div class="b-addclasses-form">
            
            <form class="b-addclasses-form__form" method="POST" action="add_major.php">
                <ul class="b-addclasses-form__progress">
                    <li class="b-addclasses-form__progress-item b-addclasses-form__progress-item--active">School</li>
                    <li class="b-addclasses-form__progress-item">Major</li>
                    <li class="b-addclasses-form__progress-item">Classes</li>  
                </ul>    
                
                <!-- Add school block -->
                <div class="b-addclasses-form__fieldset b-addclasses-form__fieldset--add-schools">
                    <h2 class="b-addclasses-form__title">Add Your School</h2>
                    <div class="b-addclasses-form__school-dash">
                        
                        <div class="b-addclasses-form__input-group b-addclasses-form__input-group--search">
                            <label class="b-addclasses-form__label">Search for</label>
                            <input type="text" class="b-addclasses-form__school" placeholder="Name of your school">
                            <a href="#" style="color: #5B3B70; text-decoration:underline;"><p>Add your school manually</p></a>
                        </div>    
                        <div class="b-addclasses-form__input-group b-addclasses-form__input-group--ur-school">
                            <h3 class="b-addclasses-form__ur-school-title">Your school is</h3>    
                        </div>
                    </div>
                    
                    <div class="b-addclasses-form__school-list">
                        <div class="b-addclasses-form__input-group">
                            <p style="margin-left: 20px; font-size: 16px;">Schools</p>
                            <div style="border-bottom: 2px solid #E2E3D9; margin-left: 20px; margin-right: 40px; margin-bottom: 20px;"></div>
                            <ul class="b-school-list">
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!-- 
                                --><h3 class="b-school-list__item-title">University of Washington, Bothell</h3> 
                                    <button type="submit" class="b-school-list__item-btn">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!--
                                    --><h3 class="b-school-list__item-title">The Cooper Union for the Advancement of Science and Art</h3> 
                                    <button type="submit" class="b-school-list__item-btn">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!--
                                    --><h3 class="b-school-list__item-title">Blah</h3> 
                                    <button type="submit" class="b-school-list__item-btn">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!--
                                    --><h3 class="b-school-list__item-title">Blah</h3> 
                                    <button type="submit" class="b-school-list__item-btn">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!--
                                    --><h3 class="b-school-list__item-title">Blah</h3> 
                                    <button type="submit" class="b-school-list__item-btn">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!--
                                    --><h3 class="b-school-list__item-title">Blah</h3> 
                                    <button type="submit" class="b-school-list__item-btn">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!--
                                    --><h3 class="b-school-list__item-title">Blah</h3> 
                                    <button type="submit" class="b-school-list__item-btn">Add</button>
                                </li>
                            </ul>
                        </div>
                        <div style="border-bottom: 2px solid #E2E3D9; margin-left: 40px; margin-right: 40px; margin-bottom: 20px; margin-top: 10px;"></div>     
                    </div>    
                    <div class="g-span12">
                        <div class="b-addclasses-form__btn-group">
                            <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--next">Next</button>
                        </div>
                    </div>     
                    
                </div>    
                <!-- END Add school block -->
            </form>

        </div>
        
        <div class="b-footer">
            <div class="b-footer__container b-footer__container--addclasses-form">
              <p>&copy; PeerCal 2013</p>
            </div>  
        </div>

        <!--javascript-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>          
    </body>    
</html>    