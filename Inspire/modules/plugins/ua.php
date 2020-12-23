<?php
/**
 * Theme UA function file
 * @package Louie
 * @since Theme version 1.0.0
 */
function get_browsers_info( $ua ){
	$title = 'unknow';
	$icon = 'unknow'; 
	if ( preg_match( '#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'Internet Explorer '. $matches[1];
		if ( strpos($matches[1], '7' ) !== false || strpos( $matches[1], '8' ) !== false )
			$icon = 'ie8';
		elseif ( strpos($matches[1], '9') !== false )
			$icon = 'ie9';
		elseif ( strpos($matches[1], '10') !== false )
			$icon = 'ie10';
		else
			$icon = 'ie';
	} elseif ( preg_match( '#Edge/([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'Microsoft Edge '. $matches[1];
		$icon = 'edge';
  	}
	elseif ( preg_match( '#Firefox/([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'Firefox '. $matches[1];
		$icon = 'firefox';
	}
	elseif ( preg_match( '#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'Chrome for iOS '. $matches[1];
		$icon = 'crios';
	}
	elseif ( preg_match( '#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'Google Chrome '. $matches[1];
		$icon = 'chrome';
		if ( preg_match( '#OPR/([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
			$title = 'Opera '. $matches[1];
			$icon = 'opera15';
			if ( preg_match('#opera mini#i', $ua ) )
				$title = 'Opera Mini'. $matches[1];
		}
	}
	elseif ( preg_match( '#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'Safari '. $matches[1];
		$icon = 'safari';
	}
	elseif ( preg_match('#Opera.(.*)Version[ /]([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'Opera '. $matches[2];
		$icon = 'opera';
		if (preg_match('#opera mini#i', $ua))
			$title = 'Opera Mini'. $matches[2];   
	}
	elseif ( preg_match( '#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'Maxthon '. $matches[2];
		$icon = 'maxthon';
	}
	elseif ( preg_match( '#360([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = '360 Browser '. $matches[1];
		$icon = '360se';
	}
	elseif ( preg_match( '#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'SouGou Browser 2'.$matches[1];
		$icon = 'sogou';
	}
	elseif ( preg_match( '#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'UCWEB '. $matches[1];
		$icon = 'ucweb';
	}
	elseif ( preg_match( '#wp-(iphone|android)/([a-zA-Z0-9.]+)#i', $ua, $matches ) ) {
		$title = 'wordpress '. $matches[2];
		$icon = 'wordpress';
	}

	return array( $title, $icon );
}

function get_os_info( $ua ) {
	$title = 'unknow';
	$icon = 'unknow';
	if ( preg_match('/win/i', $ua) ) {
		if ( preg_match( '/Windows NT 10.0/i', $ua ) ) {
			$title = "Windows 10";
			$icon = "windows_win10";
		} elseif ( preg_match( '/Windows NT 6.1/i', $ua ) ) {
			$title = "Windows 7";
			$icon = "windows_win7";
		} elseif ( preg_match( '/Windows NT 5.1/i', $ua ) ) {
			$title = "Windows XP";
			$icon = "windows";
		} elseif ( preg_match( '/Windows NT 6.2/i', $ua ) ) {
			$title = "Windows 8";
			$icon = "windows_win8";
		} elseif ( preg_match( '/Windows NT 6.3/i', $ua ) ) {
			$title = "Windows 8.1";
			$icon = "windows_win8";
		} elseif ( preg_match( '/Windows NT 6.0/i', $ua ) ) {
			$title = "Windows Vista";
			$icon = "windows_vista";
		} elseif ( preg_match( '/Windows NT 5.2/i', $ua ) ) {
			if ( preg_match( '/Win64/i', $ua ) )
				$title = "Windows XP 64 bit";
			else
				$title = "Windows Server 2003";

			$icon = 'windows';
		} elseif ( preg_match('/Windows Phone/i', $ua ) ) {
			$matches = explode(';',$ua);
			$title = $matches[2];
			$icon = "windows_phone";
		}
	}
	elseif ( preg_match( '#iPod.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches ) ) {
		$title = "iPod ".$matches[1];
		$icon = "iphone";
	}
	elseif ( preg_match( '#iPhone OS ([a-zA-Z0-9.( _)]+)#i', $ua, $matches ) ) {
		$title = "Iphone ".$matches[1];
		$icon = "iphone";
	}
	elseif ( preg_match( '#iPad.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches ) ) {
		$title = "iPad ".$matches[1];
		$icon = "ipad";
	}
	elseif ( preg_match( '/Mac OS X.([0-9. _]+)/i', $ua, $matches ) ) {
		if( count( explode( 7,$matches[1] ) ) > 1 )
			$matches[1] = 'Lion '.$matches[1];

		elseif( count( explode( 8,$matches[1] ) ) > 1 )
			$matches[1] = 'Mountain Lion '.$matches[1];

		$title = "Mac OSX ".$matches[1];
		$icon = "macos";
	}
	elseif ( preg_match( '/Macintosh/i', $ua ) ) {
		$title = "Mac OS";
		$icon = "macos";
	}
	elseif ( preg_match( '/CrOS/i', $ua ) ){
		$title = "Google Chrome OS";
		$icon = "chrome";
	}
	elseif ( preg_match( '/Linux/i', $ua ) ) {
		$title = 'Linux';
		$icon = 'linux';
		if ( preg_match( '/Android.([0-9. _]+)/i', $ua, $matches ) ) {
			$title= $matches[0];
			$icon = "android";
		} elseif ( preg_match( '#Ubuntu#i', $ua ) ) {
			$title = "Ubuntu Linux";
			$icon = "ubuntu";
		} elseif ( preg_match( '#Debian#i', $ua ) ) {
			$title = "Debian GNU/Linux";
			$icon = "debian";
		} elseif ( preg_match( '#Fedora#i', $ua ) ) {
			$title = "Fedora Linux";
			$icon = "fedora";
		}
	}

	return array( $title, $icon );
}

function useragent( $ua ) {
	$state = cs_get_option( 'useragent' );
	if( $state ) {
		$browser = get_browsers_info( $ua );
		$os = get_os_info( $ua );
		return '<div class="useragent-info">来自 '. $browser[0] .' in '. $os[0] .'</div>';
	}

	return false;
}