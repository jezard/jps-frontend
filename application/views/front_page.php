<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script src="http://joulepersecond.com/js/highcharts/highcharts.js"></script>
<script src="http://joulepersecond.com/js/highcharts/highcharts-more.js"></script>
<script src="http://joulepersecond.com/js/highcharts/modules/solid-gauge.src.js"></script>
<script src="http://joulepersecond.com/js/highcharts/modules/exporting.js"></script>
<script src="http://joulepersecond.com/js/highcharts/themes/jps-gray.js"></script>
<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=787372587998026";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?php 
    if(isset($_COOKIE['theme'])){
        $color = $_COOKIE['theme'];
    }else{
        $color = 'gray';
    }
?>



<?php if ($color == 'gray'): ?>
<style>
    body{
        background: url(images/stripey-bg.png);
        background-repeat: repeat-x;
    }
</style>
<?php endif; ?>



        <div class="grid homepage">
        	<div class="col-1-2"><h1 class="primary-heading desktop jps-em">This is <span>Joule</span><span>Per</span><span>Second</span>!</h1></div>
            <div class="col-1-2">
                <div class="addthis_sharing_toolbox"></div>
            </div>
        </div>
        <div class="intro grid">
            <div class="col-1-5"><div class="fp-ride"></div>Ride</div>
            <div class="col-1-5"><div class="fp-upload"></div>Upload</div>
            <div class="col-1-5"><div class="fp-engage"></div>Engage</div>
            <div class="col-1-5"><div class="fp-learn"></div>Learn</div>
            <div class="col-1-5"><div class="fp-develop"></div>Develop</div>
        </div>
    </div>
</div>
<div class="signup-cta"><a href="https://joulepersecond.com/signup" alt="Sign up!" title="Sign up">It's free, <strong>Start now</strong> &raquo;</a></div>
<div class="grid grid-pad trans-bg">
    <div class="grid ">
        <h2>Skip the blurb and play with the <a href="#demo"><b>demo</b></a>...</h2>
        <div style="margin:20px">
            <div class="content-container">
                
                <aside class="intro"><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> compliments apps such as TrainerRoad, Strava and Zwift</aside>
                <table border="1" cellspacing="0" cellpadding="0" class="feature-table">
                    <tr>
                        <th valign="top"><h3><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> <span class="desktop">Doesn&rsquo;t</span></h3></th>
                        <th valign="top"><h3 class="desktop"><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> Does</h3></th>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Tell you how many miles you&rsquo;ve done, and how fast you went. <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> connects with Strava. They do that sort of thing rather well!</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Tell you at a glance how much time you spent in heart rate and power zones, for each individual activity, for the week so far and historically</p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Make you go faster</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Provide a toolkit which helps to make informed training decisions. <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> shows where best power performances vs metrics including ATL, CTL and TSB.</p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Show you where you&rsquo;ve been</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Show you how your body performed in measurable, easily comparable terms</p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Let you show off your rides to your friends - but we&rsquo;re working on it!</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Allow you to enter a manual TSS score or use one based on heart rate if you ride without a power meter, or if stops working mid ride!</p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Clean your bike for you - but we can send you a bike sticker!</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Show correlations between heart rate and power over time, as well as also providing many other useful information. </p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Chain you to a single computer for analysis of your data</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Use modern* web-based technology to provide fast and responsive access to what is the vast amounts of data generated by cyclists.</p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Record your ride in real time. </p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Connect to Strava &mdash; no uploading twice! <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> works very well with apps like TrainerRoad and Zwift which record your ride</p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Currently upload .gpx files, although this is something we are looking in to</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Allow multiple uploading of your old training files in .fit or .tcx format</p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Work with old browsers</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Work with modern HTML5 technology including on handheld. We recommend Google Chrome</p></td>
                    </tr>
                    <tr>
                        <td valign="top"><span class="bullet">&bull;</span><p> Think I always know best</p></td>
                        <td valign="top"><span class="bullet">&bull;</span><p> Think a great app depends on listening to user feedback. </p></td>
                    </tr>
                </table>
                <div id="ff-graph"></div>
               
        		<section>
                    <h1 class="mobile jps-em">This is <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>!</h1>
        			<article class="blurb">
        				
                        <div class="col-1-2">
                            <div class="home-content-container">
                                <h3 class="home-h3"><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/social-gray.png" alt="icon" /><span class="fine">Let's be friends</span></h3>
                                <div class="feature-box">
                                    <div class="fb-comments" data-href="http://joulepersecond.com" data-numposts="5" data-colorscheme="light" data-width="100%"></div>
                                    
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_horizontal_follow_toolbox"></div>
                                </div>
                            </div>
        				</div>

                        <div class="col-1-2">
                            <div class="home-content-container">
                                <h3 class="home-h3"><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/wt-logo-gray.png" alt="icon" /><span class="fine">Powered by</span></h3>
                                <div class="feature-box">
                                    <div>&nbsp;</div>
                                    <a href="http://wizard.technology"><img src="<?php echo $this->config->item('base_url'); ?>/images/wt-logo.png" alt="Wizard Technology logo" width="130"/></a>

                                    <p><a href="<?php echo $this->config->item('base_url'); ?>"><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span></a> is designed and engineered by Jeremy at <a href="http://wizard.technology">Wizard&nbsp;Technology</a>.</p>
                                </div>
                            </div>
                        </div>
        			</article>
        		</section>

                <section>
                    <a name="demo"></a>
                    <h1>Demo</h1>
                        <article class="col-1-1">
                            <span class="note" style="margin-bottom:50px"><strong>The demonstration below</strong> shows a <em>subset</em> of <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span>'s</span> functionality. It allows you to slice and dice your ride data many ways - you may show up to 90 days in the free version. The demo features my own data (warts and all), there's a couple of years worth in there - however, as I'm always adding new features the later activities contain more information... It's just best to have a play around and see what you can reveal(!).  You can switch the <a href="http://joulepersecond.com/index.php/theme?ret=">theme</a> too!<br>&nbsp;<br><b>Have Fun!</b> - <a href="https://www.strava.com/athletes/exmoorbiker"><em>Jeremy</em><a></span>
                        </article>

                    <article>
                        <iframe id="analysis-container" allowTransparency="true" scrolling="no" src="http://joulepersecond.com:8000/analysis.html"></iframe>
                    </article>
                </section>
            </div>
    	</div>
        