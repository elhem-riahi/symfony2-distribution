install:
	app/console doctrine:database:create
	app/console doctrine:schema:create
	app/console doctrine:fixture:load --no-interaction
	app/console cache:clear --env=prod
	app/console assets:install --symlink
	app/console assetic:dump --env=prod

deploy-configure:
	curl -s http://getcomposer.org/installer | php
	php composer.phar install