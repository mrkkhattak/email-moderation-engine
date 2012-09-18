<?php
/**
 * This class provides some db and other util functions
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

class Utils {
	
	/**
	 * Find out the file length via http header
	 * 
	 * @return int $x
	 */
	
	protected function getFileSize($url) {
	    if (substr($url,0,4)=='http') {
	        $x = array_change_key_case(get_headers($url, 1),CASE_LOWER);
	        if ( strcasecmp($x[0], 'HTTP/1.1 200 OK') != 0 ) { $x = $x['content-length'][1]; }
	        else { $x = $x['content-length']; }
	    }
	    else { $x = @filesize($url); }
	
	    return $x;
	}	
	
	/**
	 * Prints version on screen 
	 */
	
	public static function getVersion(){
		echo "EME - version " . VERSION ."\n\n";
	}
	
    /**
     * Redirect to another URL
     *
     * @param string $url
     */
    public static function redirect($url){
        // prevent header injections
        $url = str_replace(array("\n", "\r"), '', $url);

        // redirect
        header("Location: $url");
        exit();
    }

    /**
     * Get user id of the logged in user
     *
     * @return numeric user_id
     */
    
    public static function getLoggedInUser(){
		if (isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == true){
			return $_SESSION["user_id"];
		}    	
    }
    
    /**
     * Prints header
     *
     * @param string $page
     */
    
    public static function getHeader($page){
		echo '<!DOCTYPE html>';
		echo '<head>';
		echo '<meta charset="UTF-8" />';
		echo '<title>Email Moderation Engine - '. $page .'</title>';
		echo '<link rel="profile" href="http://gmpg.org/xfn/11" />';
		echo '<link rel="stylesheet" type="text/css" media="all" href="'. APP_URL.'templates/css/style.css" />';
		echo '<!--[if lt IE 9]>';
		echo '<script src="js/html5.js" type="text/javascript"></script>';
		echo '<![endif]-->';
		echo '</head>';
		echo '<body>';
		echo '<div id="wrapper-container">';
		echo '<div id="wrapper">';
		echo '<div id="header">';
		echo '<div align="center"><h2>EME - Email Moderation Engine</h2></div>';
		echo '</div>';    	
    }

    /**
     * Prints footer
     *
     */
    
    public static function getFooter(){
		echo '<div id="footer">';
		echo 'EME';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</body>';
		echo '</html>';  	
    }
    
    /**
     * Prints menu
     *
     * @param string $menu
     */
    public static function getMenu($menu) {
    	
    	//echo $menu
    	echo '<div id="left-sidebar">';
		echo '<ul id="menu">';
		echo "<li><a href='". APP_URL ."index.php?action=inbox'>Home</a></li>\n";
		echo "<li><a href='". APP_URL ."index.php?action=inbox'>Inbox</a></li>\n";
		echo "<li><a href='". APP_URL ."index.php?action=compose'>Compose</a></li>\n";
		echo "<li><a href='". APP_URL ."index.php?action=settings'>Settings</a></li>\n";
		echo "<li><a href='". APP_URL ."index.php?action=logout'>Logout</a></li>\n";
		echo '</ul>';
		echo '</div>';
    }
    
    
}

?>