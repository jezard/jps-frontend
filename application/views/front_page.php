
    <div class="grid grid-pad homepage">
    	<h1 class="primary-heading desktop jps-em">This is <span>Joule</span><span>Per</span><span>Second</span>!</h1>
    </div>
    <div class="intro grid gridpad">
        <div class="col-1-4"><div class="fp-ride"></div>Ride</div>
        <div class="col-1-4"><div class="fp-upload"></div>Upload</div>
        <div class="col-1-4"><div class="fp-engage"></div>Engage</div>
        <div class="col-1-4"><div class="fp-learn"></div>Learn</div>
    </div>
    <div class="grid grid-pad homepage">
		<section class="section-ln">
            <h1 class="mobile jps-em">This is <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>!</h1>
			<article class="blurb">
				<h2>What is <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>?</h2>
				<div class="col-1-2">
					
					<h3 class="home-h3"><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/objectives.png" alt="icon" /><span>Objectives</span></h3>
					<div class="content-container" style="background-image: url(<?php echo $this->config->item('base_url'); ?>/images/background-icons/objectives.png)" >
						<p><strong><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is an analytical fitness tool for amateur and professional cyclists</strong>. Our Primary goal: To provide a decision support system for helping you planning your training rides – what to do and when to do it, and maximise the benefit for each hour spent training, so that you can be at your peak fitness when you need to be.  Put another way, we provide the tools which will help you to go faster when it counts.</p>
						<p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> provides you as a cyclist with some very useful features – but there's a lot to do before we can begin to say we're done! – wed like your input – what are your requirements for perfect cycling analytics? Tell us <a href="/index.php/forum">here</a>. Popular requests are likely candidates for early implementation. <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is a tool for Cyclists, made by Cyclists. We read the forums and it confirmed our feelings that there must be a better way. That is why we created <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>.</p>
						<p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is about showing performance data rather that where you've been or who you've beaten on a certain stretch of road. Many of us spend hours and hours cycling indoors, and <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is particularly useful when extending the analysis provided by other systems such as <a href="http://www.trainerroad.com">TrainerRoad</a>, whilst merging in other outdoor training and race data.</p><p><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> is based on the <em>Freemium</em> subscription model - it's <strong><em>free</em></strong> to use, but you may wish to upgrade at some stage for more features.</p>
					</div>
					<h3 class="home-h3"><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/whats-watt.png" alt="icon" /><span><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span>? Watt's with that?!</span></h3>
					<div class="content-container" >
						<p>For those that don't know, one Joule per Second is one Watt, the commonly used unit of power in many applications including cycling. Our web app is best suited to those who use a power meter, although we use algorithms based on heart rate when riding a bike without a power meter (or attend a spin class), and our power meter batteries die - we allow a manual override of the training load for an activity, so as not to render training load charts useless when disaster strikes.</p>
					</div>
					<h3 class="home-h3"><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/bug-fixing.png" alt="icon" /><span>Bleeding edge development...</span></h3>
					<div class="content-container" style="background-image: url(<?php echo $this->config->item('base_url'); ?>/images/background-icons/bug-fixing.png)">
						<p>With all new developments there is a possibility of finding a bug or issue, but hopefully we've ironed out all the serious ones! However we really like you to report any problems either in the forum or email us <a href="mailto:admin@joulepersecond.com?subject=Issue%20found">here</a>. </p>
						<p>All of our systems are securely located in 'The Cloud'. And as running servers that are powerful enough to run a resource hungry application like <span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> aren't cheap, we plan to scale up and out as demand increases. While new and small, spikes in requests for processing resources might occasionally become noticeable to you the user - if you should have difficulty - please try a few minutes later. We will be monitoring usage and scaling our resources accordingly.</p>
						<p>There isn't much of a social function yet although this is very important to us, we consider getting the basic app running first priority, but sharing (and showing off!) of your rides is next on our agenda. Other items to implement at the top of our hit list can be found on the <a href="https://trello.com/b/yphccBWK/fixes-and-minor-improvements" target="_blank"><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span> page at Trello.com</a><br>&nbsp<br><span class="note"><strong>PS </strong>&mdash; It'd be rather handy to copy our ride data to <strong><em><a href="https://www.strava.com/clubs/JoulePerSecond" target="_blank">Strava</a></em></strong> when uploading too!</span>				        </p>
				  </div>
				</div>
				<div class="col-1-2">
					<h3 class="home-h3"><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/technical.png" alt="icon" /><span>Technical information</span></h3>
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
                    <h3 class="home-h3"><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/wt-logo.png" alt="icon" /><span>Powered by Wizard Technology</span></h3>
                    <div class="content-container">
                        <a href="http://wizard.technology"><img src="<?php echo $this->config->item('base_url'); ?>/images/wt-logo.png" alt="Wizard Technology logo" width="130"/></a>
                        <p><a href="<?php echo $this->config->item('base_url'); ?>"><span class="jps-em"><span>Joule</span><span>Per</span><span>Second</span></span></a> is designed and built by <a href="http://wizard.technology">Wizard Technology</a>. View the development <a href="http://wizard.technology/projects/peak-power-wizard/">here</a>.</p>
                    </div>
                    <h3 class="home-h3"><img src="<?php echo $this->config->item('base_url'); ?>/images/h3-icons/jps-logo.png" alt="icon" /><span>Our brand</span></h3>
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