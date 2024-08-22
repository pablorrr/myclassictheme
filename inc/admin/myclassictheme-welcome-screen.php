<?php

/**
 * Welcome Screen Class
 * Sets up the welcome screen page, hides the menu item
 * and contains the screen content.
 */
class myclassictheme_Welcome_Screen
{

    /**
     * Constructor
     * Sets up the welcome screen
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'myclassictheme_welcome_register_menu'));
        add_action('admin_notices', array($this, 'myclassictheme_activation_admin_notice'));
        add_action('admin_enqueue_scripts', array($this, 'myclassictheme_welcome_style'));
        add_action('myclassictheme_welcome', array($this, 'myclassictheme_welcome_page'), 10);

    } // end constructor
    /**
     * Load welcome screen css
     * @return void
     * @since  0.1
     */
    public function myclassictheme_welcome_style()
    {
        wp_enqueue_style('myclassicthemewelcome-screen', get_template_directory_uri() . '/inc/admin/css/welcome.css');
    }

    /**
     * Creates the dashboard page
     * @see  add_theme_page()
     * @since 1.0.0
     */
    public function myclassictheme_welcome_register_menu()
    {
        add_theme_page(
            'My Classic Theme Welcome Page',
            'My Classic Theme ',
            'read',
	        'myclassictheme-welcome',
            array($this, 'myclassictheme_welcome_screen')
        );
    }

    /**
     * The welcome screen
     * @since 1.0.0
     */
    public function myclassictheme_welcome_screen()
    {?>
        <div class="wrap about-wrap">
            <?php do_action('myclassictheme_welcome'); ?>
        </div>
        <?php
    }

    public function myclassictheme_welcome_page()
    {
        get_template_part('inc/admin/welcome');
    }

    /**
     * Adds an admin notice upon successful activation.
     * @since 0.1
     */
    public function myclassictheme_activation_admin_notice()
    {
        $noticeClass = 'updated notice is-dismissible';
        $Firstmessage = __('Thanks for choosing My Classic Theme!', 'myclassictheme');
        $hyperLink = admin_url('themes.php?page=myclassictheme-welcome');
        $blankAttr = '_blank';
        $buttonClass = 'button';
        $styleAttr = 'text-decoration: none';
        $Secondmessage = __('Get started with My Classic Theme!', 'myclassictheme');


        printf('<div class="%1$s"><p>%2$s</p><p><a href="%3$s" target="%4$s" class="%5$s" style="%6$s">%7$s</a></p></div>',
            esc_attr($noticeClass), esc_html($Firstmessage), esc_url($hyperLink),
            esc_attr($blankAttr), esc_attr($buttonClass), esc_attr($styleAttr), esc_html($Secondmessage));

    }


}
$GLOBALS['myclassictheme_Welcome_Screen'] = new myclassictheme_Welcome_Screen();
