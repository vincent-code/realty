let map = document.getElementById('map');
let x = map.dataset.x;
let y = map.dataset.y;
let name = map.dataset.name;
let myMap;

function init () {
    myMap = new ymaps.Map('map', {
        center: [x, y],
        zoom: 15
    });
    let myPlacemark = new ymaps.GeoObject({
        geometry: {
            type: "Point",
            coordinates: [x, y]
        },
        properties: {
            iconContent: name,
        }
    }, {
        preset: 'islands#blackStretchyIcon',
        draggable: false
    });
    myMap.geoObjects.add(myPlacemark);
}

ymaps.ready(init);

/*window.addEventListener('load', (event) => {
    document.getElementById('preloader').classList.add('d-none');
    document.getElementById('map').classList.remove('d-none');
    setTimeout(() => {
        document.getElementById('map').style.opacity = 1;
    }, '100');
});*/
