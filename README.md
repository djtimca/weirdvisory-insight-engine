# Tim's Weirdvisory Strategic Insight Engine

<p align="center">
<img src="https://img.shields.io/badge/Laravel-Latest-red" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.1+-blue" alt="PHP Version">
<img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

## Overview

Tim's Weirdvisory Strategic Insight Engine is an interactive web application that showcases strategic thinking, problem-solving approaches, and technical acumen with AI. The application allows users to input complex or "weird" business problems and receive strategic insights generated with Tim's unique problem-solving approach.

## Features

- **Interactive Problem Submission**: Users can submit their complex business challenges through a user-friendly interface
- **AI-Powered Strategic Insights**: Leverages the Gemini API to generate insights with Tim's unique "good-weird" approach
- **Responsive Design**: Beautiful, modern UI that works across devices
- **Secure API Integration**: Backend-driven API calls to keep your Gemini API key secure

## Technology Stack

- **Frontend**: HTML5, CSS3 (Bootstrap 5), JavaScript (Vanilla JS)
- **Backend**: PHP 8.1+, Laravel (latest)
- **LLM Integration**: Guzzle HTTP client with Gemini API
- **External Resources**: Font Awesome (icons), Google Fonts (Inter)

## Local Development

### Prerequisites

- PHP 8.1 or higher
- Composer
- Gemini API key

### Setup

1. Clone the repository
   ```bash
   git clone https://github.com/djtimca/weirdvisory-insight-engine.git
   cd weirdvisory-insight-engine
   ```

2. Install dependencies
   ```bash
   composer install
   ```

3. Configure environment
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Update the `.env` file with your Gemini API key
   ```
   GEMINI_API_URL="https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent"
   GEMINI_API_KEY="YOUR_API_KEY_HERE"
   ```

5. Start the development server
   ```bash
   php artisan serve
   ```

6. Visit `http://localhost:8000` in your browser

## Testing

### Frontend Testing

- **Input Validation**: Test with empty inputs, short inputs, and very long inputs
- **Loading States**: Verify loading indicators appear during API calls
- **Error Handling**: Test with invalid API keys and network disconnection
- **Responsive Design**: Test across different device sizes

### Backend Testing

- **API Integration**: Verify successful communication with Gemini API
- **Error Handling**: Test with various error conditions (invalid API key, network issues)
- **Input Validation**: Verify proper validation of user inputs

## Deployment

For detailed deployment instructions, see [DEPLOYMENT.md](DEPLOYMENT.md)

## Updates

To update an existing installation, use the provided update script:

```bash
./update.sh
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contact

For questions or support, contact:
- Email: tim.empringham@live.ca

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
