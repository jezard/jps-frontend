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
<div class="signup-cta"><a href="https://joulepersecond.com/signup" alt="Sign up!" title="Sign up">It's free, <strong>Start now</strong> &raquo;</a></div>
<div class="grid grid-pad trans-bg">
    <div class="grid main-content">
        <h2 style="text-align:center">Skip the blurb and play with the <a href="#demo"><b>demo</b></a>...</h2>
        <div style="margin:20px">
            <div class="content-container">
                <section class="main-features">
                    <div class="col-1-3 main-feature"><img src="/images/fp-icons/integration.png" alt="Compliments other cycling apps" /><aside>Connects with <span class="strava">STRAVA</span></aside></div>
                    <div class="col-1-3 main-feature"><img src="/images/fp-icons/easy.png" alt="Simple yet Powerful" /><aside>Simple yet Powerful</aside></div>
                    <div class="col-1-3 main-feature"><img src="/images/fp-icons/access.png" alt="" /><aside>Cloud based app</aside></div>
                </section>
                <section>
                    <article class="the-blurb">
                        <div class="col-1-2">
                            <h3>About <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span></h3>
                            <p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is a tool targeted towards racing cyclists - especially those participating in time trials and other forms Hi-Tech cycling. The app was developed because as a cyclist with very limited training time, I felt there wasn&rsquo;t a tool out there that gave me timely, high quality feedback, such as how my body was responding to various training protocols.</p>
                            <p>Other software products I&rsquo;ve used offer some a degree of efficacy, but none of them quite meet my needs. So with a background in cycling, computer programming and analytical databases &mdash; and with a window of opportunity, I figured - go build one.</p>
                            <h3>Simple to use</h3>
                            <p>I didn&rsquo;t want to clutter up my performance based tool with GPS route, speed/distance and elevation data as: </p>
                            <ol>
                              <li>Much of my valuable training time is spent  indoors on a turbo trainer - so these metrics are largely irrelevant, </li>
                              <li>There are tools that do this very well already, notably <span class="strava">Strava</span> who offer an API which allows connectivity with external apps.  Although <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> doesn&rsquo;t show data normally only associated with outdoor only rides, it does send it to <span class="strava">Strava</span>. </li>
                              <li><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is designed to extend the functionality offered by other systems such as TrainerRoad and Zwift, rather than to replace them. <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> accepts .fit and .tcx file formats. </li>
                            </ol>
                            <h3>Show changes in my  fitness</h3>
                            <p>Having lots of configurable charts is great, but it takes considerable knowledge to interpret the data, and <em>feedforward</em> that information to make real performance gains. I&rsquo;ve read most of the books out there on the subject of cycling performance and training, but I still feel that none of the prescribed methodologies quite fits my own unique body, in fact - the more I read, the slower I became. I&rsquo;m a believer that everyone is different and responds quite differently to various stimuli - I know for instance, that I struggle to recover at the rate suggested by most training plans - usually resulting in overtraining. That is why I created the <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> performance chart. The tool shows correlations between heart rate and power - so you <em>do</em> need a power measuring device of some sort. Originally this chart plotted average heart rate against average power, useful to know, but a bit limited. I&rsquo;m always trying to find new ways to refine and improve <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>, and so added:</p>
                            <ul>
                              <li>Average cadence to show correlations between cadence and power over time </li>
                              <li>Notable performance indicators. This is at the heart of the <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> system - it looks at the Critical Power for the ride via a user selected filter e.g. CP20, and compares with previous rides. Riders can choose how notable a performance should be before the icon is displayed from their settings. Increasing CP is good news, but can be <em>great</em> news if also indicated by a lower heart rate.</li>
                              <li>A series of advanced filters allowing the rider to compare like-for-like performances. These include the ride&rsquo;s duration, whether it was indoors or outdoors, and whether or not it was a competitive ride. The filters make it much easier to visualise genuine trends in performance. An additional filter allows a quick comparison or a previous period of equal duration. </li>
                             <li>Regression (trend) lines for all plots - scatter charts are far more useful when the average trend is calculated for you. Diverging heart rate and power trend lines over time indicate an improvement in aerobic fitness. </li>
                              <li>Tabular format data - this makes it easier to view the actual figures over time. </li>
                            </ul>
                            <p>Since implementing the latest version of the performance chart, my own performance (20Minute CP) is starting to improve. The Performance Chart enables me &mdash; in a relatively short space of time - to test out the efficacy of different training strategies. You can view my data in the demo, but please don&rsquo;t laugh <em>too</em> loudly at my power figures…</p>
                            <h3>Training Impact</h3>
                            <p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> has a graphical display of fitness and fatigue (CTL, ATL and TSB) similar to that found on many other systems. If you have a power meter failure, or ride without a power meter sometimes then either the training load is calculated from heart rate or you can add your own value. Rider set value takes precedence over power based value which in turn takes precedence over any heart rate based value. When saving an activity the rider can set the motivation level and perceived effort for the ride, and this is plotted against the training load chart data. There is scope for doing something rather more useful with this data at some point.</p>
                        </div>
                        <div class="col-1-2">
                            <h3>Quick view  Dashboard</h3>
                            <p>Just want to view how much riding you&rsquo;ve done for the week so far, and of what type? The Dashboard gives a quick glance view of current form, fitness and fatigue with cumulative training load, duration, and time recorded in each heart rate / power zone.</p>
                            <h3>Other useful data</h3>
                            <p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> has a further range of graphs for historical analysis including</p>
                            <ol>
                              <li>Mean Maximal Power chart - shows the best CP generated (and when) for the current period against the two previous periods</li>
                              <li>Training  Load vs Duration, plots weekly cumulative (or monthly when more than 366 days selected). </li>
                              <li>Heart rate by Zone and Power by Zone charts show cumalative weekly/monthly (as above) breakdown of time in zones, I want to create user settable zones at some point soon &mdash; for now they are based on popular calculations from threshold power and heart rate values. </li>
                            </ol>
                            <p>Although the main purpose of <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is not analysis on a per-ride basis, it&rsquo;s still useful to pore over our ride data including:</p>
                            <ol>
                              <li>Ride summary including: duration, av. power/hr/cadence, intensity %, Training load, work done/energy used (Power based value take precedence over Heart based value). </li>
                              <li>Lap summaries including: duration, av. power/hr/cadence </li>
                              <li>Intensity % Power and Heart rate quick view dials </li>
                              <li>Activity overview showing graph of Power, heart rate and cadence over time - rider can choose how to handle dropouts in data etc. The rider can select sections of the ride to show power heart rate and cadence for the selected region. </li>
                            </ol>
                            <h3>Accessible via the  web</h3>
                            <p>I sometimes feel as if I am of no fixed abode. My bike and turbo travel with me, or failing that I attend spin classes. Wherever I am, whatever computer I&rsquo;m on, I want to be able to upload and view my ride data.</p>
                            <h3>Socialising</h3>
                            <p>Many successful apps are such because they are social. I haven&rsquo;t decided if a social feature - perhaps CP/Kg leaderboards or other social features would be useful or whether they would detract from the core functionality.</p>
                            <h3>Bugs and new  features / feature requests</h3>
                            <p>It&rsquo;s difficult choosing whether to devote time to testing existing functionality, or adding new features (which can often introduce new issues), but I <em>try</em> to get it right! If you do find issues, please contact me as I want to know about them! It would be great to hear rider&rsquo;s requests for new features - every rider has different requirements and it would make sense to incorporate as many of these as I can! <br />
                             Note: I don&rsquo;t intend supporting older browsers, and as <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> makes use of various technologies, it won&rsquo;t work without cookies being enabled.</p>
                            <h3>Cost</h3>
                            <p>Many of the advantages of using this system are genuinely available for no cost. Hosting requirements for an app of this type are much higher than for a normal website service due to the huge data processing requirement. This can get very expensive if we are to keep things moving freely. Those who subscribe will get an unlimited view of their ride data. <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> has been in development for a considerable amount of time - I have to balance this with paying the bills and so uptake of subscriptions will also determine future development plans. This is a relatively specialised environment for a particular type of cyclist. <br />
                             If there are any passionate developer-cyclists or even cyclist-marketers out there who&rsquo;d like to partner up and share the load, contact me!</p>
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
                            <span class="note" style="margin-bottom:50px"><strong>The demonstration below</strong> shows a <em>subset</em> of <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span>'s</span> functionality. It allows you to slice and dice your ride data many ways - you may show up to 90 days in the free version. The demo features my own data (warts and all), there's a couple of years worth in there - however, as I'm always adding new features the later activities contain more information... It's just best to have a play around and see what you can reveal(!).  You can switch the <a href="http://joulepersecond.com/index.php/theme?ret=">theme</a> too!<br>&nbsp;<br><b>Have Fun!</b> - <a href="https://www.strava.com/athletes/exmoorbiker"><em>Jeremy</em></a></span>
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
        