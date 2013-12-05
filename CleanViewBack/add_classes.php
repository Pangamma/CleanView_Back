
<?php 
    include('head.php');
    require_once ('secure/api.php');
?>
    
    <body class="b-body b-body--grey">
        <h1 class="b-signup-page-logo">PeerCalendar</h1>
        <div class="b-addclasses-form">
            
            <form class="b-addclasses-form__form">
                <ul class="b-addclasses-form__progress">
                    <li class="b-addclasses-form__progress-item b-addclasses-form__progress-item--active">School</li>
                    <li class="b-addclasses-form__progress-item b-addclasses-form__progress-item--active">Major</li>
                    <li class="b-addclasses-form__progress-item b-addclasses-form__progress-item--active">Classes</li>  
                </ul>
                
                <!-- Add classes block -->
                <div class="b-addclasses-form__fieldset b-addclasses-form__fieldset--add-classes">
                    <h2 class="b-addclasses-form__title">Add Your Classes</h2>
                    <div class="b-addclasses-form__classes-dash">

                        <div class="b-addclasses-form__input-group b-addclasses-form__input-group--search">
                            <label class="b-addclasses-form__label">Search for</label>
                            <input type="text" class="b-addclasses-form__school" placeholder="Name of your class">
                            <a href="#" style="color: #5B3B70; text-decoration:underline;"><p>Add your class manually</p></a>
                        </div>
                        <div class="b-addclasses-form__input-group b-addclasses-form__input-group--ur-classes">
                            <h3 class="b-addclasses-form__classes-title">Your classes are</h3>
                            <ul id="your-classes">
                            </ul>  
                        </div>

                    </div>
                    
                    <div class="b-addclasses-form__classes-list">
                        <div class="b-addclasses-form__input-group">
                            <p style="margin-left: 20px; font-size: 16px;">Classes</p>
                            <div style="border-bottom: 2px solid #E2E3D9; margin-left: 20px; margin-right: 40px; margin-bottom: 20px;"></div>
                            <ul class="b-classes-list" id="unselected-classes">
                                <?php 
                                    $api = new Api ();
                                    foreach( $api->getCourses() as $course) {
                                ?>
                                    <li courseId = <?= $course->getCourseId() ?> selected=false class="b-classes-list__item" style="margin:1m;padding:1m;background-color:#D683FF">
                                        <h3 class="b-classes-list__item-title"><?= $course->getName() ?> : <?= $course->getTitle() ?></h3> 
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div style="border-bottom: 2px solid #E2E3D9; margin-left: 40px; margin-right: 40px; margin-bottom: 20px;"></div>     
                    </div>
                    <div class="g-span12">
                        <div class="b-addclasses-form__btn-group">
                            <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--prev">Previous</button>    
                            <button type="submit" class="b-addclasses-form__btn b-addclasses-form__btn--done">Done</button>
                        </div>    
                    </div>       
                </div>
                <!-- END Add classes block -->        
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
        <style type="text/css">
            .b-classes-list__item:hover {
                background-color: #A76FC1;
            }
        </style>
        <script>
        $(document).ready(function(){
            $(".b-classes-list__item").click(function(){
                if( this.getAttribute("selected") === "false"){
                    this.setAttribute("selected", "true");
                    $("#your-classes").append(this);
                } else {
                    this.setAttribute("selected", "false");
                    $("#unselected-classes").append(this);
                }

            });

            $(".b-addclasses-form__btn--done").click(function(){
                var courseNumbers = [];
                $("#your-classes").children().each(function(){
                    courseNumbers.push(this.getAttribute("courseId"));
                });
                $.ajax({
                    url:"enroll.php",
                    data : {
                        "classes" : courseNumbers.toString()
                    },
                    success: function(response){
                        console.log(response);
                    }
                });
                //TODO: add redirect
            })
        })
        </script>           
    </body>    
</html>