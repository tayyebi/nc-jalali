# Automatic Testing Overview

This document provides an overview of the automated testing infrastructure for the Jalali NextCloud app.

## What Automatic Tests Are Available?

### 1. PHP Tests

#### Unit Tests (PHPUnit)
- **Location**: `tests/unit/`
- **Framework**: PHPUnit 10.5
- **Current Coverage**:
  - `ApiTest.php` - Tests the API controller endpoint
  - `PageTest.php` - Tests the page controller and template rendering

**Run Command**:
```bash
composer test:unit
```

#### PHP Linting
- **Purpose**: Checks PHP syntax errors in all PHP files
- **Coverage**: All files in `lib/`, `appinfo/`, `templates/`, `tests/`
- **Run Command**:
```bash
composer lint
```

#### Static Analysis (Psalm)
- **Purpose**: Detects type errors and potential bugs
- **Configuration**: `psalm.xml`
- **Level**: Configured for NextCloud development
- **Run Command**:
```bash
composer psalm
```

#### Code Style (PHP-CS-Fixer)
- **Purpose**: Ensures consistent code formatting
- **Standard**: PSR-12 + NextCloud conventions
- **Run Commands**:
```bash
composer cs:check  # Check only
composer cs:fix    # Auto-fix issues
```

### 2. JavaScript Tests

#### ESLint
- **Purpose**: JavaScript code quality and style checking
- **Configuration**: NextCloud ESLint config
- **Coverage**: All files in `src/`
- **Run Command**:
```bash
npm run lint
```

#### Stylelint
- **Purpose**: CSS/SCSS style checking
- **Configuration**: NextCloud Stylelint config
- **Coverage**: All Vue, SCSS, and CSS files in `src/`
- **Run Command**:
```bash
npm run stylelint
```

#### Build Test
- **Purpose**: Ensures JavaScript builds successfully
- **Tool**: Webpack with NextCloud configuration
- **Run Command**:
```bash
npm run build
```

### 3. Continuous Integration (GitHub Actions)

#### Workflow: `tests.yml`
- **Triggers**: 
  - Push to `main` or `master` branch
  - Pull requests to `main` or `master` branch

#### PHP Test Matrix
Tests run on multiple PHP versions:
- PHP 8.1
- PHP 8.2
- PHP 8.3

**Steps**:
1. Validate composer.json and composer.lock
2. Install PHP dependencies
3. Run PHP lint
4. Install PHPUnit
5. Run unit tests
6. Install Psalm
7. Run static analysis

#### JavaScript Test Suite
Tests run on Node.js 20.x

**Steps**:
1. Install npm dependencies
2. Run ESLint
3. Run Stylelint
4. Build assets

#### Caching
- Composer packages cached per PHP version
- npm packages cached per Node.js version

### 4. Local Testing Tools

#### Test Runner Script (`run-tests.sh`)
Convenient script for running tests locally:

```bash
./run-tests.sh          # Run all tests
./run-tests.sh php      # PHP tests only
./run-tests.sh js       # JavaScript tests only
./run-tests.sh lint     # Linting only
```

Features:
- Color-coded output (✓ PASSED / ✗ FAILED)
- Detailed error messages on failure
- Easy selection of test suites

## Test Coverage

### Current Coverage
- **Controllers**: 100% (ApiController, PageController)
- **Application Bootstrap**: Tested via integration
- **Templates**: Validated via controller tests

### What's Tested
✅ API endpoints return correct responses  
✅ Page controller loads correct template  
✅ Template responses have correct structure  
✅ All PHP files have valid syntax  
✅ Code passes static analysis  
✅ JavaScript code follows style guidelines  
✅ CSS/SCSS follows style guidelines  
✅ Assets build successfully  

### What Could Be Added
- Integration tests with NextCloud
- Frontend component tests (Vue.js)
- E2E tests with Cypress or Playwright
- Performance tests
- Accessibility tests

## CI/CD Fixes

### Bootstrap Configuration
The test bootstrap (`tests/bootstrap.php`) is designed to work in two environments:
1. **Full NextCloud installation**: Loads NextCloud core bootstrap and hooks
2. **Standalone CI/CD**: Runs tests without NextCloud core dependencies

This allows the test suite to run in GitHub Actions without requiring a full NextCloud server setup.

### NPM Configuration
The workflow uses `npm install` instead of `npm ci` for pragmatic reasons:
- **Current State**: Project doesn't commit lock files
- **Tradeoff**: Non-deterministic builds vs. immediate CI functionality
- **Recommendation**: For production apps, add `package-lock.json` and switch to `npm ci` for reproducible builds
- **Current Rationale**: Acceptable for development-stage app where getting CI working is the priority

To improve build determinism in the future:
```bash
# Generate and commit lock file
npm install
git add package-lock.json
# Update workflow to use 'npm ci' and enable cache
```

## Adding New Tests

### Adding a PHP Unit Test

1. Create test file in `tests/unit/` matching the structure of `lib/`
2. Extend `PHPUnit\Framework\TestCase`
3. Use the namespace `Controller` (or appropriate namespace)
4. Mock dependencies using PHPUnit's `createMock()`

Example:
```php
<?php
namespace Controller;

use OCA\Jalali\Controller\YourController;
use OCP\IRequest;
use PHPUnit\Framework\TestCase;

class YourTest extends TestCase {
    public function testYourMethod() {
        $request = $this->createMock(IRequest::class);
        $controller = new YourController('jalali', $request);
        
        $result = $controller->yourMethod();
        
        $this->assertEquals('expected', $result);
    }
}
```

### Running Tests During Development

**Watch mode for JavaScript**:
```bash
npm run watch  # Rebuilds on file changes
```

**Quick PHP checks**:
```bash
composer lint              # Fast syntax check
php -l lib/Your/File.php  # Check single file
```

**Single test file**:
```bash
./vendor-bin/phpunit/vendor/bin/phpunit tests/unit/Controller/YourTest.php
```

## CI/CD Status

View test results:
- **GitHub Actions**: https://github.com/tayyebi/nc-jalali/actions
- **README Badge**: Shows current test status

All pull requests must pass:
✅ All PHP versions (8.1, 8.2, 8.3)  
✅ PHP linting  
✅ PHPUnit tests  
✅ Psalm static analysis  
✅ ESLint  
✅ Stylelint  
✅ Build verification  

## Best Practices

1. **Write tests first** (TDD) when adding new features
2. **Run tests locally** before pushing
3. **Keep tests fast** - unit tests should run quickly
4. **Mock external dependencies** - don't rely on external services
5. **One assertion per test** when possible
6. **Clear test names** - describe what's being tested
7. **Fix failing tests immediately** - don't let CI stay red

## Troubleshooting

### Tests fail locally but pass in CI
- Check PHP/Node versions match CI matrix
- Clear vendor and node_modules, reinstall
- Check for uncommitted changes

### Tests pass locally but fail in CI
- Ensure all dependencies are in composer.json/package.json
- Check for environment-specific code
- Review CI logs for specific errors

### Psalm reports errors
```bash
composer bin psalm install --no-dev  # Reinstall Psalm
composer psalm -- --clear-cache      # Clear cache
```

### PHPUnit can't find classes
```bash
composer dump-autoload  # Regenerate autoload files
```

## Resources

- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Psalm Documentation](https://psalm.dev/docs/)
- [NextCloud Developer Manual](https://docs.nextcloud.com/server/latest/developer_manual/)
- [GitHub Actions Documentation](https://docs.github.com/en/actions)

---

**Last Updated**: 2026-02-08  
**Maintained By**: nc-jalali contributors
