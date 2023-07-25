<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor abTeam Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class AB_Team_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve abTeam widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'team';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve abTeam widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Team Carousel', 'ab-team-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve abTeam widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the abTeam widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the abTeam widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'team', 'url', 'link' ];
	}

	/**
	 * Register abTeam widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

        $this->start_controls_section(
            'team_members_section',
            [
                'label' => 'Team Members',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => 'Name',
                'type' => Controls_Manager::TEXT,
                'default' => 'John Doe',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'label' => 'Designation',
                'type' => Controls_Manager::TEXT,
                'default' => 'Designer',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => 'Description',
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'rows' => 5,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => 'Image',
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'team_members',
            [
                'label' => 'Team Members',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => 'John Doe',
                        'designation' => 'Designer',
                        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                        'image' => '',
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

        // Add Owl Carousel settings
	$this->start_controls_section(
		'carousel_settings_section',
		[
			'label' => 'Carousel Settings',
			'tab'   => Controls_Manager::TAB_STYLE,
		]
	);

	$this->add_control(
		'autoplay',
		[
			'label'   => 'Autoplay',
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		]
	);

	$this->add_control(
		'loop',
		[
			'label'   => 'Loop',
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		]
	);
    $this->add_control(
		'hoverPause',
		[
			'label'   => 'Mouse Hover Pause',
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		]
	);

	$this->add_control(
		'dots',
		[
			'label'   => 'Dots Navigation',
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		]
	);

	$this->add_control(
		'nav',
		[
			'label'   => 'Navigation Arrows',
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		]
	);

	$this->add_control(
		'items',
		[
			'label'   => 'Items to Show',
			'type'    => Controls_Manager::NUMBER,
			'default' => 3,
			'min'     => 1,
			'max'     => 6,
		]
	);

	$this->end_controls_section();

	}

	/**
	 * Render abTeam widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="row justify-content-center text-center">
        <div class="col-md-10">
        <div class="owl-carousel owl-theme" id="staff">';
        foreach ($settings['team_members'] as $member) {
            ?>
            <div class="item">
                     <div class="box-b staff">
                        <div class="box-img">
                           <img src="<?php echo $member['image']['url']; ?>" alt="<?php echo $member['name']; ?>">
                        </div>
                        <h3><?php echo $member['name']; ?></h3>
                        <h5> <?php echo $member['designation']; ?></h5>
                        <p class="member-description"><?php echo $member['description']; ?></p>
                     </div>
                  </div>
            <?php
        }
        echo '</div></div></div>';
      // Get carousel settings from controls
    $autoplay = $this->get_settings('autoplay');
    $loop = $this->get_settings('loop');
    $hoverPause = $this->get_settings('hoverPause');
    $nav = $this->get_settings('nav');
    $items = $this->get_settings('items');

    // Output the script with applied settings
    echo '<script>';
    echo 'jQuery(document).ready(function($) {
        $("#staff").owlCarousel({
            loop: ' . ($loop ? 'true' : 'false') . ',
            margin: 10,
            autoplay: ' . ($autoplay ? 'true' : 'false') . ',
            autoplayHoverPause:' . ($hoverPause ? 'true' : 'false') . ',
            dots: ' . ($dots ? 'true' : 'false') . ',
            nav: ' . ($nav ? 'true' : 'false') . ',
            items: ' . $items . '
        });
    });';
    echo '</script>';
        
    }
}