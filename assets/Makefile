BOOTSTRAP_LESS = ./less/bootstrap.less
BOOTSTRAP_RESPONSIVE_LESS = ./less/responsive.less
BOOTSTRAP_EDITOR_LESS = ./less/editor-style.less

.PHONY: bootstrap

bootstrap : 
	mkdir -p ./css
	mkdir -p ./js
	recess --compress ${BOOTSTRAP_LESS} > ./css/bootstrap.css
	recess --compress ${BOOTSTRAP_RESPONSIVE_LESS} > ./css/bootstrap-responsive.css
	recess --compress ${BOOTSTRAP_EDITOR_LESS} > ./css/editor-style.css
	cat js-source/bootstrap-transition.js js-source/bootstrap-alert.js js-source/bootstrap-button.js js-source/bootstrap-carousel.js js-source/bootstrap-collapse.js js-source/bootstrap-dropdown.js js-source/bootstrap-modal.js js-source/bootstrap-tooltip.js js-source/bootstrap-popover.js js-source/bootstrap-scrollspy.js js-source/bootstrap-tab.js js-source/bootstrap-typeahead.js js-source/bootstrap-affix.js > js/bootstrap.js
	uglifyjs -nc js/bootstrap.js > js/bootstrap.min.tmp.js
	echo "/*!\n* Bootstrap.js by @fat & @mdo\n* Copyright 2012 Twitter, Inc.\n* http://www.apache.org/licenses/LICENSE-2.0.txt\n*/" > js/copyright.js
	cat js/copyright.js js/bootstrap.min.tmp.js > js/plugins.js
	rm js/copyright.js js/bootstrap.min.tmp.js js/bootstrap.js
