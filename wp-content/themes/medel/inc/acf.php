<?php 
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_coming-soom-settings',
		'title' => 'Coming soom settings',
		'fields' => array (
			array (
				'key' => 'field_59bfb14f288cf',
				'label' => 'Date',
				'name' => 'date',
				'type' => 'date_picker',
				'date_format' => 'yy/mm/dd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coming-soon.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_page-settings',
		'title' => 'Page settings',
		'fields' => array (
			array (
				'key' => 'field_54fs65d2x79f',
				'label' => 'Color Scheme',
				'name' => 'color_scheme',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'scheme1' => 'Scheme 1',
					'scheme2' => 'Scheme 2',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_58a43bba66153',
				'label' => 'Header color mode',
				'name' => 'header_color_mode',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'light' => 'Light',
					'dark' => 'Dark',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_59d48647asdq5v7',
				'label' => 'Search',
				'name' => 'search',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'yes' => 'Yes',
					'no' => 'No',
				),
				'default_value' => 'default',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_59d4864724447',
				'label' => 'Cart',
				'name' => 'cart',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'yes' => 'Yes',
					'no' => 'No',
				),
				'default_value' => 'default',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_58a592079667e',
				'label' => 'Navigation type',
				'name' => 'navigation_type',
				'type' => 'select',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58a43a8166152',
							'operator' => '!=',
							'value' => 'side',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array (
					'default' => 'Default',
					'disabled' => 'Disabled',
					'hidden_menu' => 'Hidden menu',
					'visible_menu' => 'Visible menu',
					'full_screen' => 'Full screen menu',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_58a58ef19684e',
				'label' => 'Header container',
				'name' => 'header_container',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'container' => 'Center container',
					'container-fluid' => 'Full witdh',
				),
				'default_value' => 'default',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_58a43c2266154',
				'label' => 'Header space',
				'name' => 'header_space',
				'type' => 'radio',
				'choices' => array (
					'yes' => 'Yes',
					'no' => 'No',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'yes',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_58a45add62c81',
				'label' => 'Footer',
				'name' => 'footer',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'show' => 'Show',
					'hide' => 'Hide',
					'minified' => 'Minified',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_sthh654sfmg',
				'label' => 'Footer color mode',
				'name' => 'footer_color_mode',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'light' => 'Light',
					'dark' => 'Dark',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-landing.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_project-settings',
		'title' => 'Project settings',
		'fields' => array (
			array (
				'key' => 'field_59c0c83cdb361',
				'label' => 'Style',
				'name' => 'project_style',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'slider' => 'Slider',
					'masonry' => 'Masonry',
				),
				'default_value' => 'default',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_59c3a84023b44',
				'label' => 'Project image',
				'name' => 'project_image',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'full' => 'Full',
					'adaptive' => 'Adaptive',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'pt-portfolio',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
