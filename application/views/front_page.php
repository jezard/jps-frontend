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




        <div class="grid homepage">
        	<div class="col-9-12"><h1 class="primary-heading desktop jps-em"><span>Joule</span><span>Per</span><span>Second</span> <span class="title-blurb">is&nbsp;the&nbsp;performance&nbsp;tool&nbsp;for&nbsp;Racing&nbsp;Cyclists</span></h1></div>
            <div class="col-1-4">
                <div class="addthis_sharing_toolbox"></div>
            </div>
        </div>
        <div class="intro grid">
            <div class="col-1-5"><div class="fp-ride"><div class="intro-text">Ride…</div></div></div>
            <div class="col-1-5"><div class="fp-upload"><div class="intro-text">Upload…</div></div></div>
            <div class="col-1-5"><div class="fp-engage"><div class="intro-text">Engage…</div></div></div>
            <div class="col-1-5"><div class="fp-learn"><div class="intro-text">Learn…</div></div></div>
            <div class="col-1-5"><div class="fp-develop"><div class="intro-text">Develop</div></div></div>
        </div>
    </div>
</div>
<div class="signup-cta"><a href="https://joulepersecond.com/signup" alt="Sign up!" title="Sign up">Get a free or unlimited account, <strong>Start now</strong> &raquo;</a></div>
<div class="grid grid-pad trans-bg">
    <div class="grid main-content">
        <h2 style="text-align:center">The best way to learn <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is to try it out for yourself. Skip the blurb and play with the <a href="#demo"><b>demo</b></a>...</h2>
        <div style="margin:20px">
            <div class="content-container">
                <section class="main-features">
                    <div class="col-1-3 main-feature"><img src="/images/fp-icons/integration.png" alt="Compliments other cycling apps" /><aside>Connect with <span class="strava">STRAVA</span></aside></div>
                    <div class="col-1-3 main-feature"><img src="/images/fp-icons/powerful.png" alt="Simple yet Powerful" /><aside>Powerful analytics</aside></div>
                    <div class="col-1-3 main-feature"><img src="/images/fp-icons/access.png" alt="" /><aside>Cloud based</aside></div>
                </section>
                <section>
                    <article class="the-blurb">
                        <div class="col-1-2">
                            <h3>About <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span></h3>
                            <p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> JoulePerSecond is a tool for racing cyclists; those participating in power based training approaches. <br>Objectives include:</p>
                            <ul>
                              <li>Show performance changes over shorter and longer periods of time.</li>
                              <li>Allow the user to visualize what training works and what doesn’t in a relatively short time period – we all respond differently to training.</li>
                              <li>Provide 'access anywhere' tools to monitor progress.</li>
                            </ul>
                            <h3>Key features</h3>
                            <ol>
                              <li>A Quick view Dashboard gives a snapshot of current form, fitness and fatigue with cumulative training load, duration, and time recorded in each heart rate / power zone for the current week.</li>
                              <li>Only essential performance metrics are used and stored. Geographical, elevation and motion data are not used which helps to keep things uncluttered</li>
                              <li>Although <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> doesn&rsquo;t show data normally associated with outdoor only rides, it does connect and send it to <span class="strava">Strava</span>. We plan to add <strong><a href="http://dropbox.com" target="_blank"><span style="color:#007ee5">Dropbox</span></a></strong> auto sync soon. </li>
                              <li><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is designed to extend the functionality offered by other systems such as TrainerRoad and Zwift, rather than to replace them. <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> accepts .fit and .tcx file formats. </li>
                            </ol>

                             <?php if(@$paid_account == 0): ?>
                             <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- homepage_responsive -->
                            <p><ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-8959768918251091"
                                 data-ad-slot="9031020769"
                                 data-ad-format="auto"></ins></p>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            <?php endif; ?>
                        </div>
                        <div class="col-1-2">
                            <h3>Other useful features</h3>
                            <p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> has a range of graphs and other tools for historical analysis including</p>
                            <ol>
                              <li>The Performance chart is at the heart of the system. In your account you can set up an unlimited number of tags. These allow you to mark and compare similar rides. Have a play with the demo below... </li>
                              <li>Training impact - shows fatigue and form over time. Maps how you felt against your actual performance.</li>
                              <li>Mean Maximal Power chart - shows the best CP generated (and when) for the current period against the two previous periods.</li>
                              <li>Training  Load vs Duration, plots weekly cumulative (or monthly when more than 366 days selected). </li>
                              <li>Heart rate by Zone and Power by Zone charts show cumulative weekly/monthly (as above) breakdown of time in zones, I want to create user settable zones at some point soon &mdash; for now they are based on popular calculations from threshold power and heart rate values. </li>
                            </ol>
                            <p>The main purpose of <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is not analysis on a per-ride basis, it comes equipped with some useful tools:</p>
                            <ol>
                              <li>Easy-to-navigate training diary - add notes and record how you feel you performed and felt from predefined, analysable metrics.</li>
                              <li>Ride summary including: duration, av. power/hr/cadence, intensity %, Training load, work done/energy used (Power based value take precedence over Heart based value). </li>
                              <li>Lap summaries including: duration, av. power/hr/cadence. </li>
                              <li>Intensity %, Power and Heart rate quick view dials plus time spent in Zones.</li>
                              <li>Ability to calculate training load from power or heartrate data, and manual input/override.</li>
                            </ol>
                           
                            
                        </div>
                    </article>
                </section>
                <div style="clear:both"></div>
               
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
                    <a id="demo" name="demo"></a>
                    <h1>Demo</h1>
                        <article class="col-1-1">
                            <span class="note" style="margin-bottom:50px; width:100%"><strong>The demonstration below</strong> shows just <em>some</em> of <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span>'s</span> functionality. Use the filter to reveal patterns in the data.</span>
                        </article>
                        <article  id="dashboard"></article>

                    <article>
                        <iframe id="analysis-container" allowTransparency="true" scrolling="no" src="http://joulepersecond.com:8080/analysis?mode=demo"></iframe>
                    </article>
                </section>
            </div>
    	</div>
      <?php $access_token = (get_token() != "") ? get_token() : "unknown" ?>
      <?php 
        if(isset($_COOKIE['theme'])){
          $color = $_COOKIE['theme'];
        }else{
          $color = 'gray';
        }
      ?>

      <script>
          $('#dashboard').writeCapture().load("http://joulepersecond.com:8080/dashboard/<?php echo $access_token.'/'.$color; ?>");
      </script>
        