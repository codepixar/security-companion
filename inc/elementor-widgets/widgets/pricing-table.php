<?php
namespace Securityelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Security elementor Pricing section widget.
 *
 * @since 1.0
 */
class Security_Pricing extends Widget_Base {

	public function get_name() {
		return 'security-pricing';
	}

	public function get_title() {
		return __( 'Pricing Table', 'security-companion' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return [ 'security-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  Pricing table content ------------------------------
		$this->start_controls_section(
			'pricing_content',
			[
				'label' => __( 'Pricing Table', 'security-companion' ),
			]
		);
        $this->add_control(
            'pricing_title', [
                'label' => __( 'Title', 'security-companion' ),
                'type'  => Controls_Manager::TEXT,
                'label_block' => true

            ]
        );
        $this->add_control(
            'pricing_currency', [
                'label' => __( 'Currency', 'security-companion' ),
                'type'  => Controls_Manager::TEXT,
                'default' => '$'

            ]
        );
        $this->add_control(
            'pricing_pricie', [
                'label' => __( 'Price', 'security-companion' ),
                'type'  => Controls_Manager::TEXT,
                'default' => '39'

            ]
        );
        $this->add_control(
            'pricing_durationunit', [
                'label' => __( 'Duration Unit', 'security-companion' ),
                'type'  => Controls_Manager::TEXT,
                'default' => 'per'

            ]
        );
        $this->add_control(
            'pricing_duration', [
                'label' => __( 'Duration', 'security-companion' ),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Month'

            ]
        );
        $this->add_control(
            'features', [
                'label' => __( 'Features List', 'security-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name' => 'label',
                        'label' => __( 'Feature', 'security-companion' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => '10 GB Space'
                    ]
                ],
            ]
        );
        $this->add_control(
            'pricing_btnlabel', [
                'label' => __( 'Button Label', 'security-companion' ),
                'type'  => Controls_Manager::TEXT,
                'label_block' => true

            ]
        );
        $this->add_control(
            'pricing_btnurl', [
                'label' => __( 'Button Url', 'security-companion' ),
                'type'  => Controls_Manager::TEXT,
                'label_block' => true

            ]
        );

		$this->end_controls_section(); // End Pricing content

    /**
     * Style Tab
     * ------------------------------ Style Section ------------------------------
     *
     */

    $this->start_controls_section(
        'style_table', [
            'label' => __( 'Pricing Table Style', 'security-companion' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_control(
        'color_title', [
            'label'     => __( 'Title Color', 'security-companion' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#222222',
            'selectors' => [
                '{{WRAPPER}} .single-price .price-top h4' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
        'color_titlebg', [
            'label'     => __( 'Title Background Color', 'security-companion' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#fbfcff',
            'selectors' => [
                '{{WRAPPER}} .single-price .price-top' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
        'color_pricebbg', [
            'label'     => __( 'Price box Background Color', 'security-companion' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f9f9ff',
            'selectors' => [
                '{{WRAPPER}} .single-price .price-bottom' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
        'color_priceboxhoverbg', [
            'label'     => __( 'Price box Hover Background Color', 'security-companion' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#fab700',
            'selectors' => [
                '{{WRAPPER}} .single-price:hover .price-bottom' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();

    ?>

    <div class="single-price no-padding">
        
        <?php
        //
        if( ! empty( $settings['pricing_title'] ) ) {
            echo security_heading_tag(
                array(
                    'tag' => 'h4',
                    'text' => esc_html( $settings['pricing_title'] ),
                    'wrap_before'   => '<div class="price-top">',
                    'wrap_after'    => '</div>',
                )
            );
        }
        //
        if( is_array( $settings['features'] ) && count( $settings['features'] ) > 0 ) {
            echo '<ul class="lists">';
                foreach( $settings['features'] as $feature ) {
                    echo '<li>'.esc_html( $feature['label'] ).'</li>';
                }
            echo '</ul>';
        }
        ?>
        <div class="price-bottom">
            <div class="price-wrap d-flex flex-row justify-content-center">
            <?php    echo '<span class="price">' . esc_html( $settings['pricing_currency'] ) . '</span><h1> ' . esc_html( $settings['pricing_pricie'] ) . ' </h1><span class="time">' . esc_html( $settings['pricing_durationunit'] ) . ' <br> ' . esc_html( $settings['pricing_duration'] ) . '</span>'; ?>
            </div>
            <?php 
            if( ! empty( $settings['pricing_btnlabel'] ) && ! empty( $settings['pricing_btnurl'] ) ) {
                echo security_anchor_tag(
                    array(
                        'text'   => esc_html( $settings['pricing_btnlabel'] ),
                        'url'    => esc_html( $settings['pricing_btnurl'] ),
                        'class'  => 'primary-btn header-btn',
                    )
                );
            }
            ?>
        </div>
    </div>

    <?php

    }
	
}
