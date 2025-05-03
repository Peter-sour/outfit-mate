## Features

- Responsive design that works on all devices
- Weather integration that displays current conditions
- Beautiful UI with subtle animations
- Login options for both users and admins
- Feature preview section

## Project Structure

- `index.html` - Main HTML file
- `css/` - CSS files for styling
  - `styles.css` - Base styles and variables
  - `navbar.css` - Navigation bar styles
  - `hero.css` - Hero section styles
  - `features.css` - Feature section styles
  - `responsive.css` - Responsive design styles
- `js/` - JavaScript files
  - `main.js` - Core functionality
  - `weather.js` - Weather API integration

## Weather API Integration

The weather widget uses the OpenWeatherMap API to display current weather conditions based on the user's location. For the demo version, mock data is displayed.

To use with a real API key:
1. Register at [OpenWeatherMap](https://openweathermap.org/api) to get an API key
2. Replace `YOUR_OPENWEATHERMAP_API_KEY` in `weather.js` with your actual API key
3. Uncomment the fetch API call in the `fetchWeatherData` function

## Customization

- Colors: Edit the CSS variables in `styles.css` to change the color scheme
- Images: Replace the Pexels stock photo URL with your own images
- Content: Modify the text in `index.html` to match your brand voice

