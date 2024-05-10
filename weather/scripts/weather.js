// navigator.geolocation.getCurrentPosition(test);
let locationSearch = 'London';
const url = `https://weatherapi-com.p.rapidapi.com/forecast.json?q=${locationSearch}&days=7`;
const options = {
	method: 'GET',
	headers: {
		'X-RapidAPI-Key': '78ba4dc851msh2ec2edff4ac63a7p1088ffjsn42fae57de46e',
		'X-RapidAPI-Host': 'weatherapi-com.p.rapidapi.com'
	}
};

fetch(url,options)
.then(res => res.json())
.then(res => {
	console.log(res);

	const currentLocation = document.querySelector("#location");
	currentLocation.textContent = res.location.name.toUpperCase();

	const currentWeather = document.querySelector("#current-weather")
	currentWeather.innerHTML = `<p>current weather: ${res.current.condition.text}</p>`;
	
	const weatherIcon = document.querySelector("#weather-icon");
	weatherIcon.innerHTML = `<p><img class = "weather" id = "current-weather" scr = (https:${res.current.condition.icon})/></p>`;

	const currentTemp = document.querySelector("#current-temp")
	currentTemp.innerHTML = `<p>degrees °C: ${res.current.temp_c}°C</p>`;
		
	const currentHumidity = document.querySelector("#current-humidity")
	currentHumidity.innerHTML = `<p>humidity: ${res.current.humidity}%</p>`;

	let loop_hour = 5;

	while (loop_hour != 17) {

	const currentWeather = document.querySelector(`#weather${loop_hour+1}`);
	currentWeather.innerHTML = `<p>current weather: ${res.forecast.forecastday[0].hour[loop_hour].condition.text}</p>`;
	
	const weatherIcon = document.querySelector(`#weather-icon${loop_hour+1}`);
	weatherIcon.innerHTML = `<p><img class = "weather" id = "weather${loop_hour}" scr = ("${res.forecast.forecastday[0].hour[loop_hour].condition.icon}")/></p>`;

	const currentTemp = document.querySelector(`#temp${loop_hour+1}`);
	currentTemp.innerHTML = `<p>degrees °C: ${res.forecast.forecastday[0].hour[loop_hour].temp_c}°C</p>`;
		
	const currentHumidity = document.querySelector(`#humidity${loop_hour+1}`);
	currentHumidity.innerHTML = `<p>humidity: ${res.forecast.forecastday[0].hour[loop_hour].humidity}%</p>`;
	loop_hour = loop_hour++;
	}
});

