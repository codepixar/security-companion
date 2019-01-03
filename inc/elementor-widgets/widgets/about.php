<?php
namespace Securityelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Security elementor about page section widget.
 *
 * @since 1.0
 */
class Security_About extends Widget_Base {

	public function get_name() {
		return 'security-aboutus';
	}

	public function get_title() {
		return __( 'About Us', 'security-companion' );
	}

	public function get_icon() {
		return 'eicon-post-content';
	}

	public function get_categories() {
		return [ 'security-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  About Section Heading ------------------------------
        
        $this->start_controls_section(
            'aboutus_heading',
            [
                'label' => __( 'Section Heading', 'security-companion' ),
            ]
        );
        $this->add_control(
            'aboutus_htitle',
            [
                'label'     => esc_html__( 'Title', 'security-companion' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Few words about our Museum',
                'label_block' => true
            ]
        );
        $this->add_control(
            'aboutus_hsubtitle',
            [
                'label'     => esc_html__( 'Sub Title', 'security-companion' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Who are in extremely love with eco friendly system.',
                'label_block' => true
            ]
        );
        $this->end_controls_section(); // End title

        // ----------------------------------------  About content ------------------------------
        $this->start_controls_section(
            'about_content',
            [
                'label' => __( 'About Content', 'security-companion' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'security-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'We Realize that there are reduced Wastege Stand out', 'security-companion' )
            ]
        );
        $this->add_control(
            'content',
            [
                'label'         => esc_html__( 'Contact', 'security-companion' ),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => esc_html__( 'inappropriate behaviour is often laughed off as “boys will be boys,” women face higher conduct standards – especially in the workplace. That’s why it’s crucial that, as women.', 'security-companion' )
            ]
        );
        $this->add_control(
            'featured_img',
            [
                'label'         => esc_html__( 'Featured Image', 'security-companion' ),
                'type'          => Controls_Manager::MEDIA,
                'label_block'   => true
            ]
        );

        $this->end_controls_section(); // End content

        /**
         * Style Tab
         * ------------------------------ Style ------------------------------
         *
         */
        $this->start_controls_section(
            'style_section_heading', [
                'label' => __( 'Style Section Heading', 'security-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_headingtitle', [
                'label'     => __( 'Title Color', 'security-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .title h1'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_subtitle', [
                'label'     => __( 'Sub Title Color', 'security-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#777',
                'selectors' => [
                    '{{WRAPPER}} .title p' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();


        /**
         * Style Tab
         * ------------------------------ Style ------------------------------
         *
         */
        $this->start_controls_section(
            'stylecolor', [
                'label' => __( 'Style Color', 'security-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_title', [
                'label'     => __( 'Title Color', 'security-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#777',
                'selectors' => [
                    '{{WRAPPER}} .info-content h2'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_desc', [
                'label'     => __( 'Description Color', 'security-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#222',
                'selectors' => [
                    '{{WRAPPER}} .info-content p' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();

    ?>

    <!-- Start about info Area -->
    <section class="section-gap info-area" id="about">
        <div class="container">
            <?php 
            // Section heading
            security_section_heading( $settings['aboutus_htitle'], $settings['aboutus_hsubtitle'] );
            ?>

            <div class="single-info row mt-40">
                <div class="col-lg-6 col-md-12 mt-120 text-center no-padding info-left">
                    <div class="info-thumb">
                        <?php 
                        if( !empty( $settings['featured_img']['url'] ) ){
                            echo security_img_tag(
                                array(
                                    'url'   =>  esc_url( $settings['featured_img']['url'] ),
                                    'class' => 'img-fluid'
                                )
                            );
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 no-padding info-rigth">
                    <div class="info-content">
                        <?php 
                        // Title
                        if( !empty( $settings['title'] ) ){
                            echo security_heading_tag(
                                array(
                                    'tag' => 'h2',
                                    'class' => 'pb-30',
                                    'text' => esc_html( $settings['title'] ),
                                )
                            );
                        }
                        // Content
                        if( !empty( $settings['content'] ) ){
                            echo security_get_textareahtml_output( $settings['content'] );
                        }
                        ?>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <?php

        }
	
}
