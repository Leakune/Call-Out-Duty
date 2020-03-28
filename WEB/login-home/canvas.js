Chart.defaults.global.title.display = true;

let datas = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

var ctx = document.getElementById('canvas').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['Janvier', 'Février', 'Mars','Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],

        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgba(78, 115, 225, 0.8)',
            borderColor: 'rgb(150, 150, 150)',
            data: [datas[0], datas[1], datas[11]]
        }]
    },

    // Configuration options go here
    options: {
        title: {
            text: "Graphique"
        },
        elements: {

        }
    }

});
