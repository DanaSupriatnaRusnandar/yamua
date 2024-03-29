<?php
if ( ! class_exists( 'rtTPGOptions' ) ):

	class rtTPGOptions {

		function rtPostTypes() {
			$args = apply_filters( 'tpg_get_post_type', [
				'_builtin' => true,
			] );

			$post_types = get_post_types( $args );

			$exclude = [ 'attachment', 'revision', 'nav_menu_item' ];

			foreach ( $exclude as $ex ) {
				unset( $post_types[ $ex ] );
			}

			return $post_types;
		}

		function rtPostOrders() {
			return [
				"ASC"  => __( "Ascending", 'the-post-grid' ),
				"DESC" => __( "Descending", 'the-post-grid' ),
			];
		}

		function rtTermOperators() {
			return [
				'IN'     => __( "IN — show posts which associate with one or more of selected terms",
					'the-post-grid' ),
				'NOT IN' => __( "NOT IN — show posts which do not associate with any of selected terms",
					'the-post-grid' ),
				'AND'    => __( "AND — show posts which associate with all of selected terms", 'the-post-grid' ),
			];
		}

		function rtTermRelations() {
			return [
				'AND' => __( "AND — show posts which match all settings", 'the-post-grid' ),
				'OR'  => __( "OR — show posts which match one or more settings", 'the-post-grid' ),
			];
		}

		function rtMetaKeyType() {
			return [
				'meta_value'          => __( 'Meta value', 'the-post-grid' ),
				'meta_value_num'      => __( 'Meta value number', 'the-post-grid' ),
				'meta_value_datetime' => __( 'Meta value datetime', 'the-post-grid' ),
			];
		}

		function rtPostOrderBy( $isWoCom = false, $metaOrder = false ) {
			$orderBy = [
				"ID"         => __( "ID", 'the-post-grid' ),
				"title"      => __( "Title", 'the-post-grid' ),
				"date"       => __( "Created date", 'the-post-grid' ),
				"modified"   => __( "Modified date", 'the-post-grid' ),
				"menu_order" => __( "Menu Order", 'the-post-grid' ),
			];

			return apply_filters( 'rt_tpg_post_orderby', $orderBy, $isWoCom, $metaOrder );
		}

		function rtTPGSettingsCustomScriptFields() {
			$settings = get_option( rtTPG()->options['settings'] );

			return [
				"script_before_item_load" => [
					"label"       => __( "Script before item load", 'the-post-grid' ),
					'type'        => 'textarea',
					'holderClass' => 'rt-script-wrapper full',
					'id'          => 'script-before-item-load',
					'value'       => isset( $settings['script_before_item_load'] ) ? stripslashes( $settings['script_before_item_load'] ) : null,
				],
				"script_after_item_load"  => [
					"label"       => __( "Script After item load", 'the-post-grid' ),
					'type'        => 'textarea',
					'holderClass' => 'rt-script-wrapper full',
					'id'          => 'script-after-item-load',
					'value'       => isset( $settings['script_after_item_load'] ) ? stripslashes( $settings['script_after_item_load'] ) : null,
				],
				"script_loaded"           => [
					"label"       => __( "After Loaded script", 'the-post-grid' ),
					'type'        => 'textarea',
					'holderClass' => 'rt-script-wrapper full',
					'id'          => 'script-loaded',
					'value'       => isset( $settings['script_loaded'] ) ? stripslashes( $settings['script_loaded'] ) : null,
				],
			];
		}

		function rtTPGSettingsOtherSettingsFields() {
			$settings = get_option( rtTPG()->options['settings'] );

			return [
				'tpg_load_script'      => [
					'type'        => 'switch',
					'name'        => 'tpg_load_script',
					'label'       => __( 'Load Script only ShortCode page', 'the-post-grid' ),
					'description' => __( 'If you enable this, script will be loaded only ShortCode page.', 'the-post-grid' ),
					'value'       => isset( $settings['tpg_load_script'] ) ? $settings['tpg_load_script'] : false,
				],
				'tpg_enable_preloader' => [
					'type'        => 'switch',
					'name'        => 'tpg_enable_preloader',
					'label'       => __( 'Enable Pre-loader', 'the-post-grid' ),
					'holderClass' => 'tpg-hidden',
					'value'       => isset( $settings['tpg_enable_preloader'] ) ? $settings['tpg_enable_preloader'] : false,
				],
				'tpg_skip_fa'          => [
					'type'        => 'switch',
					'name'        => 'tpg_skip_fa',
					'label'       => __( 'Disable Font Awesome Script', 'the-post-grid' ),
					'description' => __( "If Font Awesome 5 exist with theme, don't need to load twice.", 'the-post-grid' ),
					'value'       => isset( $settings['tpg_enable_preloader'] ) ? $settings['tpg_enable_preloader'] : false,
				],
				'template_author'      => [
					'type'        => 'select',
					'name'        => 'template_author',
					'label'       => 'Template Author',
					'id'          => 'template_author',
					'holderClass' => 'pro-field',
					'class'       => 'select2',
					'blank'       => 'Select a layout',
					'options'     => rtTPG()->getTPGShortCodeList(),
					'value'       => isset( $settings['template_author'] ) ? $settings['template_author'] : [],
				],
				'template_category'    => [
					'type'        => 'select',
					'name'        => 'template_category',
					'label'       => 'Template Category',
					'id'          => 'template_category',
					'holderClass' => 'pro-field',
					'class'       => 'select2',
					'blank'       => 'Select a layout',
					'options'     => rtTPG()->getTPGShortCodeList(),
					'value'       => isset( $settings['template_category'] ) ? $settings['template_category'] : [],
				],
				'template_search'      => [
					'type'        => 'select',
					'name'        => 'template_search',
					'label'       => 'Template Search',
					'id'          => 'template_search',
					'holderClass' => 'pro-field',
					'class'       => 'select2',
					'blank'       => 'Select a layout',
					'options'     => rtTPG()->getTPGShortCodeList(),
					'value'       => isset( $settings['template_search'] ) ? $settings['template_search'] : [],
				],
				'template_tag'         => [
					'type'        => 'select',
					'name'        => 'template_tag',
					'label'       => 'Template Tag',
					'id'          => 'template_tag',
					'holderClass' => 'pro-field',
					'class'       => 'select2',
					'blank'       => 'Select a layout',
					'options'     => rtTPG()->getTPGShortCodeList(),
					'value'       => isset( $settings['template_tag'] ) ? $settings['template_tag'] : [],
				],
				'template_class'       => [
					'type'        => 'text',
					'name'        => 'template_class',
					'label'       => 'Template class',
					'holderClass' => 'pro-field',
					'id'          => 'template_class',
					'value'       => isset( $settings['template_class'] ) ? $settings['template_class'] : '',
				],
			];
		}

		function rtTPGLicenceField() {
			$settings       = get_option( rtTPG()->options['settings'] );
			$status         = ! empty( $settings['license_status'] ) && $settings['license_status'] === 'valid' ? true : false;
			$license_status = ! empty( $settings['license_key'] ) ? sprintf( "<span class='license-status'>%s</span>",
				$status
					? "<input type='submit' class='button-secondary rt-licensing-btn danger' name='license_deactivate' value='" . __( "Deactivate License", "the-post-grid" )
					  . "'/>"
					: "<input type='submit' class='button-secondary rt-licensing-btn button-primary' name='license_activate' value='" . __( "Activate License", "the-post-grid" )
					  . "'/>"
			) : ' ';

			return [
				"license_key" => [
					'type'        => 'text',
					'name'        => 'license_key',
					'attr'        => 'style="min-width:300px;"',
					'label'       => __( 'Enter your license key', 'the-post-grid' ),
					'description' => $license_status,
					'id'          => 'license_key',
					'value'       => isset( $settings['license_key'] ) ? $settings['license_key'] : '',
				],
			];
		}

		function rtTPGSettingsSocialShareFields() {
			$settings = get_option( rtTPG()->options['settings'] );

			return [
				"social_share_items" => [
					'type'        => 'checkbox',
					'name'        => 'social_share_items',
					'label'       => 'Social share items',
					'id'          => 'social_share_items',
					'holderClass' => 'pro-field',
					'alignment'   => 'vertical',
					'multiple'    => true,
					'options'     => rtTPG()->socialShareItemList(),
					'value'       => isset( $settings['social_share_items'] ) ? $settings['social_share_items'] : [],
				],
			];
		}

		function socialShareItemList() {
			return [
				'facebook'  => 'Facebook',
				'twitter'   => 'Twitter',
				'linkedin'  => 'LinkedIn',
				'pinterest' => 'Pinterest',
				'reddit'    => 'Reddit',
				'email'     => 'Email',
			];
		}

		function templateOverrideItemList() {
			return [
				'category-archive' => "Category archive",
				'tag-archive'      => "Tag archive",
				'author-archive'   => "Author archive",
				'search'           => "Search page",
			];
		}

		function rtTPGCommonFilterFields() {
			return [
				'post__in'     => [
					"name"        => "post__in",
					"label"       => "Include only",
					"type"        => "text",
					"class"       => "full",
					"description" => 'List of post IDs to show (comma-separated values, for example: 1,2,3)',
				],
				'post__not_in' => [
					"name"        => "post__not_in",
					"label"       => "Exclude",
					"type"        => "text",
					"class"       => "full",
					"description" => 'List of post IDs to hide (comma-separated values, for example: 1,2,3)',
				],
				'limit'        => [
					"name"        => "limit",
					"label"       => "Limit",
					"type"        => "number",
					"class"       => "full",
					"description" => 'The number of posts to show. Set empty to show all found posts.',
				],
                'offset'        => [
                    "name"        => "offset",
                    "label"       => __("Offset", "the-post-grid"),
                    "type"        => "number",
                    "class"       => "full",
                    "description" => 'The number of posts to skip from start',
                ],
			];
		}

		function rtTPGPostType() {
			return [
				'tpg_post_type' => [
					"label"   => "Post Type",
					"type"    => "select",
					"id"      => "rt-sc-post-type",
					"class"   => "-rt-select2",
					"options" => $this->rtPostTypes(),
				],
			];
		}

		function rtTPAdvanceFilters() {
			$fields = apply_filters( 'rt_tpg_advanced_filters', [
				'tpg_taxonomy'    => "Taxonomy",
				'order'           => "Order",
				'author'          => "Author",
				'tpg_post_status' => "Status",
				's'               => "Search",
			] );

			return [
				'post_filter' => [
					'type'      => "checkboxFilter",
					'name'      => "post_filter",
					'label'     => "Advanced Filters",
					"alignment" => "vertical",
					"multiple"  => true,
					'default'   => [ 'tpg_taxonomy', 'order' ],
					"options"   => $fields,
				],
			];
		}

		function rtTPGPostStatus() {
			return [
				'publish'    => 'Publish',
				'pending'    => 'Pending',
				'draft'      => 'Draft',
				'auto-draft' => 'Auto draft',
				'future'     => 'Future',
				'private'    => 'Private',
				'inherit'    => 'Inherit',
				'trash'      => 'Trash',
			];
		}

		function owl_property() {
			return [
				'auto_play'   => 'Auto Play',
				'loop'        => 'Loop',
				'nav_button'  => 'Nav Button',
				'pagination'  => 'Pagination',
				'stop_hover'  => 'Stop Hover',
				'auto_height' => 'Auto Height',
				'lazy_load'   => 'Lazy Load',
				'rtl'         => 'Right to left (RTL)',
			];
		}

		function rtTPGLayoutSettingFields() {
			$options = [
				'layout_type'                      => [
                    "type"    => "radio-image",
					"label"   => __("Layout Type", "the-post-grid"),
					"id"      => "rt-tpg-sc-layout-type",
					"options" => $this->rtTPGLayoutType(),
				],
                'layout'                           => [
                    "type"    => "radio-image",
                    "label"   => __("Layout", "the-post-grid"),
                    "id"      => "rt-tpg-sc-layout",
                    "class"   => "rt-select2",
                    "options" => $this->rtTPGLayouts(),
                ],
				'tgp_filter'                       => [
					"type"        => "checkbox",
					"label"       => "Filter",
					'holderClass' => "sc-tpg-grid-filter tpg-hidden pro-field",
					"multiple"    => true,
					"alignment"   => 'vertical',
					"options"     => rtTPG()->tgp_filter_list(),
				],
				'tgp_filter_taxonomy'              => [
					"type"        => "select",
					"label"       => "Taxonomy Filter",
					'holderClass' => "sc-tpg-grid-filter sc-tpg-filter tpg-hidden",
					"class"       => "rt-select2",
					"options"     => rtTPG()->rt_get_taxonomy_for_filter(),
				],
				'tgp_filter_taxonomy_hierarchical' => [
					"type"        => "switch",
					"label"       => "Display as sub category",
					'holderClass' => "sc-tpg-grid-filter sc-tpg-filter tpg-hidden",
					"option"      => "Active",
				],
				'tgp_filter_type'                  => [
					"type"        => "select",
					"label"       => "Taxonomy filter type",
					'holderClass' => "sc-tpg-grid-filter sc-tpg-filter tpg-hidden",
					"class"       => "rt-select2",
					"options"     => rtTPG()->rt_filter_type(),
				],
				'tgp_default_filter'               => [
					"type"        => "select",
					"label"       => "Selected filter term (Selected item)",
					'holderClass' => "sc-tpg-grid-filter sc-tpg-filter tpg-hidden",
					"class"       => "rt-select2",
					"attr"        => "data-selected='" . get_post_meta( get_the_ID(), 'tgp_default_filter', true ) . "'",
					"options"     => [ '' => __( 'Show All', 'the-post-grid' ) ],
				],
				'tpg_hide_all_button'              => [
					"type"        => "switch",
					"label"       => "Hide All (Show all) button",
					'holderClass' => "sc-tpg-grid-filter sc-tpg-filter tpg-hidden",
					"option"      => 'Hide',
				],
				'tpg_post_count'                   => [
					"type"        => "switch",
					"label"       => "Show post count",
					'holderClass' => "sc-tpg-grid-filter sc-tpg-filter tpg-hidden",
					"option"      => 'Enable',
				],
				'isotope_filter'                   => [
					"type"        => "select",
					"label"       => "Isotope Filter",
					'holderClass' => "isotope-item sc-isotope-filter tpg-hidden",
					"id"          => "rt-tpg-sc-isotope-filter",
					"class"       => "rt-select2",
					"options"     => rtTPG()->rt_get_taxonomy_for_filter(),
				],
				'isotope_default_filter'           => [
					"type"        => "select",
					"label"       => "Isotope filter (Selected item)",
					'holderClass' => "isotope-item sc-isotope-default-filter tpg-hidden pro-field",
					"id"          => "rt-tpg-sc-isotope-default-filter",
					"class"       => "rt-select2",
					"attr"        => "data-selected='" . get_post_meta( get_the_ID(), 'isotope_default_filter',
							true ) . "'",
					"options"     => [ '' => __( 'Show all', 'the-post-grid' ) ],
				],
				'tpg_show_all_text'                => [
					"type"        => "text",
					'holderClass' => "isotope-item sc-isotope-filter tpg-hidden",
					"label"       => esc_html__( "Show all text", 'the-post-grid' ),
					"default"     => esc_html__( "Show all", 'the-post-grid' ),
				],
				'isotope_filter_dropdown'          => [
					"type"        => "switch",
					"label"       => "Isotope dropdown filter",
					'holderClass' => "isotope-item sc-isotope-filter sc-isotope-filter-dropdown tpg-hidden pro-field",
				],
				'isotope_filter_show_all'          => [
					"type"        => "switch",
					"name"        => "isotope_filter_show_all",
					"label"       => "Isotope filter (Show All item)",
					'holderClass' => "isotope-item sc-isotope-filter-show-all tpg-hidden pro-field",
					"id"          => "rt-tpg-sc-isotope-filter-show-all",
				],
				'isotope_filter_count'             => [
					"type"        => "switch",
					"label"       => "Isotope filter count number",
					'holderClass' => "isotope-item sc-isotope-filter tpg-hidden pro-field",
					"option"      => 'Enable',
				],
				'isotope_filter_url'               => [
					"type"        => "switch",
					"label"       => "Isotope filter URL",
					'holderClass' => "isotope-item sc-isotope-filter tpg-hidden pro-field",
				],
				'isotope_search_filter'            => [
					"type"        => "switch",
					"label"       => "Isotope search filter",
					'holderClass' => "isotope-item sc-isotope-search-filter tpg-hidden pro-field",
					"id"          => "rt-tpg-sc-isotope-search-filter",
					"option"      => 'Enable',
				],
				'carousel_property'                => [
					"type"        => "checkbox",
					"label"       => "Carousel property",
					"multiple"    => true,
					"alignment"   => 'vertical',
					'holderClass' => "carousel-item carousel-property tpg-hidden",
					"id"          => "carousel-property",
					"default"     => [ 'pagination' ],
					"options"     => $this->owl_property(),
				],
				'tpg_carousel_speed'               => [
					"label"       => __( "Speed", 'the-post-grid' ),
					"holderClass" => "tpg-hidden carousel-item",
					"type"        => "number",
					'default'     => 250,
					"description" => __( 'Auto play Speed in milliseconds', 'the-post-grid' ),
				],
				'tpg_carousel_autoplay_timeout'    => [
					"label"       => __( "Autoplay timeout", 'the-post-grid' ),
					"holderClass" => "tpg-hidden carousel-item tpg-carousel-auto-play-timeout",
					"type"        => "number",
					'default'     => 5000,
					"description" => __( 'Autoplay interval timeout', 'the-post-grid' ),
				],
			];

			return apply_filters( 'rt_tpg_layout_options', $options );
		}

		function responsiveSettingsColumn() {
			$options = [
				'column'                           => [
					'type'        => 'select',
					'label'       => __( 'Desktop', 'the-post-grid' ),
					'class'       => 'rt-select2',
					'holderClass' => "offset-column-wrap rt-3-column",
					'default'     => 3,
					'options'     => $this->scColumns(),
					"description" => "Desktop > 991px",
				],
				'tpg_tab_column'                   => [
					'type'        => 'select',
					'label'       => __( 'Tab', 'the-post-grid' ),
					'class'       => 'rt-select2',
					'holderClass' => "offset-column-wrap rt-3-column",
					'default'     => 2,
					'options'     => $this->scColumns(),
					"description" => "Tab < 992px",
				],
				'tpg_mobile_column'                => [
					'type'        => 'select',
					'label'       => __( 'Mobile', 'the-post-grid' ),
					'class'       => 'rt-select2',
					'holderClass' => "offset-column-wrap rt-3-column",
					'default'     => 1,
					'options'     => $this->scColumns(),
					"description" => "Mobile < 768px",
				],
			];
			return apply_filters( 'rt_tpg_layout_column_options', $options );
		}

		function layoutMiscSettings() {
			$options = [
				'pagination'                       => [
					"type"        => "switch",
					"label"       => "Pagination",
					'holderClass' => "pagination",
					"id"          => "rt-tpg-pagination",
                    "description" => "Pagination not allow in Grid Hover layout",
					"option"      => 'Enable',
				],
				'posts_per_page'                   => [
					"type"        => "number",
					"label"       => "Display per page",
					'holderClass' => "pagination-item posts-per-page tpg-hidden",
					"default"     => 5,
					"description" => "If value of Limit setting is not blank (empty), this value should be smaller than Limit value.",
				],
				'posts_loading_type'               => [
					"type"        => "radio",
					"label"       => "Pagination Type",
					'holderClass' => "pagination-item posts-loading-type tpg-hidden pro-field",
					"alignment"   => "vertical",
					"default"     => 'pagination',
					"options"     => $this->postLoadingType(),
				],
				'link_to_detail_page'              => [
					"type"      => "switch",
					"label"     => "Link To Detail Page",
					"alignment" => "vertical",
					"default"   => true,
				],
				'detail_page_link_type'            => [
					"type"        => "radio",
					"label"       => "Detail page link type",
					'holderClass' => "detail-page-link-type tpg-hidden pro-field",
					"alignment"   => "vertical",
					"default"     => "new_page",
					"options"     => [
						'popup'    => "PopUp",
						'new_page' => "New Page",
					],
				],
				'popup_type'                       => [
					"type"        => "radio",
					"label"       => "PopUp Type",
					'holderClass' => "popup-type tpg-hidden pro-field",
					"alignment"   => "vertical",
					"default"     => "single",
					"options"     => [
						'single' => "Single PopUp",
						'multi'  => "Multi PopUp",
					],
				],
				'link_target'                      => [
					"type"        => "radio",
					"label"       => "Link Target",
					'holderClass' => "tpg-link-target tpg-hidden",
					"alignment"   => 'vertical',
					"options"     => [
						''       => 'Same Window',
						'_blank' => 'New Window',
					],
				],
			];
			return apply_filters( 'rt_tpg_layout_misc_options', $options );
		}

		function stickySettings() {
			$options = [
				'ignore_sticky_posts' => [
					"type"        => "switch",
					"label"       => "Show sticky posts at the top",
					'holderClass' => "pro-field",
					"alignment"   => "vertical",
					"default"     => false,
				],
			];

			return $options;
		}

		function scMarginOpt() {
			return [
				'default' => "Bootstrap default",
				'no'      => "No Margin",
			];
		}

		function scGridType() {
			return [
				'even'    => "Even Grid",
				'masonry' => "Masonry",
			];
		}

		function getTitleTags() {
			return [
				'h2' => "H2",
				'h3' => "H3",
				'h4' => "H4",
			];
		}

		function getHeadingTags() {
			return [
				'h1' => "H1",
				'h2' => "H2",
				'h3' => "H3",
				'h4' => "H4",
				'h5' => "H5",
				'h6' => "H6",
			];
		}

		function rtTpgSettingsDetailFieldSelection() {
			$settings = get_option( rtTPG()->options['settings'] );

			$fields = [
				"popup_fields" => [
					'type'        => 'checkbox',
					'label'       => 'Field Selection',
					'id'          => 'popup-fields',
					'holderClass' => 'pro-field',
					'alignment'   => 'vertical',
					'multiple'    => true,
					'options'     => rtTPG()->detailAvailableFields(),
					'value'       => isset( $settings['popup_fields'] ) ? $settings['popup_fields'] : [],
				],
			];
			$cf     = rtTPG()->checkWhichCustomMetaPluginIsInstalled();
			if ( $cf ) {
				$plist                         = rtTPG()->getCFPluginList();
				$pName                         = ! empty( $plist[ $cf ] ) ? $plist[ $cf ] : " - ";
				$fields['cf_group']            = [
					"type"        => "checkbox",
					"name"        => "cf_group",
					"holderClass" => "tpg-hidden cfs-fields cf-group pro-field",
					"label"       => "Custom Field group " . " ({$pName})",
					"multiple"    => true,
					"alignment"   => "vertical",
					"id"          => "cf_group",
					"options"     => rtTPG()->get_groups_by_post_type( 'all' ),
					"value"       => isset( $settings['cf_group'] ) ? $settings['cf_group'] : [],
				];
				$fields['cf_hide_empty_value'] = [
					"type"        => "checkbox",
					"name"        => "cf_hide_empty_value",
					"holderClass" => "tpg-hidden cfs-fields pro-field",
					"label"       => "Hide field with empty value",
					"value"       => ! empty( $settings['cf_hide_empty_value'] ) ? 1 : 0,
				];
				$fields['cf_show_only_value']  = [
					"type"        => "checkbox",
					"name"        => "cf_show_only_value",
					"holderClass" => "tpg-hidden cfs-fields pro-field",
					"label"       => "Show only value of field",
					"description" => "By default both name & value of field is shown",
					"value"       => ! empty( $settings['cf_show_only_value'] ) ? 1 : 0,
				];
				$fields['cf_hide_group_title'] = [
					"type"        => "checkbox",
					"name"        => "cf_hide_group_title",
					"holderClass" => "tpg-hidden cfs-fields pro-field",
					"label"       => "Hide group title",
					"value"       => ! empty( $settings['cf_hide_group_title'] ) ? 1 : 0,
				];
			}

			return $fields;
		}

		function detailAvailableFields() {
			$fields   = $this->rtTPGItemFields();
			$inserted = [
				'feature_img' => 'Feature Image',
				'content'     => 'Content',
			];
			unset( $fields['heading'] );
			unset( $fields['excerpt'] );
			unset( $fields['read_more'] );
			unset( $fields['comment_count'] );
			$offset                    = array_search( 'title', array_keys( $fields ) ) + 1;
			$newFields                 = array_slice( $fields, 0, $offset, true ) + $inserted + array_slice( $fields,
					$offset, null, true );
			$newFields['social_share'] = "Social Share";

			return $newFields;
		}

		function rtTPGSCHeadingSettings() {
			$fields = [
				'tpg_heading_tag'       => [
					'type'    => 'select',
					'name'    => 'tpg_heading_tag',
					'label'   => esc_html__( 'Tag', 'the-post-grid' ),
					'class'   => 'rt-select2',
					'id'      => 'heading-tag',
					'options' => $this->getHeadingTags(),
					'default' => 'h2',
				],
				'tpg_heading_style'     => [
					"type"    => "select",
					"class"   => "rt-select2",
					"label"   => esc_html__( "Style", "the-post-grid" ),
					"blank"   => esc_html__( "Default", "the-post-grid" ),
					"options" => [
						'style1' => esc_html__( "Style 1", "the-post-grid" ),
						'style2' => esc_html__( "Style 2", "the-post-grid" ),
						'style3' => esc_html__( "Style 3", "the-post-grid" ),
					],
				],
				'tpg_heading_alignment' => [
					"type"    => "select",
					"class"   => "rt-select2",
					"label"   => esc_html__( "Alignment", "the-post-grid" ),
					"blank"   => esc_html__( "Default", "the-post-grid" ),
					"options" => [
						'left'   => esc_html__( "Left", "the-post-grid" ),
						'right'  => esc_html__( "Right", "the-post-grid" ),
						'center' => esc_html__( "Center", "the-post-grid" ),
					],
				],
				'tpg_heading_link'      => [
					"type"  => "url",
					"label" => __( 'Link', 'the-post-grid' ),
				],
			];

			return $fields;
		}

		function rtTPGSCCategorySettings() {
			$fields = [
				'tpg_category_position' => [
					"type"    => "select",
					"class"   => "rt-select2",
                    "holderClass" => "pro-field",
					"label"   => esc_html__( "Position", "the-post-grid" ),
					"blank"   => esc_html__( "Default", "the-post-grid" ),
					"options" => [
						'above_title'  => esc_html__( "Above Title", "the-post-grid" ),
						'top_left'     => esc_html__( "Over image (Top Left)", "the-post-grid" ),
						'top_right'    => esc_html__( "Over image (Top Right)", "the-post-grid" ),
						'bottom_left'  => esc_html__( "Over image (Bottom Left)", "the-post-grid" ),
						'bottom_right' => esc_html__( "Over image (Bottom Right)", "the-post-grid" ),
						'image_center' => esc_html__( "Over image (Center)", "the-post-grid" ),
					],
				],
				'tpg_category_style'    => [
					"type"    => "select",
					"class"   => "rt-select2",
                    "holderClass" => "pro-field",
					"label"   => esc_html__( "Style", "the-post-grid" ),
					"blank"   => esc_html__( "Default", "the-post-grid" ),
					"options" => [
						'style1' => esc_html__( "Style 1", "the-post-grid" ),
						'style2' => esc_html__( "Style 2", "the-post-grid" ),
						'style3' => esc_html__( "Style 3", "the-post-grid" ),
					],
				],
                'tpg_category_icon'      => [
                    "type"    => "switch",
                    "label"   => esc_html__( "Icon", "the-post-grid" ),
                    "default" => true,
                ],
			];

			return $fields;
		}

		function rtTPGSCTitleSettings() {
			$fields = [
				'tpg_title_position'   => [
					"type"        => "select",
					"label"       => esc_html__( "Title Position (Above or Below image)", "the-post-grid" ),
					"class"       => "rt-select2 ",
					"holderClass" => "pro-field",
					"blank"       => esc_html__( "Default", "the-post-grid" ),
					"options"     => [
						'above' => esc_html__( "Above image", "the-post-grid" ),
						'below' => esc_html__( "Below image", "the-post-grid" ),
					],
					"description" => __( "<span style='color:red'>Only Layout 1, Layout 12, Layout 14, Isotope1, Isotope8, Isotope10, Carousel Layout 1, Carousel Layout 8, Carousel Layout 10</span>",
						'the-post-grid' ),
				],
				'title_tag'            => [
					'type'    => 'select',
					'name'    => 'title_tag',
					'label'   => esc_html__( 'Title tag', 'the-post-grid' ),
					'class'   => 'rt-select2',
					'id'      => 'title-tag',
					'options' => $this->getTitleTags(),
					'default' => 'h3',
				],
				'tpg_title_limit'      => [
					"type"        => "number",
					"label"       => esc_html__( "Title limit", 'the-post-grid' ),
					"description" => esc_html__( "Title limit only integer number is allowed, Leave it blank for full title.", 'the-post-grid' ),
				],
				'tpg_title_limit_type' => [
					"type"      => "radio",
					"label"     => esc_html__( "Title limit type", 'the-post-grid' ),
					"alignment" => "vertical",
					"default"   => 'character',
					"options"   => $this->get_limit_type(),
				],
			];

			return $fields;
		}

		function rtTPGSCMetaSettings() {
			$fields = [
				'tpg_meta_position'  => [
					"type"        => "select",
					"label"       => esc_html__( "Position", "the-post-grid" ),
					"class"       => "rt-select2 ",
					"holderClass" => "pro-field",
					"blank"       => esc_html__( "Default", "the-post-grid" ),
					"options"     => [
						'above_title'   => esc_html__( "Above Title", "the-post-grid" ),
						'above_excerpt' => esc_html__( "Above excerpt", "the-post-grid" ),
						'below_excerpt' => esc_html__( "Below excerpt", "the-post-grid" ),
					],
				],
				'tpg_meta_icon'      => [
					"type"    => "switch",
					"label"   => esc_html__( "Icon", "the-post-grid" ),
					"default" => true,
				],
				'tpg_meta_separator' => [
					"type"    => "select",
					"class"   => "rt-select2",
					"label"   => esc_html__( "Separator", "the-post-grid" ),
					"blank"   => esc_html__( "Default", "the-post-grid" ),
					"options" => [
						'dot'     => esc_html__( "Dot ( . )", "the-post-grid" ),
						's_slash' => esc_html__( "Single Slash ( / )", "the-post-grid" ),
						'd_slash' => esc_html__( "Double Slash ( // )", "the-post-grid" ),
						'hypen'   => esc_html__( "Hypen ( - )", "the-post-grid" ),
						'v_pipe'  => esc_html__( "Vertical Pipe ( | )", "the-post-grid" ),
					],
				],
			];

			return $fields;
		}

		function rtTPGSCImageSettings() {
			$fields = [
				'feature_image'            => [
					"type"    => "switch",
					"label"   => "Hide Feature Image",
					"id"      => "rt-tpg-feature-image",
					"default" => false,
				],
				'featured_image_size'      => [
					"type"        => "select",
					"label"       => "Feature Image Size",
					"class"       => "rt-select2",
					'holderClass' => "rt-feature-image-option tpg-hidden",
					"options"     => rtTPG()->get_image_sizes(),
				],
				'custom_image_size'        => [
					"type"        => "image_size",
					"label"       => "Custom Image Size",
					'holderClass' => "rt-sc-custom-image-size-holder tpg-hidden",
					"multiple"    => true,
				],
				'media_source'             => [
					"type"        => "radio",
					"label"       => "Media Source",
					"default"     => 'feature_image',
					"alignment"   => "vertical",
					'holderClass' => "rt-feature-image-option tpg-hidden",
					"options"     => $this->rtMediaSource(),
				],
				'tgp_layout2_image_column' => [
					'type'        => 'select',
					'label'       => esc_html__( 'Image column', 'the-post-grid' ),
					'class'       => 'rt-select2',
					'holderClass' => "holder-layout2-image-column tpg-hidden",
					'default'     => 4,
					'options'     => $this->scColumns(),
					"description" => "Content column will calculate automatically",
				],
				'tpg_image_type'           => [
					"type"        => "radio",
					"label"       => esc_html__( "Type", 'the-post-grid' ),
					"alignment"   => "vertical",
					'holderClass' => "rt-feature-image-option tpg-hidden pro-field",
					"default"     => 'normal',
					"options"     => $this->get_image_types(),
				],
				'tpg_image_animation'      => [
					"type"    => "select",
					"label"   => esc_html__( 'Hover Animation', 'the-post-grid' ),
					"class"   => "rt-select2",
					"blank"   => esc_html__( "Default", "the-post-grid" ),
					"options" => [
						'img_zoom_in'   => esc_html__( 'Zoom in', 'the-post-grid' ),
						'img_zoom_out'  => esc_html__( 'Zoom out', 'the-post-grid' ),
						'img_no_effect' => esc_html__( 'None', 'the-post-grid' ),
					],
				],
				'tpg_image_border_radius'  => [
					"type"        => "number",
					"class"       => "small-text",
                    'holderClass' => "pro-field",
					"label"       => esc_html__( "Border radius", "the-post-grid" ),
					"description" => esc_html__( "Leave it blank for default", 'the-post-grid' ),
				],
			];

			return apply_filters('rt_tpg_sc_image_settings', $fields);
		}

		function rtTPGSCExcerptSettings() {
			$fields = [
				'excerpt_limit'         => [
					"type"        => "number",
					"label"       => esc_html__( "Excerpt limit", 'the-post-grid' ),
                    "default"       => 15,
					"description" => esc_html__( "Excerpt limit only integer number is allowed, Leave it blank for full excerpt.", 'the-post-grid' ),
				],
				'tgp_excerpt_type'      => [
					"type"      => "radio",
					"label"     => esc_html__( "Excerpt Type", 'the-post-grid' ),
					"alignment" => "vertical",
					"default"   => 'word',
					"options"   => $this->get_limit_type( 'content' ),
				],
				'tgp_excerpt_more_text' => [
					"type"    => "text",
					"label"   => "Excerpt more text",
					"default" => '...',
				],
			];

			return $fields;
		}

		function rtTPGSCButtonSettings() {
			$fields = [
				'tpg_read_more_button_border_radius' => [
					"type"        => "number",
					"class"       => "small-text",
					"label"       => esc_html__( "Border radius", "the-post-grid" ),
					"description" => __( "Leave it blank for default", 'the-post-grid' ),
				],
				'tpg_read_more_button_alignment'     => [
					"type"    => "select",
					"class"   => "rt-select2",
					"label"   => esc_html__( "Alignment", "the-post-grid" ),
					"blank"   => esc_html__( "Default", "the-post-grid" ),
					"options" => [
						'left'   => esc_html__( "Left", "the-post-grid" ),
						'right'  => esc_html__( "Right", "the-post-grid" ),
						'center' => esc_html__( "Center", "the-post-grid" ),
					],
				],
				'tgp_read_more_text'                 => [
					"type"  => "text",
					"label" => "Text",
				],
			];

			return $fields;
		}

		function rtTPGStyleFields() {
			$fields = [
				'parent_class'            => [
					"type"        => "text",
					"label"       => "Parent class",
					"class"       => "medium-text",
					"description" => "Parent class for adding custom css",
				],
				'primary_color'           => [
					"type"    => "text",
					"label"   => "Primary Color",
					"class"   => "rt-color",
					"default" => "#0367bf",
				],
			];

			return apply_filters( 'rt_tpg_style_fields', $fields );
		}

		function rtTPGStyleButtonColorFields() {
			$fields = [

				'button_bg_color'         => [
					"type"        => "text",
					"name"        => "button_bg_color",
					"label"       => "Background",
					"class"       => "rt-color",
				],
				'button_hover_bg_color'   => [
					"type"        => "text",
					"name"        => "button_hover_bg_color",
					"label"       => "Hover Background",
					"class"       => "rt-color",
				],
				'button_active_bg_color'  => [
					"type"        => "text",
					"label"       => "Active Background (Isotop)",
					"class"       => "rt-color",
				],
				'button_text_bg_color'    => [
					"type"        => "text",
					"label"       => "Text",
					"class"       => "rt-color",
				],
				'button_hover_text_color' => [
					"type"        => "text",
					"label"       => "Text Hover",
					"class"       => "rt-color",
				],
			];

			return apply_filters( 'rt_tpg_style_button_css_fields', $fields );
		}

		function rtTPGStyleHeading() {
			$fields = [
				'tpg_heading_bg'           => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Background Color", "the-post-grid" ),
				],
				'tpg_heading_color'        => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Text Color", "the-post-grid" ),
				],
				'tpg_heading_border_color' => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Border Color", "the-post-grid" ),
				],
				'tpg_heading_border_size'  => [
					"type"        => "number",
					"class"       => "small-text",
					"label"       => esc_html__( "Border Size", "the-post-grid" ),
					"description" => __( "Leave it blank for default", 'the-post-grid' ),
				],
				'tpg_heading_margin'       => [
					"type"        => "text",
					"class"       => "medium-text tpg-spacing-field",
					"label"       => esc_html__( "Margin", "the-post-grid" ),
					"description" => __( "Multiple value allowed separated by comma 12,0,5,10", 'the-post-grid' ),
				],
				'tpg_heading_padding'      => [
					"type"        => "text",
					"class"       => "medium-text tpg-spacing-field",
					"label"       => esc_html__( "Padding", "the-post-grid" ),
					"description" => __( "Leave it blank for default, multiple value allowed separated by comma 12,0,5,10", 'the-post-grid' ),
				],
			];

			return apply_filters( 'tpg_heading_style_fields', $fields );
		}

		function rtTPGStyleFullArea() {
			$fields = [
				'tpg_full_area_bg'      => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Background", "the-post-grid" ),
				],
				'tpg_full_area_margin'  => [
					"type"        => "text",
					"class"       => "medium-text",
					"label"       => esc_html__( "Margin", "the-post-grid" ),
                    "description" => __( "Multiple value allowed separated by comma 12,0,5,10", 'the-post-grid' ),
				],
				'tpg_full_area_padding' => [
					"type"        => "text",
					"class"       => "medium-text",
					"label"       => esc_html__( "Padding", "the-post-grid" ),
                    "description" => __( "Multiple value allowed separated by comma 12,0,5,10", 'the-post-grid' ),
				],
			];

			return apply_filters( 'tpg_box_style_fields', $fields );
		}

		function rtTPGStyleContentWrap() {
			$fields = [
				'tpg_content_wrap_bg'            => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Background Color", "the-post-grid" ),
				],
				'tpg_content_wrap_shadow'        => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Box Shadow Color", "the-post-grid" ),
				],
				'tpg_content_wrap_border_color'  => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Border Color", "the-post-grid" ),
				],
				'tpg_content_wrap_border'        => [
					"type"        => "number",
					"class"       => "small-text",
					"label"       => esc_html__( "Border Width", "the-post-grid" ),
					"description" => __( "Leave it blank for default", 'the-post-grid' ),
				],
				'tpg_content_wrap_border_radius' => [
					"type"  => "number",
					"class" => "small-text",
					"label" => esc_html__( "Border Radius", "the-post-grid" ),
				],
				'tpg_box_padding'                => [
					"type"        => "text",
					"class"       => "medium-text",
					"label"       => esc_html__( "Box Padding", "the-post-grid" ),
                    "description" => __( "Multiple value allowed separated by comma 12,0,5,10", 'the-post-grid' ),
				],
				'tpg_content_padding'            => [
					"type"        => "text",
					"class"       => "medium-text",
					"label"       => esc_html__( "Content Padding", "the-post-grid" ),
                    "description" => __( "Multiple value allowed separated by comma 12,0,5,10", 'the-post-grid' ),
				],
			];

			return apply_filters( 'tpg_content_style_fields', $fields );
		}

		function rtTPGStyleCategory() {
			$fields = [
				'tpg_category_bg'            => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Background Color", "the-post-grid" ),
				],
				'tpg_category_color'         => [
					"type"  => "text",
					"class" => "rt-color",
					"label" => esc_html__( "Text Color", "the-post-grid" ),
				],
				'tpg_category_border_radius' => [
					"type"        => "number",
					"class"       => "small-text",
					"label"       => esc_html__( "Border Radius", "the-post-grid" ),
					"description" => __( "Leave it blank for default", 'the-post-grid' ),
				],
				'tpg_category_margin'        => [
					"type"        => "text",
					"class"       => "medium-text tpg-spacing-field",
					"label"       => esc_html__( "Margin", "the-post-grid" ),
                    "description" => __( "Multiple value allowed separated by comma 12,0,5,10", 'the-post-grid' ),
				],
				'tpg_category_padding'       => [
					"type"        => "text",
					"class"       => "medium-text tpg-spacing-field",
					"label"       => esc_html__( "Padding", "the-post-grid" ),
                    "description" => __( "Multiple value allowed separated by comma 12,0,5,10", 'the-post-grid' ),
				],
				'rt_tpg_category_font_size'     => [
					"type"      => "select",
					"class"     => "rt-select2",
					"label"     => esc_html__( "Font Size", "the-post-grid" ),
					"blank"     => 'Default',
					"options"   => rtTPG()->scFontSize(),
				],
			];

			return apply_filters( 'tpg_category_style_fields', $fields );
		}

		function itemFields() {
			$fields = [
				'item_fields' => [
					"type"      => "checkbox",
					"name"      => "item_fields",
					"label"     => "Field selection",
					"id"        => "item-fields",
					"multiple"  => true,
					"alignment" => "vertical",
					"default"   => array_keys( $this->rtTPGItemFields() ),
					"options"   => $this->rtTPGItemFields(),
				],
			];
			if ( $cf = rtTPG()->checkWhichCustomMetaPluginIsInstalled() ) {
				global $post;
				$post_type                     = get_post_meta( $post->ID, 'tpg_post_type', true );
				$plist                         = rtTPG()->getCFPluginList();
				$fields['cf_group']            = [
					"type"        => "checkbox",
					"name"        => "cf_group",
					"holderClass" => "tpg-hidden cf-fields cf-group",
					"label"       => "Custom Field group " . " ({$plist[$cf]})",
					"multiple"    => true,
					"alignment"   => "vertical",
					"id"          => "cf_group",
					"options"     => rtTPG()->get_groups_by_post_type( $post_type, $cf ),
				];
				$fields['cf_hide_empty_value'] = [
					"type"        => "checkbox",
					"name"        => "cf_hide_empty_value",
					"holderClass" => "tpg-hidden cf-fields",
					"label"       => "Hide field with empty value",
					"default"     => 1,
				];
				$fields['cf_show_only_value']  = [
					"type"        => "checkbox",
					"name"        => "cf_show_only_value",
					"holderClass" => "tpg-hidden cf-fields",
					"label"       => "Show only value of field",
					"description" => "By default both name & value of field is shown",
				];
				$fields['cf_hide_group_title'] = [
					"type"        => "checkbox",
					"name"        => "cf_hide_group_title",
					"holderClass" => "tpg-hidden cf-fields",
					"label"       => "Hide group title",
				];
			}

			return $fields;
		}

		function getCFPluginList() {
			return [
				'acf' => "Advanced Custom Field",
			];
		}

		function rtMediaSource() {
			return [
				"feature_image" => "Feature Image",
				"first_image"   => "First Image from content",
			];
		}

		function get_image_types() {
			return [
				'normal' => "Normal",
				'circle' => "Circle",
			];
		}

		function get_limit_type( $content = null ) {
			$types = [
				'character' => __( "Character", "the-post-grid" ),
				'word'      => __( "Word", "the-post-grid" ),
			];
			if ( $content === 'content' ) {
				$types['full'] = __( "Full Content", "the-post-grid" );
			}

			return apply_filters( 'tpg_limit_type', $types, $content );
		}

		function scColumns() {
			return [
				1 => "Column 1",
				2 => "Column 2",
				3 => "Column 3",
				4 => "Column 4",
				5 => "Column 5",
				6 => "Column 6",
			];
		}

		function tgp_filter_list() {
			return [
				'_taxonomy_filter' => __( 'Taxonomy filter', "the-post-grid" ),
				'_author_filter'   => __( 'Author filter', "the-post-grid" ),
				'_order_by'        => __( 'Order - Sort retrieved posts by parameter', "the-post-grid" ),
				'_sort_order'      => __( 'Sort Order - Designates the ascending or descending order of the "orderby" parameter', "the-post-grid" ),
				'_search'          => __( "Search filter", "the-post-grid" ),
			];
		}

		function overflowOpacity() {
			return [
				1 => '10%',
				2 => '20%',
				3 => '30%',
				4 => '40%',
				5 => '50%',
				6 => '60%',
				7 => '70%',
				8 => '80%',
				9 => '90%',
			];
		}

		function rtTPGLayoutType() {
			$layoutType = [
                    'grid' => array(
                        'title' => __( "Grid", "the-post-grid" ),
                        'img' => rtTPG()->assetsUrl . 'images/grid.png',
                    ),
                    'grid_hover' => array(
                        'title' => __( "Grid Hover", "the-post-grid" ),
                        'img' => rtTPG()->assetsUrl . 'images/grid_hover.png',
                    ),
                    'list' => array(
                        'title' => __( "List", "the-post-grid" ),
                        'img' => rtTPG()->assetsUrl . 'images/list.png',
                    ),
                    'isotope' => array(
                        'title' => __( "Isotope", "the-post-grid" ),
                        'img' => rtTPG()->assetsUrl . 'images/isotope.png',
                    ),
            ];

			return apply_filters( 'rt_tpg_layouts_type', $layoutType );
		}

		function rtTPGLayouts() {
			$layouts    = [
                'layout1' => array(
                    'title' => __( "Grid Layout 1", "the-post-grid" ),
                    'layout' => 'grid',
                    'layout_link'    => 'https://www.radiustheme.com/demo/plugins/the-post-grid/',
                    'img' => rtTPG()->assetsUrl . 'images/layouts/grid1.png',
                ),
                'layout12' => array(
	                'title' => esc_html__( "Grid Layout 2", "the-post-grid-pro" ),
	                'layout' => 'grid',
	                'layout_link'    => 'https://www.radiustheme.com/demo/plugins/the-post-grid/grid-layout-2/',
	                'img' => rtTPG()->assetsUrl . 'images/layouts/grid10.png'
                ),
                'layout5' => array(
                    'title' => __( "Grid Hover 1", "the-post-grid" ),
                    'layout' => 'grid_hover',
                    'layout_link'    => 'https://www.radiustheme.com/demo/plugins/the-post-grid/hover-layout-1/',
                    'img' => rtTPG()->assetsUrl . 'images/layouts/grid3.png'
                ),
                'layout6' => array(
	                'title' => esc_html__( "Grid Hover 2", "the-post-grid-pro" ),
	                'layout' => 'grid_hover',
	                'layout_link'    => 'https://www.radiustheme.com/demo/plugins/the-post-grid/hover-layout-2/',
	                'img' => rtTPG()->assetsUrl . 'images/layouts/grid4.png'
                ),
                'layout7' => array(
	                'title' => esc_html__( "Grid Hover 3", "the-post-grid-pro" ),
	                'layout' => 'grid_hover',
	                'layout_link'    => 'https://www.radiustheme.com/demo/plugins/the-post-grid/hover-layout-3/',
	                'img' => rtTPG()->assetsUrl . 'images/layouts/grid5.png'
                ),
                'layout2' => array(
                    'title' => __( "List Layout 1", "the-post-grid" ),
                    'layout' => 'list',
                    'layout_link'    => 'https://www.radiustheme.com/demo/plugins/the-post-grid/list-layout-1/',
                    'img' => rtTPG()->assetsUrl . 'images/layouts/list1.png',
                ),
                'layout3' => array(
                    'title' => __( "List Layout 2", "the-post-grid" ),
                    'layout' => 'list',
                    'layout_link'    => 'https://www.radiustheme.com/demo/plugins/the-post-grid/list-layout-rounded-image/',
                    'img' => rtTPG()->assetsUrl . 'images/layouts/list2.png',
                ),
                'isotope1' => array(
                    'title' => __( "Isotope Layout 1", "the-post-grid" ),
                    'layout' => 'isotope',
                    'layout_link'    => 'https://www.radiustheme.com/demo/plugins/the-post-grid/layout-4-filter/',
                    'img' => rtTPG()->assetsUrl . 'images/layouts/isotope1.png',
                ),
            ];

			return apply_filters( 'tpg_layouts', $layouts );
		}

		function rtTPGItemFields() {
			$items = [
				'heading'       => __( "ShortCode Heading", "the-post-grid" ),
				'title'         => __( "Title", "the-post-grid" ),
				'excerpt'       => __( "Excerpt", "the-post-grid" ),
				'read_more'     => __( "Read More", "the-post-grid" ),
				'post_date'     => __( "Post Date", "the-post-grid" ),
				'author'        => __( "Author", "the-post-grid" ),
				'categories'    => __( "Categories", "the-post-grid" ),
				'tags'          => __( "Tags", "the-post-grid" ),
				'comment_count' => __( "Comment count", "the-post-grid" ),
			];

			return apply_filters( 'tpg_field_selection_items', $items );
		}

		function postLoadingType() {
			return [
				'pagination'      => "Pagination",
				'pagination_ajax' => "Ajax Number Pagination ( Only for Grid )",
				'load_more'       => "Load more button (by ajax loading)",
				'load_on_scroll'  => "Load more on scroll (by ajax loading)",
			];
		}

		function scGridOpt() {
			return [
				'even'    => "Even",
				'masonry' => "Masonry",
			];
		}

		function extraStyle() {
			return apply_filters( 'tpg_extra_style', [
				'title'       => "Title",
				'title_hover' => "Title hover",
				'excerpt'     => "Excerpt",
				'meta_data'   => "Meta Data",
			] );
		}

		function scFontSize() {
			$num = [];
			for ( $i = 10; $i <= 50; $i ++ ) {
				$num[ $i ] = $i . "px";
			}

			return $num;
		}

		function scAlignment() {
			return [
				'left'    => "Left",
				'right'   => "Right",
				'center'  => "Center",
				'justify' => "Justify",
			];
		}

		function scReadMoreButtonPositionList() {
			return [
				'left'   => "Left",
				'right'  => "Right",
				'center' => "Center",
			];
		}


		function scTextWeight() {
			return [
				'normal'  => "Normal",
				'bold'    => "Bold",
				'bolder'  => "Bolder",
				'lighter' => "Lighter",
				'inherit' => "Inherit",
				'initial' => "Initial",
				'unset'   => "Unset",
				100       => '100',
				200       => '200',
				300       => '300',
				400       => '400',
				500       => '500',
				600       => '600',
				700       => '700',
				800       => '800',
				900       => '900',
			];
		}

		function imageCropType() {
			return [
				'soft' => "Soft Crop",
				'hard' => "Hard Crop",
			];
		}

		function rt_filter_type() {
			return [
				'dropdown' => "Dropdown",
				'button'   => "Button",
			];
		}

		function get_pro_feature_list() {
			return '<ol>
                        <li>Fully responsive and mobile friendly.</li>
                        <li>55 Different Layouts</li>
                        <li>Even and Masonry Grid.</li>
                        <li>WooCommerce supported.</li>
                        <li>Custom Post Type Supported</li>
                        <li>Display posts by any Taxonomy like category(s), tag(s), author(s), keyword(s)</li>
                        <li>Order by Id, Title, Created date, Modified date and Menu order.</li>
                        <li>Display image size (thumbnail, medium, large, full)</li>
                        <li>Isotope filter for any taxonomy ie. categories, tags...</li>
                        <li>Query Post with Relation.</li>
                        <li>Fields Selection.</li>
                        <li>All Text and Color control.</li>
                        <li>Enable/Disable Pagination.</li>
                        <li>AJAX Pagination (Load more and Load on Scrolling)</li>
                    </ol>
                <a href="https://www.radiustheme.com/downloads/the-post-grid-pro-for-wordpress/" class="rt-admin-btn" target="_blank">' . __("Get Pro Version", "the-post-grid") . '</a>';
        }

	}

endif;