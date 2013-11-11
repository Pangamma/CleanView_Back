<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PeerCalendar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

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
    
    <body class="b-body b-body--add-classes">
        <h1 class="b-signup-page-logo">PeerCalendar</h1>
        <div class="b-addclasses-form">
            
            <form class="b-addclasses-form__form">
                <ul class="b-addclasses-form__progress">
                    <li class="b-addclasses-form__progress-item b-addclasses-form__progress-item--active">School</li>
                    <li class="b-addclasses-form__progress-item">Major</li>
                    <li class="b-addclasses-form__progress-item">Classes</li>  
                </ul>    
                
                <div class="b-addclasses-form__fieldset b-addclasses-form__fieldset--add-schools">
                    <h2 class="b-addclasses-form__title">Add Your School</h2>
                    <div class="b-addclasses-form__school-dash">
                        
                        <div class="b-addclasses-form__input-group">
                            <label class="b-addclasses-form__label">Search for</label>
                            <input type="text" class="b-addclasses-form__school" placeholder="Name of your school">
                            <a href="#" style="color: #5B3B70; text-decoration:underline;"><p>Add school manually</p></a>
                        </div>    
                        <div class="b-addclasses-form__input-group">
                            <h3 class="b-addclasses-form__med-title">Your school is</h3>    
                        </div>
                    </div>
                    
                    <div class="b-addclasses-form__school-list">
                        <div class="b-addclasses-form__input-group">
                            <p style="margin-left: 20px;">Schools</p>
                            <div style="border-bottom: 2px solid #E2E3D9; margin-left: 20px; margin-right: 40px; margin-bottom: 20px;"></div>
                            <ul class="b-school-list">
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!-- 
                                --><h3 class="b-school-list__item-title">University of Washington</h3> 
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
                                <li class="b-school-list__item">
                                    <img class="b-school-list__item-img" src="http://placehold.it/50x50" alt=""><!--
                                    --><h3 class="b-school-list__item-title">Blah</h3> 
                                    <button type="submit" class="b-school-list__item-btn">Add</button>
                                </li>
                            </ul>
                        </div>
                        <div style="border-bottom: 2px solid #E2E3D9; margin-left: 40px; margin-right: 40px; margin-bottom: 20px;"></div>     
                    </div>    
                    
                    <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--next">Next</button>
                    
                </div>    
                
                <div class="b-addclasses-form__fieldset b-addclasses-form__fieldset--add-major" style="display: none;">
                    <h2 class="b-addclasses-form__title">Add Your Major</h2>
                    <div class="b-addclasses-form__school-dash">
                        
                        <div class="b-addclasses-form__input-group">
                            <label class="b-addclasses-form__label">Search for</label>
                            <input type="text" class="b-addclasses-form__school" placeholder="Name of your school">
                        </div>
                    </div>
                    
                    <div class="b-addclasses-form__school-list">
                        <div class="b-addclasses-form__input-group">
                            <p style="margin-left: 20px;">Schools</p>
                            <div style="border-bottom: 2px solid #E2E3D9; margin-left: 20px; margin-right: 40px; margin-bottom: 20px;"></div>
                            <ul class="b-school-list">
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                            </ul>
                        </div>
                        <div style="border-bottom: 2px solid #E2E3D9; margin-left: 40px; margin-right: 40px; margin-bottom: 20px;"></div>     
                    </div>
                    <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--prev">Previous</button>    
                    <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--next">Next</button>
                </div>
                <div class="b-addclasses-form__fieldset b-addclasses-form__fieldset--add-classes" style="display: none;">
                    <h2 class="b-addclasses-form__title">Add Your Classes</h2>
                    <div class="b-addclasses-form__school-dash">

                        <div class="b-addclasses-form__input-group">
                            <label class="b-addclasses-form__label">Search for</label>
                            <input type="text" class="b-addclasses-form__school" placeholder="Name of your school">
                        </div>

                    </div>
                    
                    <div class="b-addclasses-form__school-list">
                        <div class="b-addclasses-form__input-group">
                            <p style="margin-left: 20px;">Schools</p>
                            <div style="border-bottom: 2px solid #E2E3D9; margin-left: 20px; margin-right: 40px; margin-bottom: 20px;"></div>
                            <ul class="b-school-list">
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title"></h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                                <li class="b-school-list__item">
                                    <h3 class="b-school-list__item-title">Computer Science and Software Engineering</h3> 
                                    <button type="submit" class="b-school-list__item-btn b-signup-form__button">Add</button>
                                </li>
                            </ul>
                        </div>
                        <div style="border-bottom: 2px solid #E2E3D9; margin-left: 40px; margin-right: 40px; margin-bottom: 20px;"></div>     
                    </div>
                    <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--prev">Previous</button>    
                    <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--done">Done</button>
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
        <script src="assets/js/add_classes_page.js"></script>           
    </body>    
</html>