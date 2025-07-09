# Editor Contracts

[![License](https://img.shields.io/github/license/imponeer/editor-contracts.svg)](LICENSE)
[![GitHub release](https://img.shields.io/github/release/imponeer/editor-contracts.svg)](https://github.com/imponeer/editor-contracts/releases)
[![PHP](https://img.shields.io/packagist/php-v/imponeer/editor-contracts.svg)](http://php.net)
[![Packagist](https://img.shields.io/packagist/dm/imponeer/editor-contracts.svg)](https://packagist.org/packages/imponeer/editor-contracts)

PHP interfaces and contracts for integrating web editors into content management systems. Defines common interfaces for editor adapters, factories, and metadata to standardize how different editor types (WYSIWYG, source code editors) are implemented and used.

## 📦 Installation

Install the package via [Composer](https://getcomposer.org):

```bash
composer require imponeer/editor-contracts
```

## 🏗️ Architecture Overview

This library follows a clean architecture pattern with the following key components:

### Core Interfaces

- **`EditorAdapterInterface`** - Main contract for renderable editor instances
- **`EditorFactoryInterface`** - Factory pattern for creating editor instances
- **`EditorInfoInterface`** - Base contract for editor metadata and capabilities
- **`SourceEditorInfoInterface`** - Extended contract for source code editors
- **`WYSIWYGEditorInfoInterface`** - Extended contract for WYSIWYG editors

### Exception Handling

- **`IncompatibleEditorException`** - Thrown when editor configuration validation fails

## 🚀 Usage Examples

### Implementing an Editor Adapter

```php
use Imponeer\Contracts\Editor\Adapter\EditorAdapterInterface;

class MyCustomEditor implements EditorAdapterInterface
{
    public function getAttributes(): array
    {
        return [
            'id' => 'my-editor',
            'class' => 'custom-editor',
            'data-editor' => 'my-custom-editor'
        ];
    }

    public function getStyleURLs(): array
    {
        return [
            'https://cdn.example.com/editor/styles.css',
            '/assets/custom-editor.css'
        ];
    }

    public function getScriptURLs(): array
    {
        return [
            'https://cdn.example.com/editor/editor.min.js'
        ];
    }

    public function getScriptCode(): string
    {
        return 'MyEditor.init("my-editor", {theme: "modern"});';
    }

    public function __toString(): string
    {
        return '<textarea id="my-editor" class="custom-editor"></textarea>';
    }
}
```

### Creating an Editor Factory

```php
use Imponeer\Contracts\Editor\Factory\EditorFactoryInterface;
use Imponeer\Contracts\Editor\Adapter\EditorAdapterInterface;
use Imponeer\Contracts\Editor\Info\EditorInfoInterface;
use Imponeer\Contracts\Editor\Exceptions\IncompatibleEditorException;

class MyEditorFactory implements EditorFactoryInterface
{
    public function getInfo(): EditorInfoInterface
    {
        return new MyEditorInfo();
    }

    public function create(array $config, bool $checkCompatible = false): EditorAdapterInterface
    {
        if ($checkCompatible && !$this->isConfigValid($config)) {
            throw new IncompatibleEditorException('Invalid configuration provided');
        }

        return new MyCustomEditor($config);
    }

    private function isConfigValid(array $config): bool
    {
        // Implement your validation logic
        return isset($config['theme']) && is_string($config['theme']);
    }
}
```

### Implementing Editor Info

```php
use Imponeer\Contracts\Editor\Info\WYSIWYGEditorInfoInterface;

class MyEditorInfo implements WYSIWYGEditorInfoInterface
{
    public function getName(): string
    {
        return 'My Custom WYSIWYG Editor';
    }

    public function isAvailable(): bool
    {
        // Check if editor assets are available
        return file_exists('/path/to/editor/assets');
    }

    public function getVersion(): string
    {
        return '1.0.0';
    }

    public function getLicense(): string
    {
        return 'MIT';
    }
}
```

### Using in Your Application

```php
// Create factory
$factory = new MyEditorFactory();

// Get editor info
$info = $factory->getInfo();
echo "Editor: " . $info->getName() . " v" . $info->getVersion();

// Create editor instance
$config = ['theme' => 'dark', 'toolbar' => 'full'];
$editor = $factory->create($config, true);

// Render in your template
echo '<html><head>';
foreach ($editor->getStyleURLs() as $styleUrl) {
    echo '<link rel="stylesheet" href="' . $styleUrl . '">';
}
echo '</head><body>';

echo $editor; // Renders the editor HTML

foreach ($editor->getScriptURLs() as $scriptUrl) {
    echo '<script src="' . $scriptUrl . '"></script>';
}
echo '<script>' . $editor->getScriptCode() . '</script>';
echo '</body></html>';
```

## 🔧 Development

### Code Quality Tools

This project uses several tools to maintain code quality:

#### PHP CodeSniffer (PSR-12 compliance)
```bash
composer phpcs
```

#### Fix coding standard violations
```bash
composer phpcbf
```

#### PHPStan static analysis (level max)
```bash
composer phpstan
```

### Testing

The project includes GitHub Actions CI/CD pipeline that:
- Tests on multiple PHP versions
- Validates composer.json
- Runs code style checks
- Performs static analysis

### API Documentation

For detailed API documentation, please visit the [Wiki](https://github.com/imponeer/editor-contracts/wiki).

## 🤝 Contributing

We welcome contributions! Here's how you can help:

### Getting Started

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Make your changes
4. Run code quality checks: `composer phpcs && composer phpstan`
5. Commit your changes: `git commit -m 'Add amazing feature'`
6. Push to the branch: `git push origin feature/amazing-feature`
7. Open a Pull Request

### Guidelines

- Follow PSR-12 coding standards
- Add PHPDoc comments for all public methods
- Ensure PHPStan level max compliance
- Write clear commit messages
- Update documentation if needed

### Reporting Issues

Found a bug or have a suggestion? Please use the [issues tab](https://github.com/imponeer/editor-contracts/issues) to:
- Report bugs with detailed reproduction steps
- Suggest new features or improvements
- Ask questions about usage