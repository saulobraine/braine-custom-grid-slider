<?php

namespace Braine\Widgets;

if(!defined('ABSPATH')) {
    exit;
}

class CustomGridSlider_Braine extends \Elementor\Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_script('braine-custom-grid-slider', plugins_url('/assets/js/custom-grid-slider.js', __FILE__), ['elementor-frontend', 'jquery', 'swiper'], '1.0.0', true);

        wp_register_style('braine-custom-grid-slider', plugins_url('/assets/css/custom-grid-slider.css', __FILE__), ['elementor-frontend']);
    }

    public function get_style_depends() {
        return ['braine-custom-grid-slider'];
    }

    public function get_script_depends() {
        return ['braine-custom-grid-slider'];
    }

    public function get_name() {
        return 'braine-custom-grid-slider';
    }

    public function get_title() {
        return 'Grid de Slider customizado • Braine';
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['braine'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Imagens', 'custom-grid-slider-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Escolher layout
        $this->add_control(
            'layout',
            [
                'label' => __('Layout', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'layout-1',
                'options' => [
                    'layout-1' => __('Layout 1', 'custom-grid-slider-braine'),
                    'layout-2' => __('Layout 2', 'custom-grid-slider-braine'),
                    'layout-3' => __('Layout 3', 'custom-grid-slider-braine'),
                    'layout-4' => __('Layout 4', 'custom-grid-slider-braine'),
                ],
            ]
        );

        $this->add_control(
            'layout_1_notice',
            [
                'label' => __('Layout 1', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('<hr style="margin: 10px"><p>Inclua <strong>8 imagens</strong> para o layout ficar correto</p>', 'custom-grid-slider-braine'),
                'condition' => [
                    'layout' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'layout_2_notice',
            [
                'label' => __('Layout 2', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('<hr style="margin: 10px"><p>Inclua <strong>5 imagens</strong> para o layout ficar correto</p>', 'custom-grid-slider-braine'),
                'condition' => [
                    'layout' => 'layout-2',
                ],
            ]
        );
        $this->add_control(
            'layout_3_notice',
            [
                'label' => __('Layout 3', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('<hr style="margin: 10px"><p>Inclua <strong>5 imagens</strong> para o layout ficar correto</p>', 'custom-grid-slider-braine'),
                'condition' => [
                    'layout' => 'layout-3',
                ],
            ]
        );
        $this->add_control(
            'layout_4_notice',
            [
                'label' => __('Layout 4', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('<hr style="margin: 10px"><p>Inclua <strong>6 imagens</strong> para o layout ficar correto</p>', 'custom-grid-slider-braine'),
                'condition' => [
                    'layout' => 'layout-4',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_responsive_control(
            'list_image',
            [
                'label' => __('Imagem de fundo', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.custom-grid-slider-background' => 'background-image: url("{{URL}}")'
                ],
            ]
        );

        $repeater->add_control(
            'list_title',
            [
                'label' => __('Título', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Título', 'custom-grid-slider-braine'),
                'label_block' => true,
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'list_subtitle',
            [
                'label' => __('Subtítulo', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Lorem ipsum', 'custom-grid-slider-braine'),
                'label_block' => true,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'custom_grid_slider_list',
            [
                'label' => __('Lista de Imagens', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Título 1', 'custom-grid-slider-braine'),
                        'list_subtitle' => __('Subtítulo 1', 'custom-grid-slider-braine'),
                    ],
                ],
                'title_field' => '{{list_title}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'typography_style_section',
            [
                'label' => __('Tipografia', 'custom-grid-slider-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'custom_grid_slider_title_color',
            [
                'label' => __('Cor de fundo do item', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFDA00',
                'selectors' => [
                    '{{WRAPPER}} .custom-grid-slider-braine-container .custom-grid-slider-braine-content-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'custom_grid_slider_title_color',
            [
                'label' => __('Título', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#040404',
                'selectors' => [
                    '{{WRAPPER}} .custom-grid-slider-braine-container .custom-grid-slider-braine-content-item .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'custom_grid_slider_subtitle_color',
            [
                'label' => __('Sub Título', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#040404',
                'selectors' => [
                    '{{WRAPPER}} .custom-grid-slider-braine-container .custom-grid-slider-braine-content-item .subtitle' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .custom-grid-slider-braine-container .custom-grid-slider-braine-content-item .subtitle::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'custom_grid_slider_title_typography',
                'label' => __('Título', 'custom-grid-slider-braine'),
                'selector' => '{{WRAPPER}} .custom-grid-slider-braine-container .custom-grid-slider-braine-content-item .title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'custom_grid_slider_subtitle_typography',
                'label' => __('Sub Título', 'custom-grid-slider-braine'),
                'selector' => '{{WRAPPER}} .custom-grid-slider-braine-container .custom-grid-slider-braine-content-item .subtitle',
            ]
        );

        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => __('Imagem', 'custom-grid-slider-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'custom_grid_slider_image_height',
            [
                'label' => __('Altura da Imagem', 'custom-grid-slider-braine'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 325,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-grid-slider-braine-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_element = $this->get_id();

        if ($settings['custom_grid_slider_list']): ?>
<div class='custom-grid-slider-braine-container'>
  <?php foreach ($settings['custom_grid_slider_list'] as $index => $item):	?>
  <div id="<?= $item['_id'] ?>"
    class="custom-grid-slider-braine-item elementor-repeater-item-<?= $item['_id'] ?> custom-grid-slider-background<?= ($index == 0) ? ' active' : '' ?>">
  </div>
  <?php	endforeach; ?>

  <div class="layout-container <?= $settings['layout'] ?>">
    <?php foreach ($settings['custom_grid_slider_list'] as $index => $item):	?>
    <a class="custom-grid-slider-braine-content-item<?= ($index == 0) ? ' active' : '' ?>" rel="<?= $item['_id'] ?>">
      <div class="title"><?= $item['list_title'] ?></div>
      <div class="subtitle"><?= $item['list_subtitle'] ?></div>
    </a>
    <?php	endforeach; ?>
  </div>
</div>
<?php endif;
    }
}
