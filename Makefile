BIN = vendor/bin

test:
	@$(BIN)/phpunit tests
lint:
	@$(BIN)/phpcs
lint-fix:
	@$(BIN)/phpcbf
