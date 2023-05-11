import axios from 'axios';
window.axios = axios;

document.addEventListener('DOMContentLoaded', () => {

    // в карточке ЖК
    document.querySelectorAll('.complex-card__favorite-icon').forEach((item) => {
        item.addEventListener('click', () => {
            favoriteManage(item.dataset.id, getAction(item));
        });
    });

    // на детальной странице ЖК
    if (window.location.pathname.match(/complexes\/\d/)) {
        let favorite = document.getElementById('favorite-item');
        favorite.addEventListener('click', () => {
            favoriteManage(favorite.dataset.id, getAction(favorite));
            textUpdate(favorite);
        }, false);
    }
});

function getAction(favorite) {
    if (favorite.classList.contains('active')) {
        favorite.classList.remove('active');
        return 'remove';
    } else {
        favorite.classList.add('active');
        return 'add';
    }
}

function favoriteManage(complexId, action) {
    axios.post('/favorite/' + action, {
        id: complexId
    })
        .then(function (response) {
            document.getElementById('favorite-count').textContent = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
}

function textUpdate(favorite) {
    if (favorite.classList.contains('active')) {
        document.getElementById('favorite-text').textContent = 'В избранном';
    } else {
        document.getElementById('favorite-text').textContent = 'В избранное';
    }
}
