<?php
/**
 * Add Bootstrap style and shortcodes to editor.
 * 
 */
class Beam_Bootstrap 
{
	function __construct() 
	{
		// Move wpautop filter to AFTER shortcode is processed.
		remove_filter( 'the_content', 'wpautop' );
		add_filter( 'the_content', 'wpautop' , 99);
		add_filter( 'the_content', 'shortcode_unautop',100 );

		// Modify Tinymce editor.
		add_filter( 'mce_external_plugins', array($this, 'add_external_plugins') );
		add_filter( 'mce_buttons_3', array($this, 'add_buttons_3') );
		add_filter( 'tiny_mce_before_init', array($this, 'mce_before_init') );
		
		// Add Bootstrap shortcodes.
		add_filter( 'init', array($this, 'add_shortcodes') );
	}
	
	/**
	 * Add plugins to Tinymce editor.
	 * 
	 * @return string
	 */
	function add_external_plugins()
	{
		$plugins = array('table'); //Add any more plugins you want to load here

		$plugins_array = array();

		//Build the response - the key is the plugin name, value is the URL to the plugin JS
		foreach ($plugins as $plugin ) {
			$plugins_array[ $plugin ] = site_url() . get_template_directory_uri() . '/assets/js/tinymce_plugins/' . $plugin . '/editor_plugin.js';
		}

		return $plugins_array;
	}
	
	/**
	 * Add buttons to tinymce toolbar 3.
	 * 
	 * @param array $buttons
	 * @return string
	 */
	function add_buttons_3($buttons)
	{
		$buttons[] = 'tablecontrols';
		return $buttons;
	}

