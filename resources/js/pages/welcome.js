import Vue from 'vue';
import axios from "axios";
import Swal from 'sweetalert2'
import swal from "sweetalert2";

let weather = new Vue({
    el: '#weather',
    components: { },
    data:function(){
        return {
            zip: 0,
            temp: "--",
            sky: "-----",
            location: "-------",
            humidity: "----",
            pressure: "----",
            wind: "----",
            video: "clear2.mp4",
            icon: "fa fa-sun",
        }
    },

    // Clear, Clouds, Rain, Snow, Extreme

    methods: {

        fahrenheit(temp)
        {
            return (((temp-273.15)*1.8)+32).toFixed(0);
        },

        setSky(sky)
        {
            switch(sky) {
                case "Clear":
                    this.video = "clear2.mp4";
                    this.icon = "fa fa-sun";
                    break;
                case "Clouds":
                    this.video = "clouds.mp4";
                    this.icon = "fas fa-cloud-sun";
                    break;
                case "Rain":
                    this.video = "rain.mp4";
                    this.icon = "fas fa-cloud-sun-rain";
                    break;
                case "Snow":
                    this.video = "snow.mp4";
                    this.icon = "far fa-snowflake";
                    break;
                case "Extreme":
                    this.video = "extreme.mp4";
                    this.icon = "fas fa-cloud-showers-heavy";
                    break;
                default:
                    this.video = "clouds.mp4";
                    this.icon = "fa fa-sun";
            }
        },

        edit()
        {
            // console.log(" test");
            //
            Swal.fire({
                title: "Change Location",
                text: "What is the zip code?:",
                input: 'text',
                showCancelButton: true
            }).then((result) => {
                if (result.value) {
                    console.log(result.value)
                    this.zip = result.value;
                    this.getData(result.value)
                }
            });

        },

        /**
         * Get the weather data.
         */
        getData(zip = null)
        {
            axios.get('/get-weather' + ( (zip) ?  "?zip=" + zip : "") )
                .then((response) => {
                    console.log(response.data);
                    let weatherData = response.data;
                    this.temp = this.fahrenheit(weatherData.main.temp);
                    this.sky = weatherData.weather[0].main;
                    this.location = weatherData.name;
                    this.humidity = weatherData.main.humidity;
                    this.pressure = weatherData.main.pressure;
                    this.wind = weatherData.wind.speed;
                    this.setSky(this.sky); // set video and icon this.sky
                });
        },
    },

    mounted:function(){
        this.getData();
    },
});


