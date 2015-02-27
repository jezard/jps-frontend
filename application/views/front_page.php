<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>/js/slider/js/jssor.slider.mini.js"></script>
    <!-- Caption Style -->
    <style> 
        .captionOrange, .captionBlack
        {
            color: #fff;
            font-size: 20px;
            line-height: 30px;
            text-align: center;
            border-radius: 5px;
        }
        .captionOrange
        {
            background: #fb4b02; /* Old browsers */
			background: -moz-linear-gradient(top,  #fb4b02 0%, #db4000 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fb4b02), color-stop(100%,#db4000)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  #fb4b02 0%,#db4000 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  #fb4b02 0%,#db4000 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  #fb4b02 0%,#db4000 100%); /* IE10+ */
			background: linear-gradient(to bottom,  #fb4b02 0%,#db4000 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fb4b02', endColorstr='#db4000',GradientType=0 ); /* IE6-9 */
			text-shadow: 0 -1px #0d0d0d;
			font-size: 20px;
			padding:0 10px;
            transform:none!important;
            opacity: 1!important;
        }
/*        .captionOrange{
            background: #fff;
            text-shadow: none;
            font-size: 20px;
            padding:0 10px;
            color:#5A5A5D;
            border: 1px solid #ccc;
            transform:none!important;
            opacity: 1!important;
        }*/
        .captionBlack
        {
        	font-size:16px;
            background: #000;
            background-color: rgba(0, 0, 0, 0.4);
        }
        a.captionOrange, A.captionOrange:active, A.captionOrange:visited
        {
        	color: #ffffff;
        	text-decoration: none;
        }
        a.captionOrange:hover
        {
            color: #FB4B02;
            text-decoration: underline;
            background-color: #eeeeee;
            background-color: rgba(238, 238, 238, 0.7);
        }
        .bricon
        {
            background: url(<?php echo $this->config->item('base_url'); ?>/js/slider/img/browser-icons.png);
        }
    </style>

    <script>
        jQuery(document).ready(function ($) {
            //Reference http://www.jssor.com/development/slider-with-slideshow-jquery.html
            //Reference http://www.jssor.com/development/tool-slideshow-transition-viewer.html

            var _SlideshowTransitions = [
                { $Duration: 1500, x: 0.5, $Cols: 2, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutCubic }, $Opacity: 2, $Brother: { $Duration: 1500, $Opacity: 2 } },
                //Rotate in+ out-
                { $Duration: 1500, x: -0.3, y: 0.5, $Zoom: 1, $Rotate: 0.1, $During: { $Left: [0.6, 0.4], $Top: [0.6, 0.4], $Rotate: [0.6, 0.4], $Zoom: [0.6, 0.4] }, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Brother: { $Duration: 1000, $Zoom: 11, $Rotate: -0.5, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Shift: 200 } },
                //Fly Twins
                { $Duration: 1500, x: 0.3, $During: { $Left: [0.6, 0.4] }, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true, $Brother: { $Duration: 1000, x: -0.3, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Rotate in- out+
                { $Duration: 1500, $Zoom: 11, $Rotate: 0.5, $During: { $Left: [0.4, 0.6], $Top: [0.4, 0.6], $Rotate: [0.4, 0.6], $Zoom: [0.4, 0.6] }, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Brother: { $Duration: 1000, $Zoom: 1, $Rotate: -0.5, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Shift: 200 } },
                //Rotate Axis up overlap
                { $Duration: 1200, x: 0.25, y: 0.5, $Rotate: -0.1, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Brother: { $Duration: 1200, x: -0.1, y: -0.7, $Rotate: 0.1, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2 } },
                //Chess Replace TB
                { $Duration: 1600, x: 1, $Rows: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1600, x: -1, $Rows: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Chess Replace LR
                { $Duration: 1600, y: -1, $Cols: 2, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1600, y: 1, $Cols: 2, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Shift TB
                { $Duration: 1200, y: 1, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1200, y: -1, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Shift LR
                { $Duration: 1200, x: 1, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1200, x: -1, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Return TB
                { $Duration: 1200, y: -1, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1200, y: -1, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Shift: -100 } },
                //Return LR
                { $Duration: 1200, x: 1, $Delay: 40, $Cols: 6, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1200, x: 1, $Delay: 40, $Cols: 6, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Shift: -100 } },
                //Rotate Axis down
                { $Duration: 1500, x: -0.1, y: -0.7, $Rotate: 0.1, $During: { $Left: [0.6, 0.4], $Top: [0.6, 0.4], $Rotate: [0.6, 0.4] }, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Brother: { $Duration: 1000, x: 0.2, y: 0.5, $Rotate: -0.1, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2 } },
                //Extrude Replace
                { $Duration: 1600, x: -0.2, $Delay: 40, $Cols: 12, $During: { $Left: [0.4, 0.6] }, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Opacity: $JssorEasing$.$EaseInOutQuad }, $Opacity: 2, $Outside: true, $Round: { $Top: 0.5 }, $Brother: { $Duration: 1000, x: 0.2, $Delay: 40, $Cols: 12, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 1028, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Opacity: $JssorEasing$.$EaseInOutQuad }, $Opacity: 2, $Round: { $Top: 0.5 } } }
            ];

            var _CaptionTransitions = [

		        //ZMF|10
		        {$Duration: 600, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },
		        {$Duration: 900, x: 0.5, $Easing: { $Left: $JssorEasing$.$EaseInOutBack }, $Opacity: 2 },
		        {$Duration: 900, x: -1.0, $Easing: { $Left: $JssorEasing$.$EaseInOutBack }, $Opacity: 2 },
		        {$Duration: 900, y: -1.0, $Easing: { $Top: $JssorEasing$.$EaseInOutBack }, $Opacity: 2 }

            ];

            var options = {
                $HWA: false,
            	$FillMode: 1,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 0,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
                    $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
                    $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                    $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                    $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              	//[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2                                //[Required] 0 Never, 1 Mouse Over, 2 Always
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
             function ScaleSlider() {

                //reserve blank width for margin+padding: margin+padding-left (10) + margin+padding-right (10)
                var paddingWidth = 30;

                //minimum width should reserve for text
                var minReserveWidth = 225;

                var parentElement = jssor_slider1.$Elmt.parentNode;

                //evaluate parent container width
                var parentWidth = parentElement.clientWidth;

                if (parentWidth) {

                    //exclude blank width
                    var availableWidth = parentWidth - paddingWidth;

                    //calculate slider width as 70% of available width
                    var sliderWidth = availableWidth * 1;

                    //slider width is maximum 600
                    sliderWidth = Math.min(sliderWidth, 1100);

                    //slider width is minimum 200
                    sliderWidth = Math.max(sliderWidth, 200);
                    var clearFix = "none";

                    //evaluate free width for text, if the width is less than minReserveWidth then fill parent container
                    if (availableWidth - sliderWidth < minReserveWidth) {

                        //set slider width to available width
                        sliderWidth = availableWidth;

                        //slider width is minimum 200
                        sliderWidth = Math.max(sliderWidth, 200);

                        clearFix = "both";
                    }

                    //clear fix for safari 3.1, chrome 3
                    $('#clearFixDiv').css('clear', clearFix);

                    jssor_slider1.$ScaleWidth(sliderWidth);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>

    <!-- Jssor Slider Begin -->
    <div class="grid grid-pad homepage">
    	<h1 class="primary-heading desktop jps-em">This is <span>Joule</span><span>Per</span><span>Second</span>!</h1>
    	<section class="section-ln desktop">
    		
    		<h2>Product tour</h2>
    		<div class="content-container jps-slider " style="overflow:hidden; background: #fff<!-- url(<?php echo $this->config->item('base_url'); ?>/images/LightTransBg.png) -->;">
			    <!-- You can move inline styles to css file or css block. -->
			    <!-- Jssor Slider Begin -->
			    <!-- You can move inline styles to css file or css block. -->
			        <div id="slider1_container" style="position: relative; margin: 0px 5px 5px 0px; float: left; top: 0px; left: 0px; width: 1000px;
			            height: 450px; overflow: hidden;">
			            <!-- Slides Container -->
			            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1000px; height: 450px;
			                overflow: hidden;">
			                <div>
				                <a u=image href="#"><img class="image-shadow"  src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/activity-finder.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top: 0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/wt-logo.png" alt="icon" />Find activities easily and make notes
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/ride-summary.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top: 0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/pie-chart.png" alt="icon" />At a glance stats
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/activity-overview.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top: 0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/magnifier.png" alt="icon" />Zoom in on an activity
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/heartrate-dist.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top: 0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/pie-chart.png" alt="icon" />Heart rate distribution
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/power-dist.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/pie-chart.png" alt="icon" />Power distribution
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/mmp-activity.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/target.png" alt="icon" />Mean Maximal power
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/lap-summaries.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/calculation.png" alt="icon" />Lap summaries
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/analysis-filter.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/settings.png" alt="icon" />Show only what you need
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/training-load.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/whats-watt.png" alt="icon" />Compare performance with fitness and fatigue
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/mean-max-power-3.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/monitoring.png" alt="icon" />Compare Mean Maximal power against previous periods
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/tss-vs-duration.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/monitoring.png" alt="icon" />Monitor weekly training load and duration
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/heartrate-by-zone.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/objectives.png" alt="icon" />Analyse time in heart rate zones
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/power-by-zone.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/objectives.png" alt="icon" />Analyse time in power zones
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/heart-vs-power.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/intelligence.png" alt="icon" />Note trends between key metrics
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/settings.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/settings.png" alt="icon" />Basic settings. Sharing and API coming soon!
				                </div>
				            </div>
				            <div>
				                <a u=image href="#"><img class="image-shadow" src="<?php echo $this->config->item('base_url'); ?>/js/slider/img/screenshots/advanced-settings.png" /></a>
				                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:0; top:0;"> 
				                    <img class="show-icon" src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/settings.png" alt="icon" />Advanced settings - even more comprehensive settings will be available to paid members...
				                </div>
				            </div>
			            </div>
			        	<!-- Bullet Navigator Skin Begin -->
				        <!-- jssor slider bullet navigator skin 01 -->
				        <style>
				            /*
				            .jssorb01 div           (normal)
				            .jssorb01 div:hover     (normal mouseover)
				            .jssorb01 .av           (active)
				            .jssorb01 .av:hover     (active mouseover)
				            .jssorb01 .dn           (mousedown)
				            */
				            .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av
				            {
				                filter: alpha(opacity=100);
				                opacity: 1;
				                overflow:hidden;
				                cursor: pointer;
				                border: #fff 1px solid;
				                border-radius: 50%;
				            }
				            .jssorb01 div { background-color: #FB4B02; }
				            .jssorb01 div:hover, .jssorb01 .av:hover { background-color: #d3d3d3; }
				            .jssorb01 .av { background-color: #6DD300; }
				            .jssorb01 .dn, .jssorb01 .dn:hover { background-color: #FB4B02; border-radius: 50%;}
				        </style>
				        <!-- bullet navigator container -->
				        <div u="navigator" class="jssorb01" style="position: absolute; bottom: 16px; right: 10px;">
				            <!-- bullet navigator item prototype -->
				            <div u="prototype" style="POSITION: absolute; WIDTH: 12px; HEIGHT: 12px;"></div>
				        </div>
				        <!-- Bullet Navigator Skin End -->
				        
				        <!-- Arrow Navigator Skin Begin -->
				        <style>
				            .jssora05l, .jssora05r, .jssora05ldn, .jssora05rdn
				            {
				            	position: absolute;
				            	cursor: pointer;
				            	display: block;
				                background: url(<?php echo $this->config->item('base_url'); ?>/js/slider/img/a17.png) no-repeat;
				                overflow:hidden;
				            }
				            .jssora05l { background-position: -10px -40px; }
				            .jssora05r { background-position: -70px -40px; }
				            .jssora05l:hover { background-position: -130px -40px; }
				            .jssora05r:hover { background-position: -190px -40px; }
				            .jssora05ldn { background-position: -250px -40px; }
				            .jssora05rdn { background-position: -310px -40px; }
				        </style>
				        <!-- Arrow Left -->
				        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 150px; left: 15px; background-repeat:no-repeat; border-radius: 50%; box-shadow: 0px 6px 8px -2px rgba(50, 50, 50, 0.75);">
				        </span>
				        <!-- Arrow Right -->
				        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 150px; right: 15px; background-repeat:no-repeat; border-radius: 50%; box-shadow: 0px 6px 8px -2px rgba(50, 50, 50, 0.75);">
				        </span>
				        <!-- Arrow Navigator Skin End -->
				        <a style="display: none" href="http://www.jssor.com">jQuery Slider</a>
			        </div>
			        <!-- Jssor Slider End -->
			    <!-- Jssor Slider End -->
			</div>
		</section>
		<section class="section-ln">
            <h1 class="mobile jps-em">This is <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>!</h1>
			<article class="blurb">
				<h2>What is <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>?</h2>
				<div class="col-1-2">
					
					<h3><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/objectives.png" alt="icon" /><span>Objectives</span></h3>
					<div class="content-container" style="background-image: url(<?php echo $this->config->item('base_url'); ?>/images/background-icons/objectives.png)" >
						<p><strong><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is an analytical fitness tool for amateur and professional cyclists</strong>. Our Primary goal: To provide a decision support system for helping you planning your training rides – what to do and when to do it, and maximise the benefit for each hour spent training, so that you can be at your peak fitness when you need to be.  Put another way, we provide the tools which will help you to go faster when it counts.</p>
						<p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> provides you as a cyclist with some very useful features – but there's a lot to do before we can begin to say we're done! – wed like your input – what are your requirements for perfect cycling analytics? Tell us <a href="/index.php/forum">here</a>. Popular requests are likely candidates for early implementation to <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>. <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is a tool for Cyclists, made by Cyclists. We read the forums and it confirmed our feelings that there must be a better way. That is why we created <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>.</p>
						<p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is about showing performance data rather that where you've been or who you've beaten on a certain stretch of road. Many of us spend hours and hours cycling indoors, and <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is particularly useful when extending the analysis provided by other systems such as <a href="http://www.trainerroad.com">TrainerRoad</a>, whilst merging in other outdoor training and race data.</p><p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is based on the <em>Freemium</em> subscription model - it's <strong><em>free</em></strong> to use, but you may wish to upgrade at some stage for more features.</p>
					</div>
					<h3><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/whats-watt.png" alt="icon" /><span><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>? Watt's with that?!</span></h3>
					<div class="content-container" >
						<p>For those that don't know, one Joule per Second is one Watt, the commonly used unit of power in many applications including cycling. Our web app is best suited to those who use a power meter, although we use algorithms based on heart rate when riding a bike without a power meter (or attend a spin class), and our power meter batteries die - we allow a manual override of the training load for an activity, so as not to render training load charts useless when disaster strikes.</p>
					</div>
					<h3><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/bug-fixing.png" alt="icon" /><span>Bleeding edge development...</span></h3>
					<div class="content-container" style="background-image: url(<?php echo $this->config->item('base_url'); ?>/images/background-icons/bug-fixing.png)">
						<p>With all new developments there is a possibility of finding a bug or issue, but hopefully we've ironed out all the serious ones! However we really like you to report any problems either in the forum or email us <a href="mailto:admin@joulepersecond.com?subject=Issue%20found">here</a>. </p>
						<p>All of our systems are securely located in 'The Cloud'. And as running servers that are powerful enough to run a resource hungry application like <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> aren't cheap, we plan to scale up and out as demand increases. While new and small, spikes in requests for processing resources might occasionally become noticeable to you the user - if you should have difficulty - please try a few minutes later. We will be monitoring usage and scaling our resources accordingly.</p>
						<p>There isn't much of a social function yet although this is very important to us, we consider getting the basic app running first priority, but sharing (and showing off!) of your rides is next on our agenda. Other items to implement at the top of our hit list can be found on the <a href="https://trello.com/b/yphccBWK/fixes-and-minor-improvements" target="_blank"><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> page at Trello.com</a><br>&nbsp<br><span class="note"><strong>PS </strong>&mdash; It'd be rather handy to copy our ride data to <strong><em><a href="https://www.strava.com/clubs/JoulePerSecond" target="_blank">Strava</a></em></strong> when uploading too!</span>				        </p>
				  </div>
				</div>
				<div class="col-1-2">
					<h3><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/technical.png" alt="icon" /><span>Technical information</span></h3>
					<div class="content-container" style="background-image: url(<?php echo $this->config->item('base_url'); ?>/images/background-icons/technical.png)" >
						<ul>
							<li><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> requires a modern HTML5 capable browser – we think our resources are better spent adding great new features rather than supporting jurasic browsers. We recommend <a href=" https://www.google.com/chrome/browser/desktop/" target="_blank">Chrome</a> browser.</li>
							<li>JavaScript must be enabled</li>
							<li>Cookies must be enabled – our system uses a range of established and modern web technologies. This information is readily shared between them using the cookies stored in your browser session. We also take advantage of the modern browser's local storage functionality, although our system will operate without it.</li>
							<li>The release version of <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> will be more mobile friendly – we know how important being able to analyse post-ride data is whilst our partners try on various clothing items at the mall…</li>
							<li>We are looking to implement an API for third parties to access a user's shared data (shared by permission).</li>
						</ul>
						<span class="note"><strong>Note:</strong> screens-shots above are taken from a development version, and may not reflect the official release version</span>
					</div>
                    <h3><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/wt-logo.png" alt="icon" /><span>Powered by Wizard Technology</span></h3>
                    <div class="content-container">
                        <a href="http://wizard.technology"><img src="<?php echo $this->config->item('base_url'); ?>/images/wt-logo.png" alt="Wizard Technology logo" width="130"/></a>
                        <p><a href="<?php echo $this->config->item('base_url'); ?>"><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span></a> is designed and built by <a href="http://wizard.technology">Wizard Technology</a>. View the development <a href="http://wizard.technology/projects/peak-power-wizard/">here</a>.</p>
                    </div>
                    <h3><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/jps-logo.png" alt="icon" /><span>Our brand</span></h3>
                    <div class="content-container">
                        <a href="<?php echo $this->config->item('base_url'); ?>/images/quad-hd-logo.png"><img src="<?php echo $this->config->item('base_url'); ?>/images/quad-hd-logo-thumb.png" alt="JoulePerSecond logo" width="100%" style="margin:0"/></a>
                        <p>Please use our logo for spreading the word about <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>! We don't currently have any specific guidelines, so in the meantime just please respect our designer's feelings - and give the logo some space! Click on the image above for a large image. If you need the image in other colors or formats, please contact us and we can supply the original vector. <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> and the Chain Wheel Logo remain the property of Wizard Technology.</p>
                    </div>
                     <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_sharing_toolbox"></div>
				</div>
			</article>
		</section>
	</div>