	/**
	 * Add Bootstrap block format & styles.
	 * 
	 * @param array $settings
	 * @return array
	 */
	function mce_before_init( $settings ) 
	{
		// Add table and row styles.
		$settings['table_styles'] = 'Basic Table=table;Striped Table=table table-striped;Bordered Table=table table-bordered;Hover Table=table table-hover;Condensed Table=table table-condensed';
		$settings['table_row_styles'] = 'Success Row=success;Error Row=error;Warning Row=warning;Info Row=info';
		
		// Modify alignment with Bootstrap classes.
		$formats = array(
			'alignleft'		=> array(
				array(
					'selector'	=> 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
					'classes'	=> 'text-left'
				),
				array(
					'selector'	=> 'img,table',
					'classes'	=> 'alignleft'
				)
			),
			'aligncenter'	=> array(
				array(
					'selector'	=> 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', 
					'classes'	=> 'text-center'
				),
				array(
					'selector'	=> 'img,table',
					'classes'	=> 'aligncenter'
				)
			),
			'alignright'	=> array(
				array(
					'selector'	=> 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
					'classes'	=> 'text-right'
				),
				array(
					'selector'	=> 'img,table',
					'classes'	=> 'alignright'
				),
				array(
					'selector'	=> 'blockquote',
					'classes'	=> 'pull-right'
				)
			),
			'strikethrough'	=> array(
				'inline'	=> 'del'
			)
		);
		$settings['formats'] = json_encode($formats);
		
		$settings['theme_advanced_blockformats'] = 'p,pre,h2,h3,h4,h5,h6,address';
		
		// Add style drop down.
		$settings['theme_advanced_buttons2'] = 'styleselect,' . $settings['theme_advanced_buttons2'];
		
		$style_formats = array(
			array(
				'title'		=> 'Lead Body Copy',
				'block'		=> 'p',
				'classes'	=> 'lead'
			),
			array(
				'title'		=> 'Small',
				'inline'	=> 'small'
			),
			array(
				'title'		=> 'Muted',
				'block'		=> 'p',
				'classes'	=> 'muted'
			),
			array(
				'title'		=> 'Warning',
				'block'		=> 'p',
				'classes'	=> 'text-warning'
			),
			array(
				'title'		=> 'Error',
				'block'		=> 'p',
				'classes'	=> 'text-error'
			),
			array(
				'title'		=> 'Info',
				'block'		=> 'p',
				'classes'	=> 'text-info'
			),
			array(
				'title'		=> 'Success',
				'block'		=> 'p',
				'classes'	=> 'text-success'
			),
			array(
				'title'		=> 'Unstyled List',
				'selector'	=> 'ul',
				'classes'	=> 'unstyled'
			),
			array(
				'title'		=> 'Inline List',
				'selector'	=> 'ul',
				'classes'	=> 'inline'
			),
			array(
				'title'		=> 'Code',
				'inline'	=> 'code'
			),
			array(
				'title'		=> 'Pre Scrollable',
				'selector'	=> 'pre',
				'classes'	=> 'pre-scrollable'
			),
			array(
				'title'		=> 'Button',
				'selector'	=> 'a',
				'classes'	=> 'btn'
			),
			array(
				'title'		=> 'Button Primary',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-primary'
			),
			array(
				'title'		=> 'Button Info',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-info'
			),
			array(
				'title'		=> 'Button Success',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-success'
			),
			array(
				'title'		=> 'Button Warning',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-warning'
			),
			array(
				'title'		=> 'Button Danger',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-danger'
			),
			array(
				'title'		=> 'Button Inverse',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-inverse'
			),
			array(
				'title'		=> 'Button Link',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-link'
			),
			array(
				'title'		=> 'Button Large',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-large'
			),
			array(
				'title'		=> 'Button Small',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-small'
			),
			array(
				'title'		=> 'Button Mini',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-mini'
			),
			array(
				'title'		=> 'Button Block',
				'selector'	=> 'a',
				'classes'	=> 'btn btn-block'
			),
			array(
				'title'		=> 'Image Rounded',
				'selector'	=> 'img',
				'classes'	=> 'img-rounded'
			),
			array(
				'title'		=> 'Image Circle',
				'selector'	=> 'img',
				'classes'	=> 'img-circle'
			),
			array(
				'title'		=> 'Image Polaroid',
				'selector'	=> 'img',
				'classes'	=> 'img-polaroid'
			),
			array(
				'title'		=> 'Table',
				'selector'	=> 'table',
				'classes'	=> 'table'
			),
			array(
				'title'		=> 'Table Striped',
				'selector'	=> 'table',
				'classes'	=> 'table table-striped'
			),
			array(
				'title'		=> 'Table Bordered',
				'selector'	=> 'table',
				'classes'	=> 'table table-bordered'
			),
			array(
				'title'		=> 'Table Hover',
				'selector'	=> 'table',
				'classes'	=> 'table table-hover'
			),
			array(
				'title'		=> 'Table Condensed',
				'selector'	=> 'table',
				'classes'	=> 'table table-condensed'
			),
			array(
				'title'		=> 'Row Success',
				'selector'	=> 'tr',
				'classes'	=> 'success'
			),
			array(
				'title'		=> 'Row Error',
				'selector'	=> 'tr',
				'classes'	=> 'error'
			),
			array(
				'title'		=> 'Row Warning',
				'selector'	=> 'tr',
				'classes'	=> 'warning'
			),
			array(
				'title'		=> 'Row Info',
				'selector'	=> 'tr',
				'classes'	=> 'info'
			)
		);
		$settings['style_formats'] = json_encode($style_formats);
//		var_dump($settings);
		return $settings;
	}
	
	/**
	 * Add Bootstrap shortcodes.
	 * 
	 */
	function add_shortcodes()
	{
		add_shortcode('row', array( $this, 'bs_row' ));
		add_shortcode('span', array( $this, 'bs_span' ));
		add_shortcode('abbr', array( $this, 'bs_abbr' ));
		add_shortcode('cite', array( $this, 'bs_cite' ));
		add_shortcode('dl', array( $this, 'bs_dl' ));
		add_shortcode('dt', array( $this, 'bs_dt' ));
		add_shortcode('dd', array( $this, 'bs_dd' ));
		add_shortcode('button', array( $this, 'bs_button' ));    
//		add_shortcode('alert', array( $this, 'bs_alert' ));
//		add_shortcode('code', array( $this, 'bs_code' ));
//		add_shortcode('label', array( $this, 'bs_label' ));
//		add_shortcode('badge', array( $this, 'bs_badge' ));
		add_shortcode('icon', array( $this, 'bs_icon' ));
		add_shortcode('icon_white', array( $this, 'bs_icon_white' ));
//		add_shortcode('table', array( $this, 'bs_table' ));
//		add_shortcode('collapsibles', array( $this, 'bs_collapsibles' ));
//		add_shortcode('collapse', array( $this, 'bs_collapse' ));
//		add_shortcode('well', array( $this, 'bs_well' ));
//		add_shortcode('tabs', array( $this, 'bs_tabs' ));
//		add_shortcode('tab', array( $this, 'bs_tab' ));
		add_shortcode('holder', array( $this, 'bs_holder' ));
	}
	
