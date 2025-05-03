// Weather API integration

document.addEventListener('DOMContentLoaded', function() {
    const weatherWidget = document.getElementById('weather-widget');
    
    // Get user's location and fetch weather data
    function getWeather() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                
                fetchWeatherData(latitude, longitude);
            }, error => {
                // If user denies location permission, use a default location
                console.log('Geolocation error:', error);
                fetchWeatherData(40.7128, -74.0060); // Default: New York
            });
        } else {
            weatherWidget.innerHTML = 'Geolocation is not supported by this browser.';
        }
    }
    
    // Fetch weather data from OpenWeatherMap API
    function fetchWeatherData(lat, lon) {
        // Note: In a real application, you would want to store this API key securely
        // and not expose it in client-side JavaScript
        const apiKey = 'YOUR_OPENWEATHERMAP_API_KEY';
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=${apiKey}`;
        
        // For demo purposes (without real API key), show mock data
        // In a real application, you would uncomment the fetch below and use your actual API key
        
        // Mock data for demonstration
        displayMockWeatherData();
        
        // Real API call (uncomment and use with your API key)
        /*
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Weather data not available');
                }
                return response.json();
            })
            .then(data => {
                displayWeatherData(data);
            })
            .catch(error => {
                console.error('Error fetching weather:', error);
                weatherWidget.innerHTML = 'Weather data unavailable';
            });
        */
    }
    
    // Display weather data in the widget
    function displayWeatherData(data) {
        const temp = Math.round(data.main.temp);
        const description = data.weather[0].description;
        const icon = data.weather[0].icon;
        const city = data.name;
        
        weatherWidget.innerHTML = `
            <div class="weather-info">
                <img src="https://openweathermap.org/img/wn/${icon}.png" alt="${description}">
                <div>
                    <span class="weather-temp">${temp}°C</span>
                    <div>${description}</div>
                    <div>${city}</div>
                </div>
            </div>
        `;
    }
    
    // Display mock weather data for demonstration
    function displayMockWeatherData() {
        // Get current date and season to make the mock data more realistic
        const date = new Date();
        const month = date.getMonth();
        
        // Determine temperature and icon based on season (Northern Hemisphere)
        let temp, description, icon;
        
        if (month >= 2 && month <= 4) {
            // Spring
            temp = Math.floor(Math.random() * 10) + 15; // 15-25°C
            description = ['Scattered clouds', 'Partly cloudy', 'Light rain'][Math.floor(Math.random() * 3)];
            icon = ['03d', '04d', '10d'][Math.floor(Math.random() * 3)];
        } else if (month >= 5 && month <= 7) {
            // Summer
            temp = Math.floor(Math.random() * 10) + 25; // 25-35°C
            description = ['Sunny', 'Clear sky', 'Few clouds'][Math.floor(Math.random() * 3)];
            icon = ['01d', '02d', '03d'][Math.floor(Math.random() * 3)];
        } else if (month >= 8 && month <= 10) {
            // Fall
            temp = Math.floor(Math.random() * 10) + 10; // 10-20°C
            description = ['Cloudy', 'Moderate rain', 'Overcast'][Math.floor(Math.random() * 3)];
            icon = ['04d', '10d', '04n'][Math.floor(Math.random() * 3)];
        } else {
            // Winter
            temp = Math.floor(Math.random() * 10); // 0-10°C
            description = ['Light snow', 'Scattered clouds', 'Overcast'][Math.floor(Math.random() * 3)];
            icon = ['13d', '03d', '04d'][Math.floor(Math.random() * 3)];
        }
        
        // Use the user's local time to determine if it's day or night
        const hour = date.getHours();
        const isDay = hour >= 6 && hour < 18;
        
        // Replace 'd' with 'n' in icon code if it's night
        if (!isDay && icon.includes('d')) {
            icon = icon.replace('d', 'n');
        }
        
        weatherWidget.innerHTML = `
            <div class="weather-info">
                <img src="https://openweathermap.org/img/wn/${icon}.png" alt="${description}">
                <div>
                    <span class="weather-temp">${temp}°C</span>
                    <div>${description}</div>
                    <div>Your location</div>
                </div>
            </div>
        `;
        
        // Add outfit suggestion based on weather
        suggestOutfit(temp, description);
    }
    
    // Suggest outfit based on weather
    function suggestOutfit(temp, description) {
        let outfitSuggestion;
        
        if (temp < 5) {
            outfitSuggestion = 'Heavy winter coat, scarf, gloves, and warm boots recommended.';
        } else if (temp < 15) {
            outfitSuggestion = 'Light jacket or sweater with pants would be comfortable.';
        } else if (temp < 25) {
            outfitSuggestion = 'T-shirt with light jacket or long sleeves recommended.';
        } else {
            outfitSuggestion = 'Light clothing, shorts or skirt, and sunscreen recommended.';
        }
        
        // If it's raining, add umbrella suggestion
        if (description.toLowerCase().includes('rain')) {
            outfitSuggestion += ' Don\'t forget your umbrella!';
        }
        
        // Create a tooltip or hint element
        const suggestionElement = document.createElement('div');
        suggestionElement.className = 'outfit-suggestion';
        suggestionElement.textContent = outfitSuggestion;
        suggestionElement.style.cssText = `
            position: absolute;
            background-color: var(--neutral-800);
            color: white;
            padding: 10px;
            border-radius: var(--border-radius);
            font-size: 14px;
            width: 250px;
            top: 70px;
            right: 0;
            z-index: 1001;
            box-shadow: var(--shadow);
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        `;
        
        // Add the suggestion element to the weather widget
        weatherWidget.style.position = 'relative';
        weatherWidget.appendChild(suggestionElement);
        
        // Show the suggestion on hover
        weatherWidget.addEventListener('mouseenter', () => {
            suggestionElement.style.opacity = '1';
        });
        
        weatherWidget.addEventListener('mouseleave', () => {
            suggestionElement.style.opacity = '0';
        });
    }
    
    // Initialize weather data
    getWeather();
});