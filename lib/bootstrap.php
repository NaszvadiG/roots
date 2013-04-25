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
			),
			array(
				'title'		=> 'Nav',
				'selector'	=> 'ul',
				'classes'	=> 'nav'
			),
			array(
				'title'		=> 'Nav Tabs',
				'selector'	=> 'ul',
				'classes'	=> 'nav nav-tabs'
			),
			array(
				'title'		=> 'Nav Pills',
				'selector'	=> 'ul',
				'classes'	=> 'nav nav-pills'
			),
			array(
				'title'		=> 'Nav Stacked',
				'selector'	=> 'ul',
				'classes'	=> 'nav-stacked'
			),
			array(
				'title'		=> 'Nav List',
				'selector'	=> 'ul',
				'classes'	=> 'nav nav-list'
			),
			array(
				'title'		=> 'Nav Header',
				'selector'	=> 'li',
				'classes'	=> 'nav-header'
			),
			array(
				'title'		=> 'Active',
				'selector'	=> 'li',
				'classes'	=> 'active'
			),
			array(
				'title'		=> 'Disabled',
				'selector'	=> 'li',
				'classes'	=> 'disabled'
			),
			array(
				'title'		=> 'Divider',
				'selector'	=> 'li',
				'classes'	=> 'divider'
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
//		add_shortcode('button', array( $this, 'bs_button' ));  
		add_shortcode('dropdown', array( $this, 'bs_dropdown' ));
		add_shortcode('hr', array( $this, 'bs_hr' ));
		add_shortcode('buttongroup', array( $this, 'bs_buttongroup' ));
		add_shortcode('buttontoolbar', array( $this, 'bs_buttontoolbar' ));
		add_shortcode('alert', array( $this, 'bs_alert' ));
//		add_shortcode('code', array( $this, 'bs_code' ));
		add_shortcode('label', array( $this, 'bs_label' ));
		add_shortcode('badge', array( $this, 'bs_badge' ));
		add_shortcode('icon', array( $this, 'bs_icon' ));
		add_shortcode('icon_white', array( $this, 'bs_icon_white' ));
//		add_shortcode('table', array( $this, 'bs_table' ));
//		add_shortcode('collapsibles', array( $this, 'bs_collapsibles' ));
//		add_shortcode('collapse', array( $this, 'bs_collapse' ));
		add_shortcode('well', array( $this, 'bs_well' ));
		add_shortcode('herounit', array( $this, 'bs_herounit' ));
		add_shortcode('thumbnails', array( $this, 'bs_thumbnails' ));
		add_shortcode('thumbnail', array( $this, 'bs_thumbnail' ));
		add_shortcode('tabs', array( $this, 'bs_tabs' ));
		add_shortcode('tab', array( $this, 'bs_tab' ));
		add_shortcode('holder', array( $this, 'bs_holder' ));
	}
	
	/**
	 * Get standard attributes for elements (id, class & style).
	 * 
	 * @param string $el_class
	 * @param array $atts
	 * @return string
	 */
	private function get_atts( $el_class, $atts )
	{
		extract(shortcode_atts(array(
			'id'	=> '',
			'class' => '',
			'style' => ''
		), $atts));
		
		if (!empty($id)) $id = 'id="' . $id . '" ';
		if (!empty($style)) $style = ' style="' . $style . '"';
		return $id . 'class="' . $el_class . ' ' . $class . '"' . $style;
	}
	
	/**
	 * Grid row fluid.
	 * 
	 * $atts params:
	 * fluid: make row fluid (true/false)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_row( $atts, $content = null )
	{
		extract(shortcode_atts(array(
			'fluid' => FALSE
		), $atts));

		$el_class = 'row';
		if ($fluid) {
			$el_class .= '-fluid';
		}
		
		return '<div ' . $this->get_atts($el_class, $atts) . '>' . do_shortcode( $content ) . '</div>';
	}
	
	/**
	 * Grid span & offset
	 * 
	 * $atts params:
	 * size: span size (1..12)
	 * offset: span offset size (1..11)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
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

		$el_class = 'span' . $size;
		if (!empty($offset))
			$el_class .= ' offset' . $offset;
		
		return '<div ' . $this->get_atts($el_class, $atts) . '>' . do_shortcode($content) . '</div>';
	}
	
	/**
	 * Add abbreviation (<abbr>) tag.
	 * 
	 * $atts params:
	 * title: title attribute.
	 * initialism: Add .initialism to an abbreviation for a slightly smaller font-size (true/false).
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 *  
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_abbr( $atts, $content = null )
	{
		extract(shortcode_atts(array(
			'title' => '',
			'initialism' => FALSE
		), $atts));
		
		$el_class = '';
		if ($initialism)
			$el_class = 'initialism';

		return '<abbr title="' . $title . '" ' . $this->get_atts($el_class, $atts) . '>' . do_shortcode($content) . '</abbr>';
	}
	
	/**
	 * Wrap the name of the source work in <cite>.
	 * 
	 * $atts params:
	 * title: title attribute.
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
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
		
		return '<cite title="' . $title . '" ' . $this->get_atts('', $atts) . '>' . do_shortcode($content) . '</cite>';
	}
	
	/**
	 * Add a list of terms with their associated descriptions with <dl>.
	 * 
	 * $atts params:
	 * dl_horizontal: Make terms and descriptions in <dl> line up side-by-side (true/false).
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_dl( $atts, $content = null )
	{
		extract(shortcode_atts(array(
			'dl_horizontal' => FALSE,
		), $atts));
		
		$el_class = '';
		if ($dl_horizontal)
			$el_class = 'dl-horizontal';
		
		return '<dl ' . $this->get_atts($el_class, $atts) . '>' . do_shortcode( $content ) . '</dl>';
	}
	
	/**
	 * Add terms with <dt>.
	 * 
	 * $atts params:
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_dt( $atts, $content = null )
	{
		return '<dt ' . $this->get_atts('', $atts) . '>' . do_shortcode( $content ) . '</dt>';
	}
	
	/**
	 * Add term's description with <dd>.
	 * 
	 * $atts params:
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_dd( $atts, $content = null )
	{
		return '<dd ' . $this->get_atts('', $atts) . '>' . do_shortcode( $content ) . '</dd>';
	}
	
	/**
	 * Add dropdown menu.
	 * 
	 * $atts params:
	 * display: make dropdown menu visible by default (true/false).
	 * dropup: make a menu dropup (true/false).
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_dropdown( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'display' => FALSE,
			'dropup' => FALSE
		), $atts));
		
		$dom = new DOMDocument;
		$dom->loadHTML($content);
		$content = $this->create_dropdown($dom, $atts);
		
		$el_class = '';
		if ($dropup) {
			$el_class = 'dropup';
		} else {
			$el_class = 'dropdown';
		}
		if ($display) {
			$el_class .= ' clearfix';
		}
		return '<div ' . $this->get_atts($el_class, $atts) . '>' . do_shortcode( $content ) . '</div>';
	}
	
	/**
	 * Display hr.
	 * 
	 * $atts params:
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @return string
	 */
	function bs_hr( $atts ) {
		return '<hr ' . $this->get_atts('', $atts) . '/>';
	}
	
	/**
	 * Create button groups.
	 * 
	 * $atts params:
	 * vertical: make a vertical button groups (true/false)
	 * dropup: make a button groups dropup (true/false)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_buttongroup( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'vertical' => FALSE,
			'dropup' => FALSE
		), $atts));
		
		$dom = new DOMDocument;
		$dom->loadHTML($content);
		$xpath = new DOMXPath($dom);
		$el_class = 'btn-group';
		
		if ( $xpath->query('//ul')->length > 0) {
			$content = do_shortcode( $this->create_dropdown($dom, $atts) );
			if ($dropup) {
				$el_class .= ' dropup';
			}
		} else {
			if ($vertical) {
				$el_class .= ' btn-group-vertical';
			}
		}
		return '<div ' . $this->get_atts($el_class, $atts) . '>' . do_shortcode($content) . '</div>';
	}
	
	/**
	 * Create button toolbar.
	 * 
	 * $atts params:
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_buttontoolbar( $atts, $content = null ) {
		return '<div ' . $this->get_atts('btn-toolbar', $atts) . '>' . do_shortcode($content) . '</div>';
	}
	
	/**
	 * Create dropdown component.
	 * 
	 * @param DOMDocument $dom
	 * @param string $display
	 * @return string
	 */
	private function create_dropdown( $dom, $atts ) {
		extract(shortcode_atts(array(
			'display' => '',
			'split' => '',
			'dropup' => '',
			'left' => '',
			'right' => ''
		), $atts));
		
		$xpath = new DOMXPath($dom);
		
		// Format dropdown-toggle.
		if (empty($split)) {
			foreach ($xpath->query('/html/body/a') as $node) {
				$this->add_class($node, 'dropdown-toggle');
				$node->setAttribute('data-toggle', 'dropdown');
				$node->nodeValue .= ' ';
				$caret = $dom->createElement('span');
				$caret->setAttribute('class', 'caret');
				$node->appendChild($caret);
			}
		} else {
			foreach ($xpath->query('/html/body/a') as $node_a) {
				$class = $node_a->getAttribute('class');
				$uls = $xpath->query('/html/body/ul');
				if ($uls->length > 0) {
					$node_ul = $uls->item(0);
					$split_btn = $dom->createElement('a');
					$split_btn->setAttribute('class', $class . ' dropdown-toggle');
					$split_btn->setAttribute('data-toggle', 'dropdown');
					$caret = $dom->createElement('span');
					$caret->setAttribute('class', 'caret');
					$split_btn->appendChild($caret);
					$xpath->query('/html/body')->item(0)->insertBefore($split_btn, $node_ul);
				}
			}
		}

		// Add .dropdown-submenu class
		foreach ($xpath->query('//li[ul]') as $ulnode) {
			$class = 'dropdown-submenu';
			if (!empty($left)) $class .= ' pull-left';
			$this->add_class($ulnode, $class);
		}

		// Add .dropdown-menu
		foreach ($xpath->query('//ul') as $ulnode) {
			$class = 'dropdown-menu';
			if (!empty($right)) $class .= ' pull-right';
			$this->add_class($ulnode, $class);
			
			if ($ulnode->parentNode->nodeName != 'li') {
				$ulnode->setAttribute('role', 'menu');
				$ulnode->setAttribute('aria-labelledby', 'dlabel');

				if (!empty($display)) {
					$ulnode->setAttribute('style', 'display: block; position: static;');
				}
			}
		}

		// Add .divider class to empty li.
		foreach ($xpath->query('//li[not(node())]') as $linode) {
			$this->add_class($linode, 'divider');
		}

		$this->remove_nodes($dom, 'p');
		$this->remove_nodes($dom, 'br');

		$content = preg_replace('~<(?:!DOCTYPE|/?(?:html|head|body))[^>]*>\s*~i', '', $dom->saveHTML());
		return str_replace("\r\n", "", $content);
	}
	
	/**
	 * Add class to node element.
	 * 
	 * @param DOMNode $node
	 * @param string $class
	 */
	private function add_class($node, $class) {
		$curr_class = '';
		if ($node->hasAttribute('class')) {
			$curr_class = $node->getAttribute('class') . ' ';
		}
		$curr_class .= $class;
		$node->setAttribute('class', $curr_class);
	}
	
	/**
	 * Remove empty elements.
	 * 
	 * @param DOMDocument $dom
	 * @param string $name
	 */
	private function remove_nodes($dom, $name) {
		$xpath = new DOMXPath($dom);
		$deletenodes = array();
		foreach ($xpath->query('//' . $name . '[not(node())]') as $node) {
			$deletenodes[] = $node;
		}
		foreach ($deletenodes as $node) {
			$node->parentNode->removeChild($node);
		}
	}
	
	/**
	 * Display alert.
	 * 
	 * $atts params:
	 * type: alert type (error/success/info)
	 * block: increase the padding on the top and bottom of the alert wrapper (true/false)
	 * close: add close button (true/false)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type'	=> '',
			'block'	=> FALSE,
			'close'	=> FALSE
		), $atts));
		
		$el_class = 'alert';
		if (!empty($type))
			$el_class .= ' alert-' . $type;
		if ($block)
			$el_class .= ' alert-block';
		
		$output = '<div ' . $this->get_atts($el_class, $atts) . '>';
		if ($close)
			$output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		$output .= trim(do_shortcode($content));
		$output .= '</div>';
		return $output;
	}
	
	/**
	 * Apply well to elements.
	 * 
	 * $atts params:
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_well( $atts, $content = '' ) {
		return '<div ' . $this->get_atts('well', $atts) . '>' . do_shortcode($content) . '</div>';
	}
	
	/**
	 * Apply hero unit to elements.
	 * 
	 * $atts params:
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_herounit( $atts, $content = '' ) {
		return '<div ' . $this->get_atts('hero-unit', $atts) . '>' . do_shortcode($content) . '</div>';
	}
	
	/**
	 * Apply thumbnails to elements.
	 * 
	 * $atts params:
	 * fluid: make thumbnails row fluid (true/false)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_thumbnails( $atts, $content = '' ) {
		extract(shortcode_atts(array(
			'fluid' => FALSE
		), $atts));
		
		$class = 'row';
		if ($fluid) $class .= '-fluid';
		
		return '<div class="' . $class . '"><ul ' . $this->get_atts('thumbnails', $atts) . '>' . do_shortcode($content) . '</ul></div>';
	}
	
	/**
	 * Apply thumbnail to elements.
	 * 
	 * $atts params:
	 * span: use existing grid system to control thumbnail dimensions (1..12)
	 * strip: strip new line characters (true/false)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_thumbnail( $atts, $content = '' ) {
		extract(shortcode_atts(array(
			'span'	=> '',
			'strip'	=> FALSE,
		), $atts));
		
		$el_class = '';
		if (!empty($span)) {
			$el_class .= 'span' . $span;
		}
		if ($strip) {
			$content = str_replace("\r\n", "", $content);
		}
		return '<li ' . $this->get_atts($el_class, $atts) . '><div class="thumbnail">' . do_shortcode(trim($content)) . '</div></li>';
	}
	
	/**
	 * Display tabs
	 * 
	 * $atts params:
	 * position: position of tabs (top/left/right/below)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_tabs( $atts, $content = '' ) {
		extract(shortcode_atts(array(
			'position'	=> ''
		), $atts));
		
		if (!isset($GLOBALS['tab-id']))
			$GLOBALS['tab-id'] = 1;
		else
			$GLOBALS['tab-id']++;
		
		$GLOBALS['tabs'] = array();
		$GLOBALS['tab-active'] = '';
		$content = do_shortcode($content);
		
		if (count($GLOBALS['tabs']) == 0) {
			return $content;
		}
		$content = '<div class="tab-content">' . $content . '</div>';
		
		$tabs = '';
		foreach ($GLOBALS['tabs'] as $slug => $title) {
			$activate = '';
			if ($GLOBALS['tab-active'] == $slug) $activate = ' class="active"';
			$tabs .= '<li' . $activate . '><a href="#' . $slug . '" data-toggle="tab">' . $title . '</a></li>';
		}
		$tabs = '<ul class="nav nav-tabs">' . $tabs . '</ul>';
		
		$el_class = 'tabbable';
		if (!empty($position)) {
			$position = strtolower($position);
			$el_class .= ' tabs-' . $position;
		}
		if ($position == 'below')
			return '<div ' . $this->get_atts($el_class, $atts) . '">' . $content . $tabs . '</div>';
		else
			return '<div ' . $this->get_atts($el_class, $atts) . '">' . $tabs . $content . '</div>';
	}
	
	/**
	 * Apply tab to elements.
	 * 
	 * $atts params:
	 * title: tab's title
	 * active: set as active tab (true/false)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_tab( $atts, $content = '' ) {
		extract(shortcode_atts(array(
			'title'		=> 'Tab',
			'active'	=> FALSE
		), $atts));
		$slug = 'tab-' . $GLOBALS['tab-id'] . '-' . sanitize_title( $title );
		$GLOBALS['tabs'][$slug] = $title;
		
		$el_class = 'tab-pane';
		if (strtoupper($active) == 'TRUE') {
			$GLOBALS['tab-active'] = $slug;
			$el_class .= ' active';
		}
		
		return '<div id="' . $slug . '" ' . $this->get_atts($el_class, $atts) . '>' . do_shortcode($content) . '</div>';
	}
	
	/**
	 * Display icons.
	 * 
	 * $atts params:
	 * type: Icon type.
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @return string
	 */
	function bs_icon( $atts )
	{
		extract(shortcode_atts(array(
			'type' => '',
		), $atts));
		
		return '<i ' . $this->get_atts('icon icon-' . $type, $atts) . '></i>';
	}
	
	/**
	 * Display white icons.
	 * 
	 * $atts params:
	 * type: Icon type.
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @return string
	 */
	function bs_icon_white( $atts )	{
		extract(shortcode_atts(array(
			'type' => '',
		), $atts));
		
		return '<i ' . $this->get_atts('icon icon-' . $type . ' icon-white', $atts) . '></i>';
	}
	
	/**
	 * Display labels.
	 * 
	 * $atts params:
	 * type: label type (success/warning/important/info/inverse)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_label( $atts, $content = '' ) {
		extract(shortcode_atts(array(
			'type' => '',
		), $atts));
		
		return '<span ' . $this->get_atts('label label-' . $type, $atts) . '>' . do_shortcode($content) . '</span>';
	}
	
	/**
	 * Display badges.
	 * 
	 * $atts params:
	 * type: badge type (success/warning/important/info/inverse)
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
	 * 
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function bs_badge( $atts, $content = '' ) {
		extract(shortcode_atts(array(
			'type' => '',
		), $atts));
		
		return '<span ' . $this->get_atts('badge badge-' . $type, $atts) . '>' . do_shortcode($content) . '</span>';
	}
	
	/**
	 * Add image placeholder with holder.js
	 * 
	 * $atts params:
	 * dimension: image placeholder dimension (default: 200x300)
	 * theme: set placeholder theme (gray/industrial/social)
	 * colors: set placeholder color (default: #E5E5E5:#EEEEEE)
	 * text: set placeholder text (default: '')
	 * id: element's id
	 * class: additional classes to apply
	 * style: some styles to apply to the element
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
			'text' => ''
		), $atts));
		
		$attributes = 'data-src="holder.js/' . $dimension;
		if (!empty($theme)) $attributes .= '/' . $theme;
		if (!empty($colors)) $attributes .= '/' . $colors;
		if (!empty($text)) $attributes .= '/text:' . $text;
		$attributes .= '"';
		
		return '<img ' . $attributes . ' ' . $this->get_atts('', $atts) . '>';
	}
}

new Beam_Bootstrap();
