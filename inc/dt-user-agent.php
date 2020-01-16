<?php

if (get_option('dt_user_agent_switch')) {

	$ditto_user_agent[0] = $_SERVER['HTTP_USER_AGENT'];

	function getOS() { 
	    global $ditto_user_agent;
	    $os_platform  = "Unknown OS Platform";
	    $os_array     = array(
	                          '/windows nt 10/i'      =>  'Windows 10',
	                          '/windows nt 6.3/i'     =>  'Windows 8.1',
	                          '/windows nt 6.2/i'     =>  'Windows 8',
	                          '/windows nt 6.1/i'     =>  'Windows 7',
	                          '/windows nt 6.0/i'     =>  'Windows Vista',
	                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	                          '/windows nt 5.1/i'     =>  'Windows XP',
	                          '/windows xp/i'         =>  'Windows XP',
	                          '/windows nt 5.0/i'     =>  'Windows 2000',
	                          '/windows me/i'         =>  'Windows ME',
	                          '/win98/i'              =>  'Windows 98',
	                          '/win95/i'              =>  'Windows 95',
	                          '/win16/i'              =>  'Windows 3.11',
	                          '/macintosh|mac os x/i' =>  'Mac OS X',
	                          '/mac_powerpc/i'        =>  'Mac OS 9',
	                          '/linux/i'              =>  'Linux',
	                          '/ubuntu/i'             =>  'Ubuntu',
	                          '/iphone/i'             =>  'iPhone',
	                          '/ipod/i'               =>  'iPod',
	                          '/ipad/i'               =>  'iPad',
	                          '/android/i'            =>  'Android',
	                          '/blackberry/i'         =>  'BlackBerry',
	                          '/webos/i'              =>  'Mobile'
	                    );
	    foreach ($os_array as $regex => $value)
	        if (preg_match($regex, $ditto_user_agent[0]))
	            $os_platform = $value;
	    return $os_platform;
	}

	function getBrowser() {
	    global $ditto_user_agent;
	    $browser = "Unknown Browser";
	    $browser_array = array(
	                            '/msie/i'      => 'Internet Explorer',
	                            '/firefox/i'   => 'Firefox',
	                            '/safari/i'    => 'Safari',
	                            '/chrome/i'    => 'Chrome',
	                            '/edge/i'      => 'Edge',
	                            '/opera/i'     => 'Opera',
	                            '/netscape/i'  => 'Netscape',
	                            '/maxthon/i'   => 'Maxthon',
	                            '/konqueror/i' => 'Konqueror',
	                            '/mobile/i'    => 'Handheld Browser'
	                     );
	    foreach ($browser_array as $regex => $value)
	        if (preg_match($regex, $ditto_user_agent[0]))
	            $browser = $value;
	    return $browser;
	}

	$ditto_user_agent[1] = getOS();
	$ditto_user_agent[2] = getBrowser();

	function ditto_user_agent_enqueue() { ?>
		<?php global $ditto_user_agent; ?>
	    <script type="text/javascript">
	    	document.addEventListener("DOMContentLoaded", function(event) { 
		    	document.getElementsByTagName("body")[0].setAttribute("current-os", "<?php echo $ditto_user_agent[1]; ?>");
		    	document.getElementsByTagName("body")[0].setAttribute("current-browser", "<?php echo $ditto_user_agent[2]; ?>");
			});
	    </script>
	<?php }

	add_action('wp_enqueue_scripts', 'ditto_user_agent_enqueue');

}
?>