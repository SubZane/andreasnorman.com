# this is the source folder 
src_dir=src

# this is the deploy folder
deploy_dir=bin

# scripts dir
js_dir=$(src_dir)/assets/js

# If using CSS instead of SASS
css_dir=$(src_dir)/assets/css
css_files=bootstrap.css font-awesome.css main.css pagination.css comments.css fluidbox.css canvas.css sharrre.css responsive.css
exception_css= ie.css

# script files
scripts = plugins.min.js custom.js
exception_js = jquery.min.js iefixes.min.js

#compile: clean init setup make_css minjs exceptionjs copycontent
compile: make_css minjs exceptionjs copycontent exceptionjs

setup:
	@curl http://code.jquery.com/jquery.min.js 																-o $(src_dir)/assets/js/jquery.min.js

	@curl https://raw.github.com/scottjehl/Respond/master/dest/respond.min.js 			-o $(src_dir)/assets/js/iefixes.js
	@curl https://raw.github.com/aFarkas/html5shiv/master/dist/html5shiv.js 	>> $(src_dir)/assets/js/iefixes.js

	@uglifyjs -c --output $(src_dir)/assets/js/iefixes.min.js $(src_dir)/assets/js/iefixes.js
	@rm $(src_dir)/assets/js/iefixes.js

	@curl http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js 							-o $(src_dir)/assets/js/plugins.js
	#@curl http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js 				>> $(src_dir)/assets/js/plugins.js
	@curl https://raw.github.com/davatron5000/FitVids.js/master/jquery.fitvids.js							>> $(src_dir)/assets/js/plugins.js
	#@curl https://raw.github.com/ftlabs/fastclick/master/lib/fastclick.js 										>> $(src_dir)/assets/js/plugins.js
	@curl https://raw2.github.com/cowboy/jquery-outside-events/master/jquery.ba-outside-events.min.js >> $(src_dir)/assets/js/plugins.js
	@curl https://raw.github.com/Julienh/Sharrre/master/jquery.sharrre.min.js 								>> $(src_dir)/assets/js/plugins.js
	@curl https://raw.github.com/simplefocus/FlowType.JS/master/flowtype.js >> $(src_dir)/assets/js/plugins.js
	@curl http://imagesloaded.desandro.com/imagesloaded.pkgd.min.js               >> $(src_dir)/assets/js/plugins.js
	@curl https://raw2.github.com/terrymun/Fluidbox/gh-pages/jquery.fluidbox.min.js 				>> $(src_dir)/assets/js/plugins.js

	@uglifyjs -c --output $(src_dir)/assets/js/plugins.min.js $(src_dir)/assets/js/plugins.js
	@rm $(src_dir)/assets/js/plugins.js

init:
	@echo "-------------------------------------------------------------------\n"
	@echo "                          Compiling...\n"
	@echo "-------------------------------------------------------------------\n"
	@mkdir -p $(deploy_dir)

copycontent:
	@mkdir -p $(deploy_dir)/assets/fonts
	@mkdir -p $(deploy_dir)/assets/img

	@cp -r $(src_dir)/assets/fonts/ $(deploy_dir)/assets/fonts/
	@cp -r $(src_dir)/assets/img/ $(deploy_dir)/assets/img/

make_css:
	@mkdir -p $(deploy_dir)/assets/css
	@for f in $(css_files); do \
		(cat $(css_dir)/$$f >> $(deploy_dir)/assets/css/styles.css) || exit; \
	done	
	
	@recess --compress $(deploy_dir)/assets/css/styles.css > $(deploy_dir)/assets/css/styles.min.css
	@rm $(deploy_dir)/assets/css/styles.css

# Concat all javascript into one single file.
concatjs:
	@mkdir -p $(deploy_dir)/assets/js
	@for f in $(scripts); do \
		(cat $(js_dir)/$$f >> $(deploy_dir)/assets/js/main.js) || exit; \
	done	

# Minify the concated JS file
minjs:
	@make concatjs
	@uglifyjs -c --output $(deploy_dir)/assets/js/main.min.js $(deploy_dir)/assets/js/main.js
	@rm $(deploy_dir)/assets/js/main.js

#These JS are exceptions and cannot be minified with the others
exceptionjs:
	@for f in $(exception_js); do \
		(cp $(js_dir)/$$f $(deploy_dir)/assets/js/) || exit; \
	done	

exceptioncss:
	@for f in $(exception_css); do \
		(cp $(css_dir)/$$f $(deploy_dir)/assets/css/) || exit; \
	done	

clean:
	@rm -r $(deploy_dir)
