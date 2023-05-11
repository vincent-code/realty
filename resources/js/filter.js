import axios from 'axios';
window.axios = axios;

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.filters').forEach((item) => {
        item.addEventListener('change', sendForm);
    });

    if (window.location.pathname === '/complexes') {
        document.getElementById('filter-clear').addEventListener('click', clearFilter);
    }
});

function sendForm() {
    if (localStorage.getItem('selectPage')) {
        axios.post('/complexes/count',
            new FormData(document.querySelector('form'))
        )
            .then(function (response) {
                //console.log('response');
                document.querySelector('button[type="submit"]').disabled = false;
                document.getElementById('search-count').textContent = response.data;
                document.getElementById('filter-clear').classList.remove('disabled');
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}

function clearFilter() {
    localStorage.setItem('selectPage', '');
    $('#selectPageComplex').selectPageClear();
    $('#selectPageDeveloper').selectPageClear();

    document.querySelectorAll('.filters').forEach((item) => {
        item.value = '';
        item.checked = false;
    });

    document.querySelector('form').submit();
}

if (window.location.pathname === '/complexes') {
    localStorage.setItem('selectPage', ''); // запрещаем отправку запроса axios при инициализации компонента

    $('#selectPageComplex').selectPage({
        showField : 'name',
        keyField : 'complex_id',
        data : complexes,
        multiple : true,
        multipleControlbar: false,
        lang: 'en',
        eSelect : function() {
            sendForm()
        },
        eTagRemove : function() {
            sendForm()
        }
    });
    $('#selectPageDeveloper').selectPage({
        showField : 'name',
        keyField : 'developer_id',
        data : developers,
        multiple : true,
        multipleControlbar: false,
        lang: 'en',
        eSelect : function() {
            sendForm()
        },
        eTagRemove : function() {
            sendForm()
        }
    });
    localStorage.setItem('selectPage', '1');

    // preloader
    window.addEventListener('load', (event) => {
        document.getElementById('complexes-preloader').classList.add('d-none');
        document.getElementById('complexes-content').classList.remove('d-none');
        setTimeout(() => {
            document.getElementById('complexes-content').style.opacity = 1;
        }, '20');
    });
}
