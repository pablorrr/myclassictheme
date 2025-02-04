<?php
/**
 * Register the required plugins for this theme.
 *
 */

function myclassictheme_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

		array(
		    'name' => 'Create Block Theme',
		    'slug' => 'create-block-theme',
		    'required' => true,
	    ),
    
		// Woocommerce including as required
        array(
            'name' => 'Woocommerce',
            'slug' => 'woocommerce',
            'required' => true,
        ),


        array(
            'name' => 'WordPress SEO by Yoast',
            'slug' => 'wordpress-seo',
            'is_callable' => 'wpseo_init',
        ),

        array(
            'name' => 'GDPR Cookie Consent',
            'slug' => 'cookie-law-info',
            'required' => false,
        ),


        array(
            'name' => 'WordPress HTTPS',
            'slug' => 'wordpress-https',
            'required' => false,
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'myclassictheme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true,                    // Show admin notices or not.
        'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',             // If'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message' => '',                      // Message to output right before the plugins table.


    );

    tgmpa($plugins, $config);
}
