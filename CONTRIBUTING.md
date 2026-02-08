# Contributing to Jalali

Thank you for your interest in contributing to the Jalali NextCloud app!

## Development Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/tayyebi/nc-jalali.git
   cd nc-jalali
   ```

2. **Install dependencies**
   ```bash
   # Install PHP dependencies
   composer install
   
   # Install JavaScript dependencies
   npm install
   ```

3. **Set up your development environment**
   - Ensure you have PHP 8.1 or higher
   - Ensure you have Node.js 20.x or higher
   - A NextCloud development instance is recommended for integration testing

## Testing

### Automated Testing

All pull requests automatically run tests via GitHub Actions. The test suite includes:
- PHP linting
- PHPUnit unit tests
- Psalm static analysis
- ESLint (JavaScript)
- Stylelint (CSS/SCSS)

### Running Tests Locally

Before submitting a pull request, please run the tests locally:

```bash
# Quick way - use the test runner script
./run-tests.sh

# Or run specific test suites
./run-tests.sh php    # PHP tests only
./run-tests.sh js     # JavaScript tests only
./run-tests.sh lint   # Linting only
```

### Manual Test Commands

```bash
# PHP Tests
composer lint              # Check PHP syntax
composer test:unit         # Run PHPUnit tests
composer psalm             # Run static analysis
composer cs:check          # Check code style
composer cs:fix            # Fix code style issues

# JavaScript Tests
npm run lint               # Run ESLint
npm run stylelint          # Run Stylelint
npm run build              # Build for production
npm run dev                # Build for development
npm run watch              # Watch mode for development
```

## Code Style

- **PHP**: Follow PSR-12 coding standards
- **JavaScript**: Follow the NextCloud ESLint configuration
- **CSS/SCSS**: Follow the NextCloud Stylelint configuration

Use the automatic fixers when possible:
```bash
composer cs:fix    # Fix PHP code style
```

## Writing Tests

### PHP Unit Tests

Tests are located in `tests/unit/` and should mirror the structure of the `lib/` directory.

Example test structure:
```php
<?php
namespace Controller;

use OCA\Jalali\Controller\YourController;
use OCP\IRequest;
use PHPUnit\Framework\TestCase;

class YourControllerTest extends TestCase {
    public function testYourMethod() {
        $request = $this->createMock(IRequest::class);
        $controller = new YourController('jalali', $request);
        
        $result = $controller->yourMethod();
        
        $this->assertEquals('expected', $result);
    }
}
```

### Running Individual Tests

```bash
# Run a specific test file
./vendor-bin/phpunit/vendor/bin/phpunit tests/unit/Controller/ApiTest.php

# Run tests with coverage
composer test:unit -- --coverage-text
```

## Submitting Changes

1. **Fork the repository** and create a new branch from `main`
2. **Make your changes** following the code style guidelines
3. **Add tests** for any new functionality
4. **Run the test suite** to ensure all tests pass
5. **Commit your changes** with clear, descriptive commit messages
6. **Push to your fork** and submit a pull request

### Pull Request Guidelines

- Keep changes focused and atomic
- Write clear commit messages
- Include tests for new features
- Update documentation as needed
- Ensure all automated tests pass
- Link to any relevant issues

## Getting Help

- **Community Forum**: https://help.nextcloud.com/c/dev/11
- **Community Chat**: https://cloud.nextcloud.com/call/xs25tz5y
- **Documentation**: https://docs.nextcloud.com/server/latest/developer_manual

## License

By contributing to Jalali, you agree that your contributions will be licensed under the AGPL-3.0-or-later license.
