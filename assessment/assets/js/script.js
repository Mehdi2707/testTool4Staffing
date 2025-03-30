function getCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? match[2] : null;
}

function updateButtons() {
    let client = getCookie('client');
    $('#btn-garages').toggle(client === 'clientb');
}

function loadDynamicContent() {
    const client = getCookie('client');
    let module = $('.dynamic-div').data('module') || 'cars';
    let script = $('.dynamic-div').data('script') || 'list';

    const accessibleModules = {
        clienta: ['cars'],
        clientb: ['cars', 'garages'],
        clientc: ['cars']
    };

    if (!accessibleModules[client]?.includes(module)) {
        console.warn(`Le client ${client} n'a pas accès au module ${module}. Redirection vers Cars.`);
        module = 'cars';
        script = 'list';
    }

    $('.dynamic-div').data('module', module).data('script', script);
    $('.dynamic-div').load(`customs/${client}/modules/${module}/${script}.php`);
}

$(document).ready(function() {
    updateButtons();
    loadDynamicContent();
});

$(document).on('click', '.change-client', function() {
    document.cookie = `client=${$(this).data('client')}; path=/`;
    updateButtons();
    loadDynamicContent();
});

$(document).on('click', '.change-module', function() {
    $('.dynamic-div').data('module', $(this).data('module')).data('script', $(this).data('script'));
    loadDynamicContent();
});

$(document).on('click', '.car', function() {
    $('.dynamic-div').load(`customs/cars/edit.php?id=${$(this).data('id')}`);
});

$(document).on('click', '.garage', function() {
    $('.dynamic-div').load(`customs/${getCookie('client')}/modules/garages/edit.php?id=${$(this).data('id')}`);
});