	/**
	 * Grid row fluid.
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_row( $atts, $content = null )
	{
		return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';
	}
	
	/**
	 * Grid span & offset
	 * 
	 * $atts params:
	 * size: span size (1..12)
	 * offset: span offset size (1..11)
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_span( $atts, $content = null )
	{
		extract(shortcode_atts(array(
			'size' => '1',
			'offset' => ''
		), $atts));

		$class = 'span' . $size;
		if (!empty($offset))
			$class .= ' offset' . $offset;
		
		return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	/**
	 * Add abbreviation (<abbr>) tag.
	 * 
	 * $atts params:
	 * title: title attribute.
	 * initialism: Add .initialism to an abbreviation for a slightly smaller font-size.
	 *  
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_abbr( $atts, $content = null )
	{
		extract(shortcode_atts(array(
			'title' => '',
			'initialism' => ''
		), $atts));
		
		$class = '';
		if (!empty($initialism))
			$class = 'class="initialism"';

		return '<abbr title="' . $title . '" ' . $class . '>' . do_shortcode($content) . '</abbr>';
	}
	
	/**
	 * Wrap the name of the source work in <cite>.
	 * 
	 * $atts params:
	 * title: title attribute.
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_cite( $atts, $content = null )
	{
		extract(shortcode_atts(array(
			'title' => '',
		), $atts));
		
		return '<cite title="' . $title . '">' . do_shortcode($content) . '</cite>';
	}
	
	/**
	 * Add a list of terms with their associated descriptions with <dl>.
	 * 
	 * $atts params:
	 * dl_horizontal: Make terms and descriptions in <dl> line up side-by-side.
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_dl( $atts, $content = null )
	{
		extract(shortcode_atts(array(
			'dl_horizontal' => '',
		), $atts));
		
		$class = '';
		if (!empty($dl_horizontal))
			$class = 'class="dl-horizontal"';
		
		return '<dl ' . $class . '>' . do_shortcode( $content ) . '</dl>';
	}
	
	/**
	 * Add terms with <dt>.
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_dt( $atts, $content = null )
	{
		return '<dt>' . do_shortcode( $content ) . '</dt>';
	}
	
	/**
	 * Add term's description with <dd>.
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_dd( $atts, $content = null )
	{
		return '<dd>' . do_shortcode( $content ) . '</dd>';
	}
	
	function bs_button( $atts, $content = null )
	{
		
	}
	
	/**
	 * Display icons.
	 * 
	 * $atts params:
	 * type: Icon type.
	 * 
	 * @param array $atts
	 * @return string
	 */
	function bs_icon( $atts )
	{
		extract(shortcode_atts(array(
			'type' => '',
		), $atts));
		
		return '<i class="icon icon-' . $type . '"></i>';
	}
	
	/**
	 * Display white icons.
	 * 
	 * $atts params:
	 * type: Icon type.
	 * 
	 * @param array $atts
	 * @return string
	 */
	function bs_icon_white( $atts )
	{
		extract(shortcode_atts(array(
			'type' => '',
		), $atts));
		
		return '<i class="icon icon-' . $type . ' icon-white"></i>';
	}
	
	/**
	 * Add image placeholder with holder.js
	 * 
	 * @link https://github.com/imsky/holder 
	 * @param array $atts
	 * @return string
	 */
	function bs_holder( $atts )
	{
		extract(shortcode_atts(array(
			'dimension' => '200x300',
			'theme' => '',
			'colors' => '',
			'text' => '',
			'class' => ''
		), $atts));
		
		$attributes = 'data-src="holder.js/' . $dimension;
		if (!empty($theme)) $attributes .= '/' . $theme;
		if (!empty($colors)) $attributes .= '/' . $colors;
		if (!empty($text)) $attributes .= '/text:' . $text;
		$attributes .= '"';
		
		if (!empty($class)) $attributes .= ' class="' . $class . '"';
		
		return '<img ' . $attributes . '>';
	}
}

new Beam_Bootstrap();
