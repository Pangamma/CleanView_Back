<?php include('head.php'); ?>

    <body class="b-body b-body--grey">
        <h1 class="b-signup-page-logo">PeerCalendar</h1>
        <div class="b-addclasses-form">

        <form class="b-addclasses-form__form" method="POST" action="add_classes.php">
                <ul class="b-addclasses-form__progress">
                    <li class="b-addclasses-form__progress-item b-addclasses-form__progress-item--active">School</li>
                    <li class="b-addclasses-form__progress-item b-addclasses-form__progress-item--active">Major</li>
                    <li class="b-addclasses-form__progress-item">Classes</li>  
                </ul>
                <!-- Add major block -->    
                <div class="b-addclasses-form__fieldset b-addclasses-form__fieldset--add-major">
                    <h2 class="b-addclasses-form__title">Add Your Major</h2>
                    
                    <div class="b-addclasses-form__major-dash">
                        <div class="b-addclasses-form__input-group b-addclasses-form__input-group--search">
                            <label class="b-addclasses-form__label">Search for</label>
                            <input type="text" class="b-addclasses-form__major" placeholder="Name of your major">
                            <a href="#" style="color: #5B3B70; text-decoration:underline;"><p>Add your major manually</p></a>
                        </div>
                        <div class="b-addclasses-form__input-group b-addclasses-form__input-group--ur-major">
                            <h3 class="b-addclasses-form__major-title">Your major is</h3>    
                        </div>
                    </div>
                    
                    <div class="b-addclasses-form__major-list">
                        <div class="b-addclasses-form__input-group">
                            <p style="margin-left: 20px; font-size: 16px;">Majors</p>
                            <div style="border-bottom: 2px solid #E2E3D9; margin-left: 20px; margin-right: 40px; margin-bottom: 20px;"></div>
                            
                            <ul class="b-major-list">
                                <li class="b-major-list__item">
                                    <h3 class="b-major-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-major-list__item-btn">Add</button>
                                </li>
                                <li class="b-major-list__item">
                                    <h3 class="b-major-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-major-list__item-btn">Add</button>
                                </li>
                                <li class="b-major-list__item">
                                    <h3 class="b-major-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-major-list__item-btn">Add</button>
                                </li>
                                <li class="b-major-list__item">
                                    <h3 class="b-major-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-major-list__item-btn">Add</button>
                                </li>
                                <li class="b-major-list__item">
                                    <h3 class="b-major-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-major-list__item-btn">Add</button>
                                </li>
                                <li class="b-major-list__item">
                                    <h3 class="b-major-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-major-list__item-btn">Add</button>
                                </li>
                                <li class="b-major-list__item">
                                    <h3 class="b-major-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-major-list__item-btn">Add</button>
                                </li>
                            </ul>
                        </div>
                        <div style="border-bottom: 2px solid #E2E3D9; margin-left: 40px; margin-right: 40px; margin-bottom: 20px; margin-top: 10px;"></div>     
                    </div>
                    <div class="g-span12">
                        <div class="b-addclasses-form__btn-group">
                            <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--prev">Previous</button>    
                            <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--next">Next</button>
                        </div>    
                    </div>    
                </div>
                <!-- END Add major block -->
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