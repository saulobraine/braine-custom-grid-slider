class CustomGridSliderBraine extends elementorModules.frontend.handlers.Base {

  getDefaultSettings() {
    return {
      selectors: {
        container: '.custom-grid-slider-braine-container',
        background_item: '.custom-grid-slider-background',
        content_item: '.custom-grid-slider-braine-content-item',
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    return {
      $container: this.$element.find(selectors.container),
      $background_item: this.$element.find(selectors.background_item),
      $content_item: this.$element.find(selectors.content_item),
    }
  }

  bindEvents() {

    var parent = this;

    this.elements.$content_item.on('click', function (e) {
      e.preventDefault();
    });

    this.elements.$content_item.on('mouseover', function () {
      parent.elements.$background_item.removeClass('active');
      parent.$element.find(`.elementor-repeater-item-${this.rel}`).addClass('active');
    });
  }

  // Init
  async onInit(...args) {
    super.onInit(...args);
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
  }
}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(CustomGridSliderBraine, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/braine-custom-grid-slider.default', addHandler);